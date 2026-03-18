<?php
require_once __DIR__ . "/db.php";
$db = getDB();

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}

$commandeId = (int)($_GET['commande_id'] ?? 0);
$userId = (int)$_SESSION['user']['id'];

$q = $db->prepare("SELECT * FROM commandes WHERE id = ? AND utilisateur_id = ?");
$q->execute([$commandeId, $userId]);
$commande = $q->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande introuvable.");
}

$qi = $db->prepare("SELECT * FROM commande_items WHERE commande_id = ?");
$qi->execute([$commandeId]);
$items = $qi->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture | Cubic</title>
    <link rel="stylesheet" href="boutique.css">
</head>
<body>
<div class="panel">
    <div class="panel-card">
        <h1 class="panel-title">Facture #<?= (int)$commande['id'] ?></h1>
        <p class="panel-sub">Transaction : <?= htmlspecialchars($commande['transaction_id']) ?></p>
        <p class="panel-sub">Date : <?= htmlspecialchars($commande['created_at']) ?></p>

        <div class="table-wrap">
            <table class="table">
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Qté</th>
                    <th>Sous-total</th>
                </tr>
                <?php foreach ($items as $it): ?>
                    <tr>
                        <td><?= htmlspecialchars($it['nom_produit']) ?></td>
                        <td><?= number_format($it['prix_unitaire'], 2, ',', ' ') ?> €</td>
                        <td><?= (int)$it['quantite'] ?></td>
                        <td><?= number_format($it['prix_unitaire'] * $it['quantite'], 2, ',', ' ') ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="total-box">
            Total payé : <strong><?= number_format($commande['total'], 2, ',', ' ') ?> €</strong>
        </div>

        <div class="actions">
            <a class="btn-outline" href="historique.php">Voir historique</a>
            <a class="btn-outline" href="boutique.php">Retour boutique</a>
        </div>
    </div>
</div>
</body>
</html>