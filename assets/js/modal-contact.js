document.addEventListener("DOMContentLoaded", function () {
  // Get the modal
  const modal = document.getElementById("contactModal");

  // Get the button that opens the modal
  const btn = document.getElementById("openModal");

  btn.addEventListener("click", () => {
    modal.classList.add("show-modal");
  });

  window.addEventListener("click", (event) => {
    if (event.target == modal) {
      modal.classList.remove("show-modal");
    }
  });
});
