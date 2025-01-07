console.log("Made with 🤍");

// Exemple d'import de fonctions.
// import { validateEmail } from "./utilis.js";

(function () {
  const App = {
    // les constantes

    // les éléments du DOM
    DOM: {
      // element: document.querySelector(".element"),
    },

    /**
     * Initialisation de l'application.
     */
    app_init: function () {
      App.app_handlers();
    },

    /**
     * Mise en place des gestionnaires d'évènements.
     */
    app_handlers: function () {
      // App.DOM.title.addEventListener("click", App.yourFunction);
    },

    /**
     * Mise en place des fonctions.
     */
    // yourFunction: () => {},
  };

  window.addEventListener("DOMContentLoaded", App.app_init);
})();
