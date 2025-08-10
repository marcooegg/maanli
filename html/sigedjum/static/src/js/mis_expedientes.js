const { createApp } = Vue;

createApp({
    data() {
        return {
            tableData: [],
            searchQuery: '',
            loading: false
        };
    },
    methods: {
        showTable() {
            this.loading = true;
            axios.get('api/mis_expedientes.php', {
                params: {
                    search: this.searchQuery
                }
            })
            .then(response => {
                if (response.data.success) {
                    this.tableData = response.data.expedientes;
                } else {
                    this.tableData = [];
                    console.error('Error en respuesta:', response.data);
                }
            })
            .catch(error => {
                console.error('Error de conexión:', error);
                this.tableData = [];
            })
            .finally(() => {
                this.loading = false;
            });
        }
    },
    mounted() {
        this.showTable();
    }
}).mount('#app');