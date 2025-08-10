const { createApp } = Vue;

createApp({
  data() {
    return {
      tableData: [],
      searchQuery: '',
    };
  },
  methods: {
    showTable() {
      axios.get('api/mis_expedientes.php', {
        params: { search: this.searchQuery }
      })
      .then(res => {
        if (res.data.success) {
          this.tableData = res.data.expedientes;
        } else {
          alert('Error al cargar expedientes');
        }
      })
      .catch(() => alert('Error al conectar con el servidor'));
    },
    ver(id) {
      window.location.href = `ver_expediente.html?id=${id}`;
    },
    goCrear() {
      window.location.href = 'crear_expediente.html';
    }
  },
  mounted() {
    this.showTable();
  }
}).mount('#app');
