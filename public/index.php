<?php
require_once("connexion.php");

if (isset($_GET['info'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['info']) . "');</script>";
}
if (isset($_GET['success'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['success']) . "');</script>";
}
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
        <?php
        // if (isset($_SESSION['users']) && isset($_SESSION['statut'])) {
        //     $statue = $_SESSION['statue'];
        //     echo "<h2>Bienvenue, " . htmlspecialchars($_SESSION['users']) . "</h2>";

        //     switch ($statue) {
        //         case 'enseignant':
        //             echo "<p>Contenu réservé aux enseignants.</p>";
        //             break;
        //         case 'etudiant':
        //             echo "<p>Contenu pour les étudiants.</p>";
        //             break;
        //         case 'admin':
        //             echo "<p>Interface d'administration.</p>";
        //             break;
        //         default:
        //             echo "<p>Statut non reconnu.</p>";
        //     }
        // } else {
        //     echo "<p>Vous n'êtes pas connecté. <a href='login.php'>Connexion</a></p>";
        // }
        ?>
        <?php include_once "../includes/components/hero.php" ?>
        <?php include_once "../includes/components/production.php"?>
    </main>
    <?php include_once "../includes/components/footer.php" ?>
</body>

</html>