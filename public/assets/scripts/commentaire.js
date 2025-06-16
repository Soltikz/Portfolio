document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-commentaire");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const commentaire = this.commentaire.value;
    const id_projet = this.id_projet.value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajouter_commentaire.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        if (data.success) {
          const container = document.querySelector(".liste-commentaires");
          const item = document.createElement("div");
          item.classList.add("commentaire-item");
          item.innerHTML = `<strong>${data.user}</strong><br>
                                      <small>${data.date}</small>
                                      <p>${data.commentaire}</p>`;
          container.prepend(item);
          form.reset();
        } else {
          alert("Erreur lors de l'envoi du commentaire.");
        }
      }
    };

    xhr.send(
      "commentaire=" +
        encodeURIComponent(commentaire) +
        "&id_projet=" +
        encodeURIComponent(id_projet)
    );
  });
});
