import { createApp, h } from 'vue';

const app = createApp({
  data() {
    return {
      expedientes: [],
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
          this.expedientes = res.data.expedientes;
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
    },
  },
  mounted() {
    this.showTable();
  },
  render() {
    if (!this.expedientes.length) {
      return h('p', 'No hay expedientes para mostrar.');
    }
    return h('table', { class: 'table table-bordered' }, [
      h('thead', [
        h('tr', [
          h('th', 'ID'),
          h('th', 'Título'),
          h('th', 'Descripción'),
          h('th', 'Estado'),
          h('th', 'Creado'),
          h('th', 'Acciones'),
        ]),
      ]),
      h('tbody', this.expedientes.map(exp =>
        h('tr', { key: exp.id }, [
          h('td', exp.id),
          h('td', exp.title),
          h('td', exp.description),
          h('td', exp.status),
          h('td', exp.created_at),
          h('td', [
            h('button', {
              class: 'btn btn-info btn-sm',
              onClick: () => this.ver(exp.id),
            }, 'Ver'),
          ]),
        ])
      )),
    ]);
  },
});

app.mount('#table-container');