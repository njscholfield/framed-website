/* global Vue, axios */
const orders = new Vue({
  el: '#vue',
  data: {
    orderInfo: {},
  },
  methods: {
    openOrderModal(id) {
      axios.get(`info.php?orderID=${id}`)
        .then(response => response.data)
        .then((data) => {
          if (data.successful) {
            this.orderInfo = data.orderInfo;
          } else { throw Error(); }
        })
        .then(() => this.$refs.orderModal.show())
        .catch(() => console.log('error'));
    },
    submitForm() {
      document.getElementById('form').submit();
    },
  },
});
