// db.js
const isNative = () => !!(window.Capacitor && window.Capacitor.isNativePlatform)

class IDBDriver {
  async init() {
    this.db = await new Promise((resolve, reject) => {
      const req = indexedDB.open('juri-db', 1)
      req.onupgradeneeded = () => {
        const db = req.result
        if (!db.objectStoreNames.contains('notas')) {
          const store = db.createObjectStore('notas', { keyPath: 'id' })
          store.createIndex('updated_at', 'updated_at')
          store.createIndex('_dirty', '_dirty')
        }
      }
      req.onsuccess = () => resolve(req.result)
      req.onerror = () => reject(req.error)
    })
  }

  async getAll() {
    return new Promise((resolve, reject) => {
      const tx = this.db.transaction('notas', 'readonly')
      const req = tx.objectStore('notas').getAll()
      req.onsuccess = () => resolve(req.result)
      req.onerror = () => reject(req.error)
    })
  }

  async upsert(nota) {
    return new Promise((resolve, reject) => {
      const tx = this.db.transaction('notas', 'readwrite')
      tx.objectStore('notas').put(nota)
      tx.oncomplete = () => resolve()
      tx.onerror = () => reject(tx.error)
    })
  }

  async getDirty() {
    return new Promise((resolve, reject) => {
      const tx = this.db.transaction('notas', 'readonly')
      const idx = tx.objectStore('notas').index('_dirty')
      const req = idx.getAll(1)
      req.onsuccess = () => resolve(req.result)
      req.onerror = () => reject(req.error)
    })
  }

  async markClean(ids) {
    for (let id of ids) {
      const nota = await this.get(id)
      nota._dirty = 0
      await this.upsert(nota)
    }
  }

  async get(id) {
    return new Promise((resolve, reject) => {
      const tx = this.db.transaction('notas', 'readonly')
      const req = tx.objectStore('notas').get(id)
      req.onsuccess = () => resolve(req.result)
      req.onerror = () => reject(req.error)
    })
  }
}

// TODO: agregar SQLiteDriver para Android con @capacitor-community/sqlite

export class DB {
  constructor() {
    this.driver = null
  }

  async init() {
    this.driver = new IDBDriver()
    await this.driver.init()
  }

  async getNotas() {
    return this.driver.getAll()
  }

  async upsertNota(nota, markDirty = true) {
    const finalNota = { ...nota, _dirty: markDirty ? 1 : 0 }
    await this.driver.upsert(finalNota)
  }

  async getDirtyNotas() {
    return this.driver.getDirty()
  }

  async markClean(ids) {
    await this.driver.markClean(ids)
  }
}
