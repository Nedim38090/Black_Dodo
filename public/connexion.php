<?php

require_once __DIR__ . "/../config/db.php";
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
            header("Location: home.php");
            exit;
        } else {
            $erreurs = "Identifiants invalides.";
        }
    }
}
?>

<h1>Connexion</h1>
<?php if($erreurs): ?>
    <p style="color:red;"><?= htmlspecialchars($erreurs); ?></p>
<?php endif; ?>

<form method="POST">
    <p>Email : <input type="text" name="email"></p>
    <p>Mot de passe : <input type="password" name="password"></p>
    <p><button type="submit">Se connecter</button></p>
</form>

<p><a href="inscription.php">Pas encore inscrit ? Créer un compte</a></p>