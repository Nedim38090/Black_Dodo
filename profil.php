<?php
require_once __DIR__ . "/db.php";

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}

$db = getDB();
$userId = (int)$_SESSION["user"]["id"];

$erreur = "";
$message = "";

$q = $db->prepare("SELECT id, username, email, role,description_profil FROM utilisateurs WHERE id = ?");
$q->execute(array($userId));
$user = $q->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_destroy();
    header("Location: connexion.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $description = isset($_POST["description_profil"]) ? trim($_POST["description_profil"]) : "";
    $discord = isset($_POST["discord_id"]) ? trim($_POST["discord_id"]) : "";
    $twitter = isset($_POST["twitter_handle"]) ? trim($_POST["twitter_handle"]) : "";

    if ($username === "" || $email === "") {
        $erreur = "Pseudo et email obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } else {
        $check = $db->prepare("SELECT id FROM utilisateurs WHERE (email = ? OR username = ?) AND id != ?");
        $check->execute(array($email, $username, $userId));

        if ($check->fetch()) {
            $erreur = "Pseudo ou email déjà utilisé.";
        } else {
            $avatarPath = $user["avatar"];

            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
                $allowedExt = array("jpg", "jpeg", "png", "gif", "webp");
                $fileName = $_FILES["avatar"]["name"];
                $tmp = $_FILES["avatar"]["tmp_name"];
                $size = $_FILES["avatar"]["size"];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($ext, $allowedExt)) {
                    $erreur = "Format avatar invalide.";
                } elseif ($size > 2 * 1024 * 1024) {
                    $erreur = "Avatar trop lourd (max 2 Mo).";
                } else {
                    if (!is_dir(__DIR__ . "/uploads/avatars")) {
                        mkdir(__DIR__ . "/uploads/avatars", 0777, true);
                    }
                    $newName = "avatar_" . $userId . "_" . time() . "." . $ext;
                    $dest = __DIR__ . "/uploads/avatars/" . $newName;
                    if (move_uploaded_file($tmp, $dest)) {
                        $avatarPath = "uploads/avatars/" . $newName;
                    } else {
                        $erreur = "Erreur lors de l'upload.";
                    }
                }
            }

            if ($erreur === "") {
                $up = $db->prepare("UPDATE utilisateurs SET username = ?, email = ?, avatar = ?, description_profil = ?, discord_id = ?, twitter_handle = ? WHERE id = ?");
                $up->execute(array($username, $email, $avatarPath, $description, $discord, $twitter, $userId));
                $_SESSION["user"]["username"] = $username;
                $message = "Profil mis à jour.";
                $q->execute(array($userId));
                $user = $q->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil | Cubic</title>
    <link rel="stylesheet" href="style_auth.css">
</head>
<body>
<div class="auth-card">
    <h1>Mon <span>Profil</span></h1>
    <p><a href="index.php">Accueil</a> | <a href="deconnexion.php">Déconnexion</a></p>

    <?php if ($erreur): ?><p style="color:red;"><?= htmlspecialchars($erreur) ?></p><?php endif; ?>
    <?php if ($message): ?><p style="color:green;"><?= htmlspecialchars($message) ?></p><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Pseudo</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user["username"]) ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user["email"]) ?>">
        </div>
        <div