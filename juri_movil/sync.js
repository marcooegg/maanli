// sync.js
export class SyncService {
  constructor({ db, serverBase, onSynced }) {
    this.db = db
    this.serverBase = serverBase // ej: http://192.168.0.100:5000
    this.onSynced = onSynced || (() => {})
    this.timer = null
    this.inflight = false
  }

  start() {
    this.kick() // sync inmediato
    this.timer = setInterval(() => this.kick(), 15000) // cada 15s
  }

  stop() {
    if (this.timer) clearInterval(this.timer)
  }

  async kick() {
    if (this.inflight) return
    if (!navigator.onLine) return
    this.inflight = true
    try {
      await this.push()
      await this.pull()
    } catch (e) {
      console.warn("Sync error:", e)
    } finally {
      this.inflight = false
    }
  }

  async push() {
    const dirty = await this.db.getDirtyNotas()
    if (!dirty.length) return

    const body = { notas: dirty.map(n => ({
      id: n.id,
      titulo: n.titulo,
      contenido: n.contenido,
      actualizado_en: n.actualizado_en
    })) }

    const res = await fetch(`${this.serverBase}/push`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(body)
    })

    if (!res.ok) throw new Error("Push failed")
    // marcar limpias las notas enviadas
    const ids = dirty.map(n => n.id)
    await this.db.markClean(ids)
  }

  async pull() {
    const lastSync = await this.db.driver.getMeta?.("last_sync") || ""
    const qs = lastSync ? `?last_sync=${encodeURIComponent(lastSync)}` : ""
    const res = await fetch(`${this.serverBase}/pull${qs}`)
    if (!res.ok) throw new Error("Pull failed")

    const data = await res.json()
    for (let nota of data.notas) {
      // sobrescribir si es más nueva o no existe
      await this.db.upsertNota({ ...nota }, false) // markDirty=false
    }

    // guardar timestamp de última sincronización
    if (this.db.driver.setMeta) {
      const now = new Date().toISOString()
      await this.db.driver.setMeta("last_sync", now)
      this.onSynced(now)
    }
  }
}
