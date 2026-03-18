<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil | Cubic</title>
    <link rel="stylesheet" href="profil_css.css">
</head>
<body>
<div class="profile-wrap">

    <aside class="profile-card">
        <img class="avatar"
             src="<?= htmlspecialchars(!empty($user["avatar"]) ? $user["avatar"] : "uploads/avatars/default.png") ?>"
             alt="Avatar">
        <h2><?= htmlspecialchars($user["username"] ?? "Joueur") ?></h2>
        <p class="role"><?= htmlspecialchars($user["role"] ?? "joueur") ?></p>

        <div class="profile-links">
            <a href="index.php">Accueil</a>
            <a href="historique.php">Historique</a>
            <a href="deconnexion.php">Déconnexion</a>
        </div>
    </aside>

    <main class="profile-main">
        <h1>Modifier mon profil</h1>

        <?php if ($erreur): ?>
            <div class="alert error"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <?php if ($message): ?>
            <div class="alert success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="profile-form">
            <div class="grid">
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user["username"] ?? "") ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user["email"] ?? "") ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description_profil" rows="4"><?= htmlspecialchars($user["description_profil"] ?? "") ?></textarea>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Discord</label>
                    <input type="text" name="discord_id" value="<?= htmlspecialchars($user["discord_id"] ?? "") ?>">
                </div>

                <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" name="twitter_handle" value="<?= htmlspecialchars($user["twitter_handle"] ?? "") ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Changer l’avatar</label>
                <input type="file" name="avatar">
            </div>

            <button type="submit">Enregistrer les modifications</button>
        </form>
    </main>

</div>
</body>
</html>