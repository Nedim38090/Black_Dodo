<?php


require_once __DIR__ . "/db.php";
$db = getDB();

$erreurs = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if ($email == "" || $password == "") {
        $erreurs = "Email et mot de passe obligatoires.";
    } else {
        $q = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $q->execute([$email]);
        $user = $q->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user["id"],
                "email" => $user["email"],
                "username" => $user["username"],
                "role" => $user["role"]
            ];
            header("Location: index.php");
            exit;
        } else {
            $erreurs = "Identifiants invalides.";
        }
    }

}

require_once __DIR__ . "/html_connexion.html";
?>

