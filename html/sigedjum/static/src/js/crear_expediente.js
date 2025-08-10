const { createApp } = Vue;

createApp({
  data() {
    return {
      form: {
        title: '',
        description: '',
        status: '',
        case_type_id: '',
        sponsored_partner_id: '',
        accuser_partner_id: '',
        assigned_user_id: '',
        partner_id: '',
      },
      caseTypes: [],
      partners: [],
      users: [],
      mensaje: '',
      mensajeTipo: '',
    };
  },
  methods: {
    cargarDatos() {
      // Cargar caseTypes
      axios.get('api/list_case_types.php').then(res => {
        if (res.data.success) {
          this.caseTypes = res.data.case_types;
        }
      });

      // Cargar partners
      axios.get('api/list_partners.php').then(res => {
        if (res.data.success) {
          this.partners = res.data.partners;
          if(this.partners.length) this.form.partner_id = this.partners[0].id; // Valor por defecto
        }
      });

      // Cargar users
      axios.get('api/list_users.php').then(res => {
        if (res.data.success) {
          this.users = res.data.users;
        }
      });
    },
    submitForm() {
      axios.post('api/crear_expediente.php', this.form)
        .then(res => {
          if (res.data.success) {
            this.mensaje = 'Expediente creado con éxito';
            this.mensajeTipo = 'alert-success';
            // Opcional: redirigir después de un tiempo
            setTimeout(() => window.location.href = 'mis_expedientes.html', 1500);
          } else {
            this.mensaje = 'Error: ' + (res.data.error || 'No se pudo crear expediente');
            this.mensajeTipo = 'alert-danger';
          }
        })
        .catch(() => {
          this.mensaje = 'Error al conectar con el servidor';
          this.mensajeTipo = 'alert-danger';
        });
    },
    volverLista() {
      window.location.href = 'mis_expedientes.html';
    }
  },
  mounted() {
    this.cargarDatos();
  }
}).mount('#app');