<?php
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
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
        //     $statut = $_SESSION['statut'];
        //     echo "<h2>Bienvenue, " . htmlspecialchars($_SESSION['users']) . "</h2>";

        //     switch ($statut) {
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