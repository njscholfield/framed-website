const btns = [...document.getElementsByClassName('fav-btn')];
const favText = '<span class="fas fa-heart"></span> Favorite';
const favedText = '<span class="fas fa-heart text-danger"></span> Favorited';
let favorites = [];

async function modifyFavorite(body) {
  const config = {
    method: 'POST',
    body: JSON.stringify(body),
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json; charset=utf-8',
    },
  };
  await fetch('../favorites/modify.php', config)
    .then(blob => blob.json())
    .then(data => data.success)
    .then((success) => { if (!success) throw new Error('Error modifying'); })
    .catch(() => { throw new Error('Invalid request'); });
}

function toggleFavBtn(favBtn, index) {
  if (index !== -1) {
    favBtn.classList.remove('btn-secondary');
    favBtn.classList.add('btn-success');
    favBtn.innerHTML = favText;
    favorites.splice(index, 1);
  } else {
    favBtn.classList.remove('btn-success');
    favBtn.classList.add('btn-secondary');
    favBtn.innerHTML = favedText;
    favorites.push(favBtn.dataset.item);
  }
}

function toggleFavorite(e) {
  const index = favorites.indexOf(e.target.dataset.item);
  const body = { itemID: e.target.dataset.item };
  body.action = (index !== -1) ? 'Delete' : 'Add';
  modifyFavorite(body)
    .then(() => { toggleFavBtn(e.target, index); })
    .catch(() => console.error('Error favoriting'));
}

// Add event listeners and change buttons that are favorited already
function updateBtns(favs) {
  favorites = favs;
  btns.forEach((btn) => {
    btn.addEventListener('click', toggleFavorite);
    if (favorites.includes(btn.dataset.item)) {
      btn.classList.remove('btn-success');
      btn.classList.add('btn-secondary');
      btn.innerHTML = favedText;
    }
  });
}

// Hides all the favorite buttons if the user is not logged in
function hideBtns() {
  btns.forEach((btn) => {
    btn.classList.add('d-none');
  });
}

function getFavorites() {
  fetch('../favorites/modify.php')
    .then(blob => blob.json())
    .then((data) => {
      if (data.success) {
        updateBtns(data.favorites);
      } else {
        hideBtns();
      }
    })
    .catch(() => console.error('Error fetching favorites'));
}
getFavorites();
