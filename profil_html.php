
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil | Cubic</title>
    <link rel="stylesheet" href="profil_css.css">
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
