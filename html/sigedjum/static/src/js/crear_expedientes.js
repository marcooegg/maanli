const { createApp } = Vue;

createApp({
    data() {
        return {
            form: {
                name: '',
                description: '',
                status: '',
                date: ''
            },
            loading: false
        };
    },
    methods: {
        crearExpediente() {
            this.loading = true;
            axios.post('api/crear_expediente.php', this.form)
                .then(response => {
                    if (response.data.success) {
                        alert('Expediente creado con éxito ✅');
                        this.form = { name: '', description: '', status: '', date: '' };
                    } else {
                        alert('Error al crear expediente ❌');
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                    alert('No se pudo conectar con el servidor ❌');
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}).mount('#app');
