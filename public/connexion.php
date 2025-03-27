<?php
session_start(); // Démarrer la session

// Fonction de connexion à la base de données
function connexion()
{
    $hostname = 'mysql-lucasmrtn.alwaysdata.net';
    $username = 'lucasmrtn';
    $password = 'Luc@as19072006';
    $db = 'lucasmrtn_portfolio';

    try {
        $bdd = new PDO("mysql:host=$hostname;dbname=$db;charset=utf8", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
$bdd = connexion();

// Vérifier l'action (connexion ou inscription)
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'login') {
        // Traitement de la connexion
        if (isset($_POST['loginUser']) && isset($_POST['loginPassword'])) {
            $username = htmlspecialchars(trim($_POST['loginUser']));
            $password = trim($_POST['loginPassword']);

            // Connexion à la base de données
            $bdd = connexion();

            // Vérifier si l'utilisateur existe
            $requete = "SELECT * FROM connexion WHERE users = :username";
            $stmt = $bdd->prepare($requete);
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Vérification du mot de passe haché
                if (password_verify($password, $user['password'])) {
                    $_SESSION['users'] = $username; // Stocker l'utilisateur dans la session
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: login.php?error=" . urlencode("Mot de passe incorrect."));
                    exit();
                }
            } else {
                header("Location: login.php?error=" . urlencode("Utilisateur non trouvé."));
                exit();
            }
        }
    } elseif ($_GET['action'] == 'signup') {
        // Traitement de l'inscription
        if (isset($_POST['loginName']) && isset($_POST['loginFirstName']) && isset($_POST['loginEmail']) && isset($_POST['loginUser']) && isset($_POST['loginPassword'])) {
            // Sécurisation des données
            $name = htmlspecialchars($_POST['loginName']);
            $firstname = htmlspecialchars($_POST['loginFirstName']);
            $email = htmlspecialchars($_POST['loginEmail']);
            $username = htmlspecialchars($_POST['loginUser']);
            $password = $_POST['loginPassword'];
            $statu = 'teacher';
        
            // Vérifier si le prénom et le nom commencent par une majuscule et les mettre en minuscules
            if (ctype_upper(substr($name, 0, 1))) {
                $name = strtolower($name);
            }
            if (ctype_upper(substr($firstname, 0, 1))) {
                $firstname = strtolower($firstname);
            }
        
            // Connexion à la base de données
            $bdd = connexion();
        
            // Vérification de l'email
            if ($email == strtolower($firstname . "." . $name . "@univ-tln.fr")) {
                // Requête préparée pour éviter l'injection SQL
                $sql = "INSERT INTO connexion (name, firstname, email, users, password, statue) VALUES (:name, :firstname, :email, :users, :password, :statue)";
                $stmt = $bdd->prepare($sql);
        
                try {
                    // Exécution de la requête
                    $stmt->execute([
                        ':name' => $name,
                        ':firstname' => $firstname,
                        ':email' => $email,
                        ':users' => $username,
                        ':password' => password_hash($password, PASSWORD_DEFAULT), // Hachage du mot de passe
                        ':statue' => $statu,
                    ]);
        
                    // Rediriger vers la page de connexion
                    header("Location: login.php");
                    exit();
                } catch (PDOException $e) {
                    // Gestion des erreurs de requête SQL
                    echo "Erreur lors de l'inscription : " . $e->getMessage();
                }
            } else {
                // Si l'email ne correspond pas, rediriger avec un message d'erreur
                header("Location: inscription.php?error=" . urlencode("L'email ne correspond pas au format requis, veuillez utiliser votre adresse mail universitaire."));
                exit();
            }
        }        
    }
}
?>