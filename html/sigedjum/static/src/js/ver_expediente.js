const { createApp } = Vue;

createApp({
  data() {
    return {
      expediente: null,
      error: '',
      cargando: true,
    };
  },
  methods: {
    cargarExpediente() {
      const params = new URLSearchParams(window.location.search);
      const id = params.get('id');
      if (!id) {
        this.error = 'No se especificó ID del expediente.';
        this.cargando = false;
        return;
      }

      axios.get('api/ver_expediente.php', { params: { id } })
        .then(res => {
          if (res.data.success) {
            this.expediente = res.data.expediente;
          } else {
            this.error = res.data.error || 'No se encontró el expediente.';
          }
          this.cargando = false;
        })
        .catch(() => {
          this.error = 'Error al conectar con el servidor.';
          this.cargando = false;
        });
    },
    volverLista() {
      window.location.href = 'mis_expedientes.html';
    },
    editar() {
      if (this.expediente && this.expediente.id) {
        window.location.href = `crear_expediente.html?id=${this.expediente.id}`;
      }
    },
    cargarNota() {
      window.location.href = `crear_nota.html?expediente_id=${this.expediente.id}`;
    },
    verNotas() {
      window.location.href = `ver_notas.html?expediente_id=${this.expediente.id}`;
    }
  },
  mounted() {
    this.cargarExpediente();
  }
}).mount('#app');