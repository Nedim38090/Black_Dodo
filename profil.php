<?php
<?php
require_once "db.php";
require_once "functions.php"; // Pour estConnecte()

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}

$db = getDB();
$userId = $_SESSION['user']['id'];
$message = "";

// LOGIQUE DE MISE À JOUR
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $desc = htmlspecialchars($_POST['description']);
    $discord = htmlspecialchars($_POST['discord']);
    $twitter = htmlspecialchars($_POST['twitter']);

    $stmt = $db->prepare("UPDATE utilisateurs SET description_profil = ?, discord_id = ?, twitter_handle = ? WHERE id = ?");
    if ($stmt->execute([$desc, $discord, $twitter, $userId])) {
        $message = "Profil mis à jour !";
    }
}

// RÉCUPÉRATION DES INFOS ACTUELLES
$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil | Cubic</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .profile-container { max-width: 800px; margin: 50px auto; background: #1a1c1e; padding: 30px; border-radius: 10px; border: 1px solid #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; color: var(--primary); margin-bottom: 5px; font-weight: bold; }
        textarea, input { width: 100%; padding: 12px; background: #080808; border: 1px solid #333; color: white; border-radius: 5px; }
        .success { color: var(--secondary); margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Personnaliser mon Profil</h1>

        <?php if($message): ?>
            <p class="success"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Ma Description</label>
                <textarea name="description" rows="4"><?= htmlspecialchars($user['description_profil']) ?></textarea>
            </div>

            <div class="form-group">
                <label>ID Discord</label>
                <input type="text" name="discord" value="<?= htmlspecialchars($user['discord_id']) ?>" placeholder="Ex: Pseudo#1234">
            </div>

            <div class="form-group">
                <label>Lien Twitter / X</label>
                <input type="text" name="twitter" value="<?= htmlspecialchars($user['twitter_handle']) ?>" placeholder="Ex: @CubicServer">
            </div>

            <button type="submit" class="btn-primary">Enregistrer les modifications</button>
        </form>
        <p style="margin-top: 20px;"><a href="index.php" style="color: #666;">← Retour</a></p>
    </div>
</body>
</html>