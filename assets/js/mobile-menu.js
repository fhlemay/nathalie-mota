document.addEventListener("DOMContentLoaded", () => {
  const MINI_DELAY = 50;
  const ANIM_DELAY = 500 + MINI_DELAY;

  const toggleButton = document.getElementById("toggle-menu");
  const toggleButtonVisibility = window.getComputedStyle(toggleButton).display;

  const OPEN_MENU_IMAGE = variables.themeUrl + "/assets/img/burger.svg";
  const CLOSE_MENU_IMAGE = variables.themeUrl + "/assets/img/close.svg";

  const menu = document.querySelector(".menu-container");

  // Initial state : menu is closed
  if (toggleButtonVisibility !== "none") {
    menu.style.display = "none";
    menu.classList.remove("is-visible");
    toggleButton.src = OPEN_MENU_IMAGE;
  }

  toggleButton.addEventListener("click", () => {
    if (menu.classList.contains("is-visible")) {
      toggleSuperMenu("CLOSE");
    } else {
      toggleSuperMenu("OPEN");
    }
  });

  function toggleSuperMenu(action) {
    switch (action) {
      case "OPEN":
        menu.style.display = "flex";
        toggleButton.src = CLOSE_MENU_IMAGE;
        setTimeout(() => {
          menu.classList.add("is-visible");
        }, MINI_DELAY); // to avoid the simultaneity of operations
        break;
      case "CLOSE":
        menu.classList.remove("is-visible");
        toggleButton.src = OPEN_MENU_IMAGE;
        setTimeout(() => {
          menu.style.display = "none";
        }, ANIM_DELAY);
        break;
    }
  }
});
