<?php
require_once __DIR__ . "/db.php";

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $pid = (int)$_POST['remove'];
        unset($_SESSION['cart'][$pid]);
    }

    if (isset($_POST['update'])) {
        foreach ($_POST['qty'] ?? [] as $pid => $q) {
            $pid = (int)$pid;
            $q = (int)$q;
            if (isset($_SESSION['cart'][$pid])) {
                if ($q <= 0) unset($_SESSION['cart'][$pid]);
                else $_SESSION['cart'][$pid]['quantite'] = $q;
            }
        }
    }

    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
    }

    header("Location: panier.php");
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $it) $total += $it['prix'] * $it['quantite'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier | Cubic</title>
    <link rel="stylesheet" href="boutique.css">
</head>
<body>
<div class="panel">
    <div class="panel-card">
        <h1 class="panel-title">Mon Panier</h1>
        <p class="panel-sub"><a class="shop-link" href="boutique.php">← Continuer mes achats</a></p>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="panel-sub">Votre panier est vide.</p>
        <?php else: ?>
            <form method="POST">
                <div class="table-wrap">
                    <table class="table">
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Qté</th>
                            <th>Sous-total</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($_SESSION['cart'] as $it): ?>
                            <tr>
                                <td><?= htmlspecialchars($it['nom']) ?></td>
                                <td><?= number_format($it['prix'], 2, ',', ' ') ?> €</td>
                                <td>
                                    <input class="qty-input" type="number" min="1" name="qty[<?= (int)$it['id'] ?>]" value="<?= (int)$it['quantite'] ?>">
                                </td>
                                <td><?= number_format($it['prix'] * $it['quantite'], 2, ',', ' ') ?> €</td>
                                <td><button class="btn-small" name="remove" value="<?= (int)$it['id'] ?>">Supprimer</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="total-box">Total : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong></div>

                <div class="actions">
                    <button class="btn-small" type="submit" name="update">Mettre à jour</button>
                    <button class="btn-outline" type="submit" name="clear_cart">Vider le panier</button>
                    <a class="btn-primary" href="checkout.php">Passer la commande</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
