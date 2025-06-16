<?php
require_once 'connexion.php';

// Traitement si un formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if ($_POST['action'] === 'valider') {
        $stmt = $bdd->prepare("SELECT * FROM attente_validation WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user) {
            $stmtInsert = $bdd->prepare("INSERT INTO users (name, firstname, email, users, password, statue) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtInsert->execute([
                $user['name'],
                $user['firstname'],
                $user['email'],
                $user['users'],
                $user['password'],
                $user['statue']
            ]);
            $stmtDelete = $bdd->prepare("DELETE FROM attente_validation WHERE id = ?");
            $stmtDelete->execute([$id]);
        }
    } elseif ($_POST['action'] === 'refuser') {
        $stmt = $bdd->prepare("DELETE FROM attente_validation WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($_POST['action'] === 'supprimer') {
        $stmt = $bdd->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($_POST['action'] === 'modifier_statue') {
        $newStatue = $_POST['new_statue'];
        $stmt = $bdd->prepare("UPDATE users SET statue = ? WHERE id = ?");
        $stmt->execute([$newStatue, $id]);
    }

    header("Location: dashboard.php");
    exit();
}

$stmt = $bdd->query("SELECT * FROM attente_validation");
$attente = $stmt->fetchAll();

$stmt = $bdd->query("SELECT * FROM users");
$connexion = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Page d'accueil";
include_once "../includes/components/head.php";
?>

<style>
h1,
h2,
p {
    text-align: center;
    margin-bottom: 15px;
}

table {
    width: 100%;
    max-width: 1000px;
    margin: 40px auto;
    border-collapse: collapse;
    background: rgba(0, 0, 0, 0.7);
    color: var(--white);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    overflow: hidden;
}

th,
td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

th {
    background-color: rgba(255, 255, 255, 0.1);
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

tr:hover {
    background-color: rgba(255, 255, 255, 0.05);
}

.select-role {
    padding: 6px 12px;
    border: 1px solid var(--light-brown-lt);
    border-radius: 4px;
    background-color: #fff;
    color: #333;
    font-weight: bold;
    cursor: pointer;
    transition: border-color 0.2s ease-in-out;
}

.select-role:hover {
    border-color: var(--white);
}

.button-modifier:hover {
    background-color: var(--light-brown-lt);
}

.btn_valide_refuse {
    display: flex;
    gap: 16px;
}

button {
    border: 1px solid var(--light-brown-lt);
    color: var(--white);
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

button:hover {
    background-color: var(--light-brown-lt);
    color: var(--white);
}

.a_projet {
    margin: auto;
    padding: 15px;
    background-color: var(--light-brown-dt);
    border-radius: 12px;
}

.a_projet:hover {
    background-color: var(--light-brown-lt);
}
</style>

<body class="body">
    <?php include_once "../includes/components/header.php" ?>
    <h1 style="margin-top: 140px;">Comptes en attente de validation</h1>

    <?php if (empty($attente)): ?>
    <p>Aucun compte en attente.</p>
    <?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Utilisateur</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($attente as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['firstname']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['users']) ?></td>
            <td class="btn_valide_refuse">
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="action" value="valider">Valider</button>
                </form>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="action" value="refuser">Refuser</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <h2>Comptes validés</h2>

    <?php if (empty($connexion)): ?>
    <p>Aucun compte validé.</p>
    <?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Utilisateur</th>
            <th>Statue</th>
            <th>Action</th>
        </tr>
        <?php foreach ($connexion as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['firstname']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['users']) ?></td>
            <td>
                <form method="post" style="display: flex; align-items: center; gap: 8px;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="action" value="modifier_statue">
                    <select name="new_statue" class="select-role" required>
                        <option value="etudiant" <?= $user['statue'] === 'etudiant' ? 'selected' : '' ?>>Étudiant
                        </option>
                        <option value="enseignant" <?= $user['statue'] === 'enseignant' ? 'selected' : '' ?>>Enseignant
                        </option>
                        <option value="admin" <?= $user['statue'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                    <button type="submit">Modifier</button>
                </form>
            </td>
            <td>
                <form method="post" onsubmit="return confirm('Supprimer ce compte ?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="action" value="supprimer">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php endif; ?>

    <a href="ajouter_projet.php" class="a_projet">Ajouter un projet</a>
</body>

</html>