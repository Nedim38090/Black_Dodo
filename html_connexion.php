
<?php


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | Cubic</title>
    <link rel="stylesheet" href="connexion_css.css">
</head>
<body>
    <div class="auth-card">
        <h1>Connexion</h1>

        <?php if (!empty($erreurs)): ?>
            <p style="color:red; text-align:center;"><?= htmlspecialchars($erreurs) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>

        </form>
    </div>
</body>
</html>