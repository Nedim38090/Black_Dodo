<?php
// On importe la logique au tout début
require_once __DIR__ . "/connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | Cubic</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rajdhani', sans-serif; background-color: #0f1011; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .auth-card { background: #1a1c1e; padding: 40px; border-radius: 10px; border: 1px solid #333; width: 100%; max-width: 400px; }
        h1 { color: #3498db; text-align: center; text-transform: uppercase; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 12px; background: #080808; border: 1px solid #333; color: white; border-radius: 5px; }
        .btn-submit { width: 100%; background: #3498db; color: white; border: none; padding: 15px; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .error { color: #ff4757; background: rgba(255, 71, 87, 0.1); padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="auth-card">
    <h1>Connexion</h1>

    <?php if($erreurs): ?>
        <div class="error"><?= htmlspecialchars($erreurs); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <button type="submit" class="btn-submit">Se connecter</button>
    </form>

    <p style="text-align: center; margin-top: 20px; font-size: 0.8rem;">
        <a href="../index.php" style="color: #666; text-decoration: none;">← Retour à l'accueil</a>
    </p>
</div>

</body>
</html>