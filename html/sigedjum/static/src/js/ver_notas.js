const { createApp } = Vue;

createApp({
    data() {
        return {
            tableData: [],
            cargando: false,
            error: '',
            notas: [],
            searchQuery: '',
            expedienteId: null,
        };
    },
    methods: {
        showTable() {
            this.cargando = true;
            const params = new URLSearchParams(window.location.search);
            const id = params.get('expediente_id');
            this.expedienteId = id;
            axios.get('api/list_notas.php', {
                params: { 'expediente_id': this.expedienteId }
            })
                .then(res => {
                    if (res.data.success) {
                        this.tableData = res.data.notes;
                        this.notas = res.data.notes;
                    } else {
                        alert('Error al cargar notes');
                    }
                })
                .catch(() => alert('Error al conectar con el servidor')).finally(() => {
                    this.cargando = false;
                });
        },
        goCrear() {
            window.location.href = `crear_nota.html?expediente_id=${this.expedienteId}`;
        },
        volverExpte() {
            const params = new URLSearchParams(window.location.search);
            const expedienteId = params.get('expediente_id');
            if (expedienteId) {
                window.location.href = `ver_expediente.html?id=${expedienteId}`;
            } else {
                alert('No se especificó ID del expediente.');
            }
        }
    },
    mounted() {
        this.showTable();
    }
}).mount('#app');
