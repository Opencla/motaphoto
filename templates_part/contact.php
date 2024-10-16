<div class="modal-container">
  <div class="overlay modal-trigger"></div>
  <div class="modal">
  <img src="http://localhost/motaphoto/wordpress/wp-content/uploads/2024/09/Contact-header.png" alt="CONTACT">
  <div class="contact-form">
  <?php
  // Affiche le formulaire de contact en utilisant le shortcode Contact Form 7//
  echo do_shortcode('[contact-form-7 id="25a3afe" title="CONTACTCONTACTCONTACTCONTACTCONTACTCONTACT"]')
  ?>
  </div>
</div>
<button class="modal-btn modal-trigger">Open</button>
 <script>
  console.log("loaded");
  const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");
console.log(modalTriggers);
modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal))

function toggleModal(){
  modalContainer.classList.toggle("active")
}
 </script>
