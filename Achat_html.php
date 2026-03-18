<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement Sécurisé | Cubic</title>
    <link rel="stylesheet" href="boutique.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="auth-card" style="max-width:650px; margin:40px auto; padding:30px; background:#111622; border:1px solid #2a3650; border-radius:12px;">
    <h1 style="text-align:center; margin-bottom:15px;">PAIEMENT <span style="color:#8b5cf6;">SÉCURISÉ</span></h1>

    <?php if (!empty($erreur)): ?>
        <p style="color:#ff6b81; text-align:center; margin-bottom:10px;"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if (empty($produits)): ?>
        <p style="text-align:center;">Aucun produit disponible pour le moment.</p>
    <?php else: ?>
        <form action="achat.php" method="POST">
            <div class="form-group" style="margin-bottom:12px;">
                <label>PRODUIT CUBIC</label>
                <select name="produit" class="form-control" required style="width:100%; padding:10px;">
                    <option value="" disabled selected>Choisir un article...</option>
                    <?php foreach ($produits as $p): ?>
                        <option value="<?= (int)$p['id'] ?>">
                            <?= htmlspecialchars($p['nom']) ?> - <?= htmlspecialchars($p['prix']) ?> €
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom:12px;">
                <div style="flex:1;">
                    <label>NOM</label>
                    <input type="text" name="nom" class="form-control" required style="width:100%; padding:10px;">
                </div>
                <div style="flex:1;">
                    <label>PRÉNOM</label>
                    <input type="text" name="prenom" class="form-control" required style="width:100%; padding:10px;">
                </div>
            </div>

            <div style="margin-bottom:12px;">
                <label>NUMÉRO DE CARTE</label>
                <input type="text" name="carte_bleue" class="form-control" maxlength="16" pattern="\d{16}" required style="width:100%; padding:10px;">
            </div>

            <div style="margin-bottom:18px;">
                <label>CODE CCB</label>
                <input type="password" name="ccb" class="form-control" maxlength="4" pattern="\d{3,4}" required style="width:100%; padding:10px;">
            </div>

            <button type="submit" name="acheter_produit" style="width:100%; padding:12px; background:#8b5cf6; color:white; border:none; border-radius:8px; font-weight:bold;">
                CONFIRMER LE PAIEMENT
            </button>
        </form>
    <?php endif; ?>

    <div style="margin-top:15px; text-align:center;">
        <a href="index.php" style="color:#c4b5fd;">← Retour</a>
    </div>
</div>

</body>
</html>