const { createApp } = Vue;

createApp({
  data() {
    return {
      nota: {
        id: null,
        case_id: '',
        user_id: '',
        appointment_id : '',
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
    cargarExpediente(id) {
      this.cargando = true;
      axios.get('api/ver_nota.php', { params: { id } })
        .then(res => {
          if (res.data.success) {
            this.expediente = res.data.expediente;
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

      const url = this.isEdit ? 'api/editar_expediente.php' : 'api/crear_expediente.php';

      axios.post(url, this.expediente)
        .then(res => {
          if (res.data.success) {
            this.mensaje = this.isEdit ? 'Expediente actualizado con éxito' : 'Expediente creado con éxito';
            if (!this.isEdit) {
              this.expediente = {
                id: null,
                title: '',
                description: '',
                status: '',
                case_type_id: '',
                sponsored_partner_id: '',
                accuser_partner_id: '',
                assigned_user_id: '',
                partner_id: '',
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
      this.cargarExpediente(id);
    }
  }
}).mount('#app');
