// Code adapted from Bootstrap Documentation http://getbootstrap.com/docs/4.1/components/modal/#modal
/* global $ */
$('#editModal').on('show.bs.modal', function updateFields(event) {
  const button = $(event.relatedTarget); // Button that triggered the modal
  const id = button.data('id');
  const modal = $(this);
  modal.find("input[name*='productID']").val(id);
  if (id === -1) {
    $('#editform')[0].reset();
    return;
  }
  fetch(`../../item/info.php/?id=${id}`)
    .then(blob => blob.json())
    .then((data) => {
      modal.find("input[name*='name']").val(data.name);
      modal.find("input[name*='photographer']").val(data.photographer);
      modal.find("input[name*='imageURL']").val(data.imageURL);
      modal.find("input[name*='category']").val(data.category);
      modal.find("input[name*='color']").val(data.color);
      modal.find("textarea[name*='description']").val(data.description);
    });
});
