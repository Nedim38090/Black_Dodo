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

$q = $db->prepare("SELECT id, username, email, role, description_profil, avatar, discord_id, twitter_handle FROM utilisateurs WHERE id = ?");
$q->execute([$userId]);
$user = $q->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_destroy();
    header("Location: connexion.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $description = trim($_POST["description_profil"] ?? "");
    $discord = trim($_POST["discord_id"] ?? "");
    $twitter = trim($_POST["twitter_handle"] ?? "");

    if ($username === "" || $email === "") {
        $erreur = "Pseudo et email obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } else {
        $check = $db->prepare("SELECT id FROM utilisateurs WHERE (email = ? OR username = ?) AND id != ?");
        $check->execute([$email, $username, $userId]);

        if ($check->fetch()) {
            $erreur = "Pseudo ou email déjà utilisé.";
        } else {
            $avatarPath = $user["avatar"] ?: "uploads/avatars/default.png";

            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] === 0) {
                $allowedExt = ["jpg", "jpeg", "png", "gif", "webp"];
                $fileName = $_FILES["avatar"]["name"];
                $tmp = $_FILES["avatar"]["tmp_name"];
                $size = (int)$_FILES["avatar"]["size"];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($ext, $allowedExt, true)) {
                    $erreur = "Format avatar invalide.";
                } elseif ($size > 2 * 1024 * 1024) {
                    $erreur = "Avatar trop lourd (max 2 Mo).";
                } else {
                    $dir = __DIR__ . "/uploads/avatars";
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    $newName = "avatar_" . $userId . "_" . time() . "." . $ext;
                    $dest = $dir . "/" . $newName;

                    if (move_uploaded_file($tmp, $dest)) {
                        $avatarPath = "uploads/avatars/" . $newName;
                    } else {
                        $erreur = "Erreur lors de l'upload.";
                    }
                }
            }

            if ($erreur === "") {
                $up = $db->prepare("UPDATE utilisateurs SET username = ?, email = ?, avatar = ?, description_profil = ?, discord_id = ?, twitter_handle = ? WHERE id = ?");
                $up->execute([$username, $email, $avatarPath, $description, $discord, $twitter, $userId]);

                $_SESSION["user"]["username"] = $username;
                $_SESSION["user"]["email"] = $email;

                $message = "Profil mis à jour.";

                $q->execute([$userId]);
                $user = $q->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
}
require_once 'profil_html.html';
?>
