<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Créer votre compte";
include_once "../includes/components/head.php";
?>

<body class="body">
    <div class="login-wrapper">
        <form action="connexion?action=signup" method="POST" class="form-inscrip form">
            <div class="error">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p>' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>
            </div>
            <legend>
                <h1>Créer votre compte</h1>
            </legend>

            <div class="input-group">
                <input type="text" name="loginName" id="loginName" required>
                <label for="loginName">Nom</label>
            </div>

            <div class="input-group">
                <input type="text" name="loginFirstName" id="loginFirstName" required>
                <label for="loginFirstName">Prénom</label>
            </div>

            <div class="input-group">
                <input type="email" name="loginEmail" id="loginEmail" required>
                <label for="loginEmail">Adresse Mail</label>
            </div>

            <div class="input-group">
                <input type="text" name="loginUser" id="loginUser" required>
                <label for="loginUser">Nom d'utilisateur</label>
            </div>

            <div class="input-group">
                <input type="password" name="loginPassword" id="loginPassword" required autocomplete="off">
                <label for="loginPassword">Mot de passe</label>
            </div>

            <div class="input-group">
                <select name="loginStatus" id="loginStatus" required>
                    <option value="" disabled selected hidden>Choisissez un statut</option>
                    <option value="etudiant">Étudiant</option>
                    <option value="enseignant">Enseignant</option>
                </select>
            </div>

            <div class="btn-submit">
                <input type="submit" value="Créer votre compte" class="submit-btn">
        </form>
    </div>
</body>

</html>