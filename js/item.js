(function() {
  const BASE_PRICE = 10;
  const buttons = [...document.getElementsByClassName('border-toggle')];
  const image = document.getElementById('js-img-item');
  const lblPrice = document.getElementById('js-price');
  const cartFormFrame = document.getElementById('form-frame-type');
  const cartFormPrice = document.getElementById('form-price');
  
  const favBtn = document.getElementById('fav-btn');
  const unfavBtn = document.getElementById('unfav-btn');

  buttons.forEach((item) => item.addEventListener('click', (e) => {
    const price = BASE_PRICE + parseInt(e.target.dataset.price);
    image.classList = e.target.dataset.class;
    lblPrice.innerHTML = '$' + price;
    cartFormFrame.value = e.target.innerHTML;
    cartFormPrice.value = price;
  }));
  
  function modifyFavorite(body) {
    let successful;
    const config = {
      method: "POST",
      body: JSON.stringify(body),
      credentials: 'same-origin',
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      }
    };
    fetch('/favorites/modify.php', config)
      .then(blob => blog.json())
      .then(data => successful = data.success )
      .catch(() => successful = false);
    return successful;
  }
  
  favBtn.addEventListener('click', (e) => {
    const body = { action: "Add", itemID: e.target.dataset.item };
    modifyFavorite(body);
    if(modifyFavorite) {
      favBtn.classList.add('d-none');
      unfavBtn.classList.remove('d-none');
    }
  });
  unfavBtn.addEventListener('click', (e) => {
    const body = { action: "Delete", itemID: e.target.dataset.item };
    modifyFavorite(body);
    if(modifyFavorite) {
      favBtn.classList.remove('d-none');
      unfavBtn.classList.add('d-none');
    }
  });
})();