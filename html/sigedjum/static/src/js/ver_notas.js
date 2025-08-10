const { createApp } = Vue;

createApp({
  data() {
    return {
      tableData: [],
      notas: [],
      searchQuery: '',
    };
  },
  methods: {
    showTable() {
        const params = new URLSearchParams(window.location.search);
      const id = params.get('id');
      axios.get('api/list_notas.php', {
        params: { id }
      })
      .then(res => {
        if (res.data.success) {
          this.tableData = res.data.notes;
          this.notas = res.data.notes;
        } else {
          alert('Error al cargar notes');
        }
      })
      .catch(() => alert('Error al conectar con el servidor'));
    },
    goCrear() {
      window.location.href = 'crear_nota.html';
    }
  },
  mounted() {
    this.showTable();
  }
}).mount('#app');
