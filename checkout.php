<?php
require_once __DIR__ . "/db.php";
$db = getDB();

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}
if (empty($_SESSION['cart'])) {
    header("Location: panier.php");
    exit;
}

$userId = (int)$_SESSION['user']['id'];
$erreur = "";

$total = 0;
foreach ($_SESSION['cart'] as $it) $total += $it['prix'] * $it['quantite'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $cb = trim($_POST['carte_bleue'] ?? '');
    $ccb = trim($_POST['ccb'] ?? '');

    if ($nom === '' || $prenom === '' || !preg_match('/^\d{16}$/', $cb) || !preg_match('/^\d{3,4}$/', $ccb)) {
        $erreur = "Informations de paiement invalides.";
    } else {
        try {
            $db->beginTransaction();

            $tx = "CUBIC-" . strtoupper(uniqid());

            $q = $db->prepare("INSERT INTO commandes (utilisateur_id, total, transaction_id, statut) VALUES (?, ?, ?, 'payee')");
            $q->execute([$userId, $total, $tx]);
            $commandeId = (int)$db->lastInsertId();

            $qi = $db->prepare("INSERT INTO commande_items (commande_id, produit_id, nom_produit, prix_unitaire, quantite) VALUES (?, ?, ?, ?, ?)");
            $qa = $db->prepare("INSERT INTO achats (utilisateur_id, produit_id, prix_paye, transaction_id, statut, nom, prenom, carte_bleue, ccb) VALUES (?, ?, ?, ?, 'termine', ?, ?, ?, ?)");

            foreach ($_SESSION['cart'] as $it) {
                $qi->execute([$commandeId, $it['id'], $it['nom'], $it['prix'], $it['quantite']]);

                for ($i = 0; $i < $it['quantite']; $i++) {
                    $qa->execute([
                        $userId,
                        $it['id'],
                        $it['prix'],
                        $tx,
                        encryptData($nom),
                        encryptData($prenom),
                        encryptData($cb),
                        encryptData($ccb)
                    ]);
                }
            }

            $db->commit();
            $_SESSION['cart'] = [];
            header("Location: facture.php?commande_id=".$commandeId);
            exit;
        } catch (Exception $e) {
            $db->rollBack();
            $erreur = "Erreur lors de la commande.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Cubic</title>
    <link rel="stylesheet" href="boutique.css">
</head>
<body>
<div class="panel">
    <div class="panel-card" style="max-width:700px;">
        <h1 class="panel-title">Validation de commande</h1>
        <p class="panel-sub">Total à payer : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong></p>

        <?php if ($erreur): ?>
            <div class="alert-error"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="checkout-grid">
                <div>
                    <label class="label">Nom</label>
                    <input class="input" type="text" name="nom" required>
                </div>
                <div>
                    <label class="label">Prénom</label>
                    <input class="input" type="text" name="prenom" required>
                </div>
            </div>

            <div style="margin-top:12px;">
                <label class="label">Carte (16 chiffres)</label>
                <input class="input" type="text" name="carte_bleue" pattern="\d{16}" maxlength="16" required>
            </div>

            <div style="margin-top:12px;">
                <label class="label">CCB</label>
                <input class="input" type="password" name="ccb" pattern="\d{3,4}" maxlength="4" required>
            </div>

            <div class="actions">
                <button class="btn-primary" type="submit" name="confirm_order">Payer maintenant</button>
                <a class="btn-outline" href="panier.php">Retour panier</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>