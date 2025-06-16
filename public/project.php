<?php
require_once "connexion.php"; 

// Vérifier si un name est passé en paramètre
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $mode = $_GET['mode'] ?? 'professionnel';

    // Requête projet
    $stmt = $bdd->prepare("SELECT * FROM projets WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $projet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$projet) {
        echo "Projet non trouvé.";
        exit;
    }
} else {
    echo "Aucun projet trouvé.";
    exit;
}

$texte1 = htmlspecialchars_decode($projet['texte_1_' . ($mode === 'academique' ? 'ac' : 'pro')] ?? '');
$texte2 = htmlspecialchars_decode($projet['texte_2_' . ($mode === 'academique' ? 'ac' : 'pro')] ?? '');
$texte3 = htmlspecialchars_decode($projet['texte_3_' . ($mode === 'academique' ? 'ac' : 'pro')] ?? '');

// Insérer un commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentaire']) && !empty($_POST['commentaire'])) {
    if (isset($_SESSION['statue']) && in_array($_SESSION['statue'], ['admin', 'enseignant'])) {
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $id_user = $_SESSION['id']; // Assure-toi que $_SESSION['id'] est bien défini à la connexion
        $id_projet = $projet['id'];

        $stmt = $bdd->prepare("INSERT INTO commentaire (id_users, id_projet, commentaire, date) 
                               VALUES (:id_user, :id_projet, :commentaire, NOW())");
        $stmt->execute([
            'id_user' => $id_user,
            'id_projet' => $id_projet,
            'commentaire' => $commentaire
        ]);

        // Redirection pour éviter le double envoi du formulaire
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

// Récupérer les commentaires
$stmt = $bdd->prepare("
    SELECT c.commentaire, c.date, u.users
    FROM commentaire c
    JOIN users u ON c.id_users = u.id
    WHERE c.id_projet = :id_projet
    ORDER BY c.date DESC
");
$stmt->execute(['id_projet' => $projet['id']]);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Projet - " . htmlspecialchars($projet['name']);
include_once "../includes/components/head.php";
?>

<body>
    <?php include_once "../includes/components/header.php"; ?>
    <div class="project">
        <div class="title-project">
            <h1><?= htmlspecialchars($projet['type']) ?></h1>
            <h2><?= htmlspecialchars($projet['name']) ?></h2>
        </div>
        <img src="<?= htmlspecialchars($projet['img_1']) ?>" alt="image projet">
        <div class="text text-project">
            <p><?= $texte1 ?></p>
            <p><?= $texte2 ?></p>
            <p><?= $texte3 ?></p>
        </div>
        <div class="btn-project">
            <?php if (!empty($projet['github'])): ?>
            <a href="<?= htmlspecialchars($projet['github']) ?>" target="_blank">
                Le Github
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10" />
                    <path d="M7 17 17 7" />
                </svg>
            </a>
            <?php endif; ?>

            <?php if (!empty($projet['lien'])): ?>
            <a href="<?= htmlspecialchars($projet['lien']) ?>" target="_blank">
                Voir le projet
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10" />
                    <path d="M7 17 17 7" />
                </svg>
            </a>
            <?php endif; ?>
        </div>
        <img src="<?= htmlspecialchars($projet['img_2']) ?>" alt="image projet">
        <img src="<?= htmlspecialchars($projet['img_3']) ?>" alt="image projet">
        <img src="<?= htmlspecialchars($projet['img_4']) ?>" alt="image projet">

        <div class="commentaire">
            <div class="form-commentaire">
                <?php if (isset($_SESSION['statue']) && in_array($_SESSION['statue'], ['admin', 'enseignant'])): ?>
                <form method="POST">
                    <textarea name="commentaire" rows="4" placeholder="Votre commentaire..." required></textarea>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
            <div class="liste-commentaires">
                <?php foreach ($commentaires as $com): ?>
                <div class="commentaire-item">
                    <strong><?= htmlspecialchars($com['users']) ?></strong><br>
                    <small><?= date('d/m/Y H:i', strtotime($com['date'])) ?></small>
                    <p><?= nl2br(htmlspecialchars($com['commentaire'])) ?></p>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include_once "../includes/components/footer.php"; ?>
</body>

</html>