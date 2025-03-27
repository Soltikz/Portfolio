<?php
require_once "connexion.php"; // Assure-toi d'inclure ta connexion à la base de données

// Vérifier si un name est passé en paramètre
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    // Préparer et exécuter la requête SQL pour récupérer les infos du projet
    $stmt = $bdd->prepare("SELECT * FROM projets WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $projet = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Aucun projet trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Projet " . htmlspecialchars($projet['name']);
include_once "../includes/components/head.php";
?>

<body>
    <?php include_once "../includes/components/header.php" ?>
    <div class="project">
        <div class="title-project">
            <h1><?= htmlspecialchars($projet['type']) ?></h1>
            <h2><?= htmlspecialchars($projet['name']) ?></h2>
        </div>
        <img src="<?= htmlspecialchars($projet['img_1']) ?>" alt="">
        <div class="text">
            <p><?= htmlspecialchars_decode($projet['texte_1']) ?></p>
            <p><?= htmlspecialchars_decode($projet['texte_2']) ?></p>
            <p><?= htmlspecialchars_decode($projet['texte_3']) ?></p>
        </div>
        <div class="btn-project">
            <a href="<?= htmlspecialchars($projet['github']) ?>">
                Le Github
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10" />
                    <path d="M7 17 17 7" />
                </svg>
            </a>
            <a href="<?= htmlspecialchars($projet['lien']) ?>">
                Le Site
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10" />
                    <path d="M7 17 17 7" />
                </svg>
            </a>
        </div>
        <div class="sae"></div>
        <img src="<?= htmlspecialchars($projet['img_2']) ?>" alt="">
        <img src="<?= htmlspecialchars($projet['img_3']) ?>" alt="">
        <img src="<?= htmlspecialchars($projet['img_4']) ?>" alt="">
        <div class="commentaire"></div>
    </div>
    <?php include_once ("../includes/components/footer.php")?>
</body>

</html>