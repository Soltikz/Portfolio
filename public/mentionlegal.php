<?php
require_once("connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Page d'accueil";
include_once "../includes/components/head.php";
?>


<body>
    <?php include_once "../includes/components/header.php" ?>
    <main>
        <div class="mention">
            <div class="title-mention">
                <h1>Mention légales</h1>
                <p>En vigueur au 01/01/2025</p>
            </div>
            <p>Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la
                Confiance dans l’économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et
                visiteurs, ci-après l'utilisateur, du site <strong>lucasmrtn.fr</strong>, ci-après le site, les
                présentes mentions légales.
            </p>
            <p>
                La connexion et la navigation sur le site par l’utilisateur implique acceptation intégrale et sans
                réserve des présentes mentions légales.
            </p>
            <p>
                Ces dernières sont accessibles sur le site à la rubrique "<strong>Mentions légales</strong>".
            </p>
            <div class="article">
                <h2>Article 1 - L'éditeur </h2>
                <p>L’édition et la direction de la publication du site est assurée par :</p>
                <div class="art-info">
                    <p>Lucas MARTIN</p>
                    <p class="mail">martin.lucas.celestin@gmail.com</p>
                </div>
            </div>
            <div class="article">
                <h2>Article 2 - L'herbergeur</h2>
                <p>L'hébergeur du site est :</p>
                <div class="art-info">
                    <p class="bold">ALWAYDATA</p>
                    <p>91 rue du Faubourg Saint Honoré 75008</p>
                    <p>Paris</p>
                </div>
            </div>
            <div class="article">
                <h2>Article 3 - Accès au site</h2>
                <p>Le site est accessible en tout endroit, 7j/7, 24h/24 sauf cas de force majeure, interruption
                    programmée ou non et pouvant découlant d’une nécessité de maintenance.
                </p>
                <p>
                    En cas de modification, interruption ou suspension du site, l'éditeur ne saurait être tenu
                    responsable.
                </p>
            </div>
            <div class="article">
                <h2>Article 4 - Collecte des données</h2>
                <p>
                    Nous ne collectons pas de données via des cookies, mais uniquement via un formulaire lors de
                    l'inscription et de la connexion.
                </p>
                <p>
                    Toute utilisation, reproduction, diffusion, commercialisation, modification de toute ou partie du
                    site, sans autorisation de l’Editeur est prohibée et pourra entraînée des actions et poursuites
                    judiciaires telles que notamment prévues par le Code de la propriété intellectuelle et le Code
                    civil.
                </p>
            </div>
        </div>
    </main>

    <?php include_once "../includes/components/footer.php" ?>
</body>

</html>