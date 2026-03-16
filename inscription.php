
<?php
require_once (fonction_securite.php);
require_once (db.php);
session_start();

$users = [];
$erreurs = "";
$message = "";

$users[] = [
    "email" => "admin@test.com",
    "username" => "admin",
    "password_hash" => password_hash("admin123", PASSWORD_DEFAULT),
    "role" => "admin"
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if ($action == "register") {
        if ($email == "" || $username == "" || $password == "") {
            $erreurs = "Tous les champs doivent être remplis.";
        } else {
            $existe = false;

            foreach ($users as $u) {
                if ($u["email"] == $email || $u["username"] == $username) {
                    $existe = true;
                }
            }

            if ($existe) {
                $erreurs = "Email ou pseudo déjà utilisé.";
            } else {
                $users[] = [
                    "email" => $email,
                    "username" => $username,
                    "password_hash" => password_hash($password, PASSWORD_DEFAULT),
                    "role" => "player"
                ];

                $message = "Utilisateur ajouté : " . htmlspecialchars($username);
            }
        }
    }

    if ($action == "login") {
        if ($email == "" || $password == "") {
            $erreurs = "Email et mot de passe obligatoires.";
        } else {
            $ok = false;

            foreach ($users as $u) {
                if ($u["email"] == $email && password_verify($password, $u["password_hash"])) {
                    $_SESSION["user"] = $u;
                    $ok = true;
                }
            }

            if ($ok) {
                $message = "Connexion réussie : " . htmlspecialchars($_SESSION["user"]["username"]);
            } else {
                $erreurs = "Identifiants invalides.";
            }
        }
    }

    if ($action == "logout") {
        unset($_SESSION["user"]);
        $message = "Déconnexion réussie.";
    }
}


?>

<h1>Système d'Authentification</h1>

<div class="form-container">
    <?php if ($erreurs): ?>
        <p class="error"><?= htmlspecialchars($erreurs); ?></p>
    <?php endif; ?>

    <?php if ($message): ?>
        <p class="success"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION["user"])): ?>

        <h2>Inscription</h2>
        <form method="POST" action="">
            <input type="hidden" name="action" value="register">
            <p>Email : <input type="text" name="email"></p>
            <p>Pseudo : <input type="text" name="username"></p>
            <p>Mot de passe : <input type="password" name="password"></p>
            <p><button type="submit">S'inscrire</button></p>
        </form>

        <h2>Connexion</h2>
        <form method="POST" action="">
            <input type="hidden" name="action" value="login">
            <p>Email : <input type="text" name="email"></p>
            <p>Mot de passe : <input type="password" name="password"></p>
            <p><button type="submit">Se connecter</button></p>
        </form>

        <p>Compte admin test : admin@test.com / admin123</p>

    <?php else: ?>

        <h2>Espace connecté</h2>
        <p>Nom : <?= htmlspecialchars($_SESSION["user"]["username"]); ?></p>
        <p>Email : <?= htmlspecialchars($_SESSION["user"]["email"]); ?></p>
        <p>Rôle : <?= htmlspecialchars($_SESSION["user"]["role"]); ?></p>

        <?php if (is_admin()): ?>
            <p>Accès Back-Office : OUI (admin)</p>
        <?php else: ?>
            <p>Accès Back-Office : NON</p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="action" value="logout">
            <p><button type="submit">Se déconnecter</button></p>
        </form>

    <?php endif; ?>
</div>