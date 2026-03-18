<?php
?>
<link rel="stylesheet" href="inscription_css.css">
<div class="auth-card">
    <h1>Créer un compte</h1>

    <?php if(!empty($erreurs)): ?>
        <p class="error" style="color: red;"><?= $erreurs ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Pseudo" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>

    <p style="text-align: center; margin-top: 15px; font-size: 0.9em;">
        Déjà un compte ? <a href="connexion.php" style="color: #3498db; text-decoration: none; font-weight: bold;">Connectez-vous</a>
    </p>
</div>