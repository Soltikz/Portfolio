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
        <?php include_once "../includes/components/hero.php" ?>
        <?php include_once "../includes/components/production.php"?>
    </main>
    <?php include_once "../includes/components/footer.php" ?>
</body>

</html>