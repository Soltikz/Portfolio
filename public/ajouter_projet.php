<?php
require_once 'connexion.php';
// Dossier de destination correct
$uploadDir = 'assets/images/projet/';

// Créer le dossier s'il n'existe pas
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Fonction d’upload
function uploadImage($fieldName, $uploadDir) {
    if (!isset($_FILES[$fieldName])) {
        echo "Champ '$fieldName' non trouvé dans \$_FILES.<br>";
        return null;
    }

    $error = $_FILES[$fieldName]['error'];
    if ($error !== UPLOAD_ERR_OK) {
        echo "Erreur lors de l’upload de '$fieldName' : code $error<br>";
        return null;
    }

    $tmpName = $_FILES[$fieldName]['tmp_name'];
    $originalName = basename($_FILES[$fieldName]['name']);
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);

    $safeName = uniqid($fieldName . '_', true) . '.' . $extension;
    $destination = $uploadDir . $safeName;

    if (move_uploaded_file($tmpName, $destination)) {
        echo "Image '$fieldName' téléchargée avec succès : $destination<br>";
        return $destination;
    } else {
        echo "Échec du déplacement de l’image '$fieldName'.<br>";
        return null;
    }
}

// Liste des champs
$imageFields = ['img_1', 'img_2', 'img_3', 'img_4'];
$uploadedImages = [];

foreach ($imageFields as $field) {
    $uploadedImages[$field] = uploadImage($field, $uploadDir);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bdd = connexion();

    $type = $_POST['type'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $ac_pro = $_POST['ac_pro'];
    $texte_1_pro = $_POST['texte_1_pro'];
    $texte_2_pro = $_POST['texte_2_pro'];
    $texte_3_pro = $_POST['texte_3_pro'];
    $texte_1_ac = $_POST['texte_1_ac'];
    $texte_2_ac = $_POST['texte_2_ac'];
    $texte_3_ac = $_POST['texte_3_ac'];
    $github = $_POST['github'];
    $lien = $_POST['lien'];

    // Utiliser texte_1_ac si texte_1_pro est vide ou null
    $description = !empty(trim($texte_1_pro)) ? $texte_1_pro : $texte_1_ac;

    try {
        // Insertion dans production
        $sqlProd = "INSERT INTO production (date, name, description, image, ac_pro) VALUES (:date, :name, :description, :image, :ac_pro)";
        $stmtProd = $bdd->prepare($sqlProd);
        $stmtProd->execute([
            ':date' => $date,
            ':name' => $name,
            ':description' => $description,
            ':image' => $uploadedImages['img_1'],
            ':ac_pro' => $ac_pro
        ]);
        echo "Insertion dans production réussie.<br>";

        // Insertion dans projet
        $sqlProj = "INSERT INTO projets 
            (type, name, texte_1_pro, texte_2_pro, texte_3_pro, texte_1_ac, texte_2_ac, texte_3_ac, github, lien, img_1, img_2, img_3, img_4)
            VALUES
            (:type, :name, :texte_1_pro, :texte_2_pro, :texte_3_pro, :texte_1_ac, :texte_2_ac, :texte_3_ac, :github, :lien, :img_1, :img_2, :img_3, :img_4)";
        $stmtProj = $bdd->prepare($sqlProj);
        $stmtProj->execute([
            ':type' => $type,
            ':name' => $name,
            ':texte_1_pro' => $texte_1_pro,
            ':texte_2_pro' => $texte_2_pro,
            ':texte_3_pro' => $texte_3_pro,
            ':texte_1_ac' => $texte_1_ac,
            ':texte_2_ac' => $texte_2_ac,
            ':texte_3_ac' => $texte_3_ac,
            ':github' => $github,
            ':lien' => $lien,
            ':img_1' => $uploadedImages['img_1'],
            ':img_2' => $uploadedImages['img_2'],
            ':img_3' => $uploadedImages['img_3'],
            ':img_4' => $uploadedImages['img_4']
        ]);
        echo "Insertion dans projet réussie.<br>";
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Ajout Projet";
include_once "../includes/components/head.php";
?>

<body class="body">
    <?php include_once "../includes/components/header.php" ?>
    <form method="post" enctype="multipart/form-data" class="form" style="margin-top: 100px;">
        <legend>Ajouter un projet</legend>

        <div class="input-group">
            <input type="text" id="type" name="type" required>
            <label for="type">Type du projet</label>
        </div>

        <div class="input-group">
            <input type="text" id="name" name="name" required>
            <label for="name">Nom du projet</label>
        </div>

        <div class="input-group">
            <input type="int" id="date" name="date" required>
            <label for="date">Date</label>
        </div>

        <div class="input-group">
            <input type="text" id="ac_pro" name="ac_pro" required>
            <label for="ac_pro">Type (Professionel, Academique ou les deux)</label>
        </div>

        <div class="input-group">
            <input type="file" id="img_1" name="img_1" accept="image/*">
            <label for=" img_1">Image 1 (img_1)</label>
        </div>

        <div class="input-group">
            <textarea id="texte_1_pro" name="texte_1_pro" rows="3" placeholder="Texte 1 projet"></textarea>
        </div>

        <div class="input-group">
            <textarea id="texte_2_pro" name="texte_2_pro" rows="3" placeholder="Texte 2 projet"></textarea>
        </div>

        <div class="input-group">
            <textarea id="texte_3_pro" name="texte_3_pro" rows="3" placeholder="Texte 3 projet"></textarea>
        </div>

        <div class="input-group">
            <textarea id="texte_1_ac" name="texte_1_ac" rows="3" placeholder="Texte 1 academique"></textarea>
        </div>

        <div class="input-group">
            <textarea id="texte_2_ac" name="texte_2_ac" rows="3" placeholder="Texte 2 academique"></textarea>
        </div>

        <div class="input-group">
            <textarea id="texte_3_ac" name="texte_3_ac" rows="3" placeholder="Texte 3 academique"></textarea>
        </div>

        <div class="input-group">
            <input type="url" id="github" name="github" placeholder="https://github.com/username/projet">
            <label for="github">Lien GitHub</label>
        </div>

        <div class="input-group">
            <input type="url" id="lien" name="lien" placeholder="https://monprojet.com">
            <label for="lien">Lien du projet</label>
        </div>

        <div class="input-group">
            <input type="file" id="img_2" name="img_2" accept="image/*">
            <label for="img_2">Image 2 (img_2)</label>
        </div>

        <div class="input-group">
            <input type="file" id="img_3" name="img_3" accept="image/*">
            <label for="img_3">Image 3 (img_3)</label>
        </div>

        <div class="input-group">
            <input type="file" id="img_4" name="img_4" accept="image/*">
            <label for="img_4">Image 4 (img_4)</label>
        </div>

        <button type="submit" class="submit-btn">Ajouter le projet</button>
    </form>
</body>

</html>