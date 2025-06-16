<?php
session_start(); // Démarrer la session

function connexion()
{
    $hostname = 'mysql-lucasmrtn.alwaysdata.net';
    $username = 'lucasmrtn';
    $password = 'Luc@as19072006';
    $db = 'lucasmrtn_portfoliov2';

    try {
        $bdd = new PDO("mysql:host=$hostname;dbname=$db;charset=utf8", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (PDOException $e) {
        error_log("Erreur de connexion : " . $e->getMessage());
        die("Erreur de connexion à la base de données.");
    }
}

function traiterConnexion($bdd)
{
    $username = htmlspecialchars(trim($_POST['loginUser']));
    $password = trim($_POST['loginPassword']);

    $stmt = $bdd->prepare("SELECT * FROM users WHERE users = :username");
    $stmt->execute([':username' => $username]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($users && password_verify($password, $users['password'])) {
        if ($users && password_verify($password, $users['password'])) {
    $_SESSION['users'] = $username;
    $_SESSION['statue'] = $users['statue'];
    $_SESSION['id'] = $users['id'];
    header("Location: index.php");
    exit();
}
    } else {
        $msg = $users ? "Mot de passe incorrect." : "Utilisateur non trouvé.";
        header("Location: login.php?error=" . urlencode($msg));
        exit();
    }
}

function traiterInscription($bdd)
{
    $required = ['loginName', 'loginFirstName', 'loginEmail', 'loginUser', 'loginPassword', 'loginStatus'];
    foreach ($required as $field) {
        if (!isset($_POST[$field])) {
            header("Location: inscription.php?error=" . urlencode("Tous les champs sont requis."));
            exit();
        }
    }

    $name = strtolower(htmlspecialchars($_POST['loginName']));
    $firstname = strtolower(htmlspecialchars($_POST['loginFirstName']));
    $email = htmlspecialchars($_POST['loginEmail']);
    $username = htmlspecialchars($_POST['loginUser']);
    $password = $_POST['loginPassword'];
    $statue = htmlspecialchars($_POST['loginStatus']);

    $expectedEmail = strtolower($firstname . "." . $name . "@univ-tln.fr");

    if ($email === $expectedEmail) {
        // Email universitaire : validation automatique
        $sql = "INSERT INTO users (name, firstname, email, users, password, statue) 
                VALUES (:name, :firstname, :email, :users, :password, :statue)";
        
        $stmt = $bdd->prepare($sql);

        try {
            $stmt->execute([
                ':name' => $name,
                ':firstname' => $firstname,
                ':email' => $email,
                ':users' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':statue' => $statue,
            ]);
            header("Location: index.php?success=" . urlencode("Votre compte a été automatiquement validé car vous avez une adresse mail d'enseignant de l'université de Toulon."));
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        // Email non universitaire : ajout dans la table d'attente
        $sql = "INSERT INTO attente_validation (name, firstname, email, users, password, statue) 
                VALUES (:name, :firstname, :email, :users, :password, :statue)";
        
        $stmt = $bdd->prepare($sql);

        try {
            $stmt->execute([
                ':name' => $name,
                ':firstname' => $firstname,
                ':email' => $email,
                ':users' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':statue' => $statue,
            ]);
            header("Location: index.php?info=" . urlencode("Votre compte est en attente de validation par un administrateur."));
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout en attente : " . $e->getMessage();
        }
    }
}

// Main
$bdd = connexion();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            traiterConnexion($bdd);
            break;
        case 'signup':
            traiterInscription($bdd);
            break;
    }
}
?>