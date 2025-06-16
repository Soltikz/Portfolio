<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Connexion";
include_once "../includes/components/head.php";
?>

<body class="body">

    <div class="login-wrapper">
        <form action="connexion?action=login" method="POST" class="form">
            <div class="error">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p>' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>
            </div>
            <legend>
                <h1>Connexion</h1>
            </legend>
            <div class="input-group">
                <input type="text" name="loginUser" id="loginUser" required>
                <label for="loginUser">Nom d'utilisateur</label>
            </div>
            <div class="input-group">
                <input type="password" name="loginPassword" id="loginPassword" required>
                <label for="loginPassword">Mot de passe</label>
            </div>
            <div class="btn-submit">
                <input type="submit" value="Connectez-Vous" class="submit-btn">
                <a href="inscription.php" class="submit-btn">Créez-vous un compte</a>
            </div>
        </form>
    </div>
</body>

</html>