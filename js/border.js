(function() {
  const buttons = [...document.getElementsByClassName('border-toggle')];
  const image = document.getElementById('js-img-item');

  buttons.forEach((item) => item.addEventListener('click', (e) => image.classList = e.target.dataset.class));
})();