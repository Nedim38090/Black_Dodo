<?php

require_once __DIR__ . "/db.php";

$db = getDB();

$erreurs = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if ($username == "" || $email == "" || $password == "") {
        $erreurs = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs = "Format d'email invalide.";
    } else {
        $check = $db->prepare("SELECT id FROM utilisateurs WHERE email = ? OR username = ?");
        $check->execute([$email, $username]);
        if ($check->fetch()) {
            $erreurs = "Pseudo ou email déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $q = $db->prepare("INSERT INTO utilisateurs (username, email, password, role) VALUES (?, ?, ?, 'joueur')");

            if ($q->execute([$username, $email, $hash])) {
                $succes = "Inscription réussie ! <a href='connexion.php'>Connectez-vous ici</a>";
            } else {
                $erreurs = "Une erreur est survenue lors de l'inscription.";
            }
        }
    }
}
require_once __DIR__ . "/html_inscription.html";
?>


