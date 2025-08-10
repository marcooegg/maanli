const { createApp } = Vue;

createApp({
  data() {
    return {
      nota: {
        id: null,
        case_id: '',
        user_id: 1,
        appointment_id : null,
        title: '',
        content: '',
      },
      isEdit: false,
      cargando: false,
      error: '',
      mensaje: '',
    };
  },
  methods: {
    cargarSelects() {
      
    },
    cargarNota(id) {
      this.cargando = true;
      axios.get('api/ver_nota.php', { params: { id } })
        .then(res => {
          if (res.data.success) {
            this.nota = res.data.nota;
            this.isEdit = true;
          } else {
            this.error = res.data.error || 'No se encontró expediente';
          }
          this.cargando = false;
        })
        .catch(() => {
          this.error = 'Error al conectar con el servidor';
          this.cargando = false;
        });
    },
    guardar() {
      this.error = '';
      this.mensaje = '';
      this.cargando = true;
      const params = new URLSearchParams(window.location.search);
      const id = params.get('expediente_id');
      this.nota.case_id = id;
      const url = this.isEdit ? 'api/editar_nota.php' : 'api/crear_nota.php';

      axios.post(url, this.nota)
        .then(res => {
          if (res.data.success) {
            this.mensaje = this.isEdit ? 'Nota actualizada con éxito' : 'Nota creado con éxito';
            if (!this.isEdit) {
              this.nota = {
                id: null,
                case_id: '',
                user_id: 6,
                appointment_id : '',
                title: '',
                content: '',
              };
            }
          } else {
            this.error = res.data.error || 'Error en la operación';
          }
          this.cargando = false;
        })
        .catch(() => {
          this.error = 'Error al conectar con el servidor';
          this.cargando = false;
        });
    },
    volverLista() {
      window.location.href = 'mis_expedientes.html';
    }
  },
  mounted() {
    this.cargarSelects();

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    if (id) {
      this.cargarNota(id);
    }
  }
}).mount('#app');
