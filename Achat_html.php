<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement Sécurisé | Cubic</title>
    <link rel="stylesheet" href="achat_css.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="auth-card">
    <h1>PAIEMENT <span>SÉCURISÉ</span></h1>

    <p style="text-align: center; color: #444; font-size: 0.8rem; margin-bottom: 20px; font-weight: bold;">
        [ SYSTÈME DE CHIFFREMENT AES-256 ACTIF ]
    </p>

    <form action="achat.php" method="POST">
        <div class="form-group">
            <label>PRODUIT CUBIC</label>
            <select name="produit" class="form-control" required>
                <option value="" disabled selected>Choisir un article...</option>
                <option value="1">Cacahuètes - 5€</option>
                <option value="2">Frites - 3€</option>
                <option value="3">Boisson - 2€</option>
                <option value="4">Pop Corn - 4€</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <div class="form-group" style="flex: 1;">
                <label>NOM</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>PRÉNOM</label>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
            </div>
        </div>

        <div class="form-group">
            <label>NUMÉRO DE CARTE (16 CHIFFRES)</label>
            <input type="text" name="carte_bleue" class="form-control" maxlength="16" pattern="\d{16}" placeholder="0000 0000 0000 0000" required>
        </div>

        <div class="form-group">
            <label>CODE CCB</label>
            <input type="password" name="ccb" class="form-control" maxlength="4" pattern="\d{3,4}" placeholder="123" required>
        </div>

        <button type="submit" name="acheter_produit" class="btn-submit">CONFIRMER LE PAIEMENT</button>
    </form>

    <div class="auth-footer">
        <a href="index.php">← Annuler et retour</a>
    </div>
</div>

</body>
</html>