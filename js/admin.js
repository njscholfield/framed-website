// Code adapted from Bootstrap Documentation http://getbootstrap.com/docs/4.1/components/modal/#modal
/* global Vue, axios */
const admin = new Vue({
  el: '#vue',
  data: {
    formData: {},
    errors: {},
    pageMessage: {},
  },
  methods: {
    openEditModal(id) {
      if (id === -1) {
        this.formData = { productID: -1 };
        this.$refs.editModal.show();
        return;
      }
      axios.get(`../../item/info.php/?id=${id}`)
        .then(response => this.formData = response.data)
        .then(() => this.$refs.editModal.show())
        .catch(err => console.error(err));
    },
    submitForm() {
      axios.post('update.php', this.formData)
        .then(response => response.data)
        .then((status) => {
          if (status.successful) {
            this.pageMessage = { type: 'text-success', message: 'Item updated!' };
            this.errors = {};
            this.$refs.editModal.hide();
          } else {
            this.errors = status.errors;
          }
        })
        .catch(error => this.pageMessage = { type: 'text-danger', message: 'Error updating item' });
    },
  },
});
