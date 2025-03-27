document.addEventListener("DOMContentLoaded", function () {
  const menuButton = document.querySelector(".header-menu");
  const menuLinks = document.querySelector("#menu-link");

  if (!menuButton || !menuLinks) {
    console.error("Erreur : éléments non trouvés !");
    return;
  }

  menuButton.addEventListener("click", function () {
    console.log("Menu cliqué !");
    menuLinks.classList.toggle("hidden");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const producItems = document.querySelectorAll(".accordeons > div");
  const previews = document.querySelectorAll(".preview-all > div");

  function resetAll() {
    producItems.forEach((item) => {
      item.classList.remove("back");
      item.querySelector(".arrow-right").style.display = "flex";
      item.querySelector(".arrow-up").style.display = "none";
    });
    previews.forEach((preview) => {
      preview.style.display = "none";
    });
  }

  producItems.forEach((item, index) => {
    item.addEventListener("click", function () {
      resetAll();

      this.classList.add("back");
      this.querySelector(".arrow-right").style.display = "none";
      this.querySelector(".arrow-up").style.display = "flex";

      if (previews[index]) {
        previews[index].style.display = "flex";
      }
    });
  });

  producItems[0].click();
});

const container = document.querySelector(".image");
const items = document.querySelectorAll(".image-item");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");

let index = 0;
const totalItems = items.length;

function getItemWidth() {
  return window.innerWidth <= 1150 ? 361 : 562;
}

nextBtn.addEventListener("click", () => {
  index = (index + 1) % totalItems;
  updateCarousel();
});

prevBtn.addEventListener("click", () => {
  index = (index - 1 + totalItems) % totalItems;
  updateCarousel();
});

function updateCarousel() {
  const itemWidth = getItemWidth();
  container.style.transform = `translateX(${-index * itemWidth}px)`;
}

window.addEventListener("resize", updateCarousel);

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".btns button");
  const sportText = document.querySelector(".choice .sport");
  const motoText = document.querySelector(".choice .moto");
  const sportImage = document.querySelector(".image-hobbies img.sport");
  const motoImage = document.querySelector(".image-hobbies img.moto");

  function showContent(type) {
    if (type === "sport") {
      sportText.style.display = "block";
      sportImage.style.display = "block";
      motoText.style.display = "none";
      motoImage.style.display = "none";
    } else {
      sportText.style.display = "none";
      sportImage.style.display = "none";
      motoText.style.display = "block";
      motoImage.style.display = "block";
    }
  }

  function toggleButton(button) {
    buttons.forEach((btn) => {
      const arrowRight = btn.querySelector(".arrow-btn .right");
      const arrowUp = btn.querySelector(".arrow-btn .up");

      if (btn === button) {
        arrowRight.style.display = "none";
        arrowUp.style.display = "inline-block";
      } else {
        arrowRight.style.display = "inline-block";
        arrowUp.style.display = "none";
      }
    });
  }

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const type = this.textContent.trim().toLowerCase();
      showContent(type);
      toggleButton(this);
    });
  });

  // Sélection automatique du premier élément
  showContent("sport");
  toggleButton(buttons[0]);
});

document.addEventListener("DOMContentLoaded", function () {
  const skills = document.querySelectorAll(
    ".skill-font, .skill-back, .skill-ux-ui, .skill-movie"
  );

  skills.forEach((skill, index) => {
    const toggleElement = skill; // Rendre tout l'élément cliquable
    const para = skill.querySelector(".para");
    const arrowRight = skill.querySelector(".arrow-right");
    const arrowUp = skill.querySelector(".arrow-up");

    // Sauvegarde de la classe d'origine
    const originalClass = skill.classList[0];

    // Si c'est le premier élément, l'afficher par défaut
    if (index === 0) {
      para.style.display = "block";
      arrowRight.style.display = "none";
      arrowUp.style.display = "block";
      skill.classList.replace(originalClass, "style-back"); // Remplace par la nouvelle classe
    } else {
      para.style.display = "none";
      arrowUp.style.display = "none";
      skill.classList.remove("style-back");
    }

    toggleElement.addEventListener("click", function () {
      const isVisible = para.style.display === "block";

      // Réinitialiser tous les éléments
      skills.forEach((s) => {
        s.querySelector(".para").style.display = "none";
        s.querySelector(".arrow-right").style.display = "block";
        s.querySelector(".arrow-up").style.display = "none";
        const sOriginalClass = s.getAttribute("data-original-class");
        s.classList.replace("style-back", sOriginalClass); // Remettre l'ancienne classe
      });

      // Basculer l'affichage et remplacer la classe
      if (!isVisible) {
        para.style.display = "block";
        arrowRight.style.display = "none";
        arrowUp.style.display = "block";
        skill.classList.replace(originalClass, "style-back"); // Remplace par la nouvelle classe
      }
    });

    // Stocker la classe d'origine dans un attribut `data-`
    skill.setAttribute("data-original-class", originalClass);
  });
});

window.addEventListener("beforeunload", function (event) {
  // Créer une requête AJAX pour fermer la session quand l'utilisateur quitte la page
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", true);
  xhr.send();
});
