// Code adapted from Bootstrap Documentation http://getbootstrap.com/docs/4.1/components/modal/#modal
/* global $ */
const editModal = document.getElementById('editModal');
const editForm = document.getElementById('editform');
const productID = document.getElementById('productid');
const itemName = document.getElementById('name');
const photographer = document.getElementById('photographer');
const imageURL = document.getElementById('imageURL');
const category = document.getElementById('category');
const color = document.getElementById('color');
const description = document.getElementById('description');

function updateFields(e) {
  const button = $(e.relatedTarget)[0];
//   const button = e.target;
  const id = button.dataset.id;
  console.log(id);
  
  productID.value = id;
  if (id == -1) {
    editForm.reset();
    return;
  }
  
  fetch(`../../item/info.php/?id=${id}`)
    .then(blob => blob.json())
    .then((data) => {
      itemName.value = data.name;
      photographer.value = data.photographer;
      imageURL.value = data.imageURL;
      category.value = data.category;
      color.value = data.color;
      description.value = data.description;
    });
}

// editModal.addEventListener('show.bs.modal', updateFields, false);
$('#editModal').on('show.bs.modal', updateFields);
