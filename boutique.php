<?php
require_once __DIR__ . "/db.php";
$db = getDB();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!estConnecte()) {
        header("Location: connexion.php");
        exit;
    }

    $pid = (int)($_POST['produit_id'] ?? 0);
    $qty = max(1, (int)($_POST['quantite'] ?? 1));

    $q = $db->prepare("SELECT id, nom, prix, actif FROM produits WHERE id = ?");
    $q->execute([$pid]);
    $p = $q->fetch(PDO::FETCH_ASSOC);

    if ($p && (int)$p['actif'] === 1) {
        if (!isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid] = [
                'id' => (int)$p['id'],
                'nom' => $p['nom'],
                'prix' => (float)$p['prix'],
                'quantite' => 0
            ];
        }
        $_SESSION['cart'][$pid]['quantite'] += $qty;
    }

    header("Location: boutique.php");
    exit;
}

$produits = $db->query("
    SELECT id, nom, prix, categorie, image_url
    FROM produits
    WHERE actif = 1
    ORDER BY categorie, nom
")->fetchAll(PDO::FETCH_ASSOC);

$parCategorie = [];
foreach ($produits as $p) {
    $cat = $p['categorie'] ?: 'Divers';
    $parCategorie[$cat][] = $p;
}

$cartCount = 0;
foreach ($_SESSION['cart'] as $it) $cartCount += (int)$it['quantite'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique | Cubic</title>
    <link rel="stylesheet" href="boutique.css">
</head>
<body>
<div class="shop-wrap">
    <div class="shop-top">
        <h1 class="shop-title">Boutique <span>Cubic</span></h1>
        <a class="shop-link" href="panier.php">Voir mon panier (<?= $cartCount ?>)</a>
    </div>

    <?php if (empty($parCategorie)): ?>
        <div class="panel-card"><p class="panel-sub">Aucun produit disponible.</p></div>
    <?php else: ?>
        <?php foreach ($parCategorie as $cat => $items): ?>
            <h2 class="cat-title"><?= htmlspecialchars($cat) ?></h2>
            <div class="products-grid">
                <?php foreach ($items as $p): ?>
                    <div class="product-card">
                        <div class="product-img" style="background-image:url('<?= htmlspecialchars($p['image_url'] ?: 'https://images.unsplash.com/photo-1627856013091-fed6e4e30025?q=80&w=1000&auto=format&fit=crop') ?>')"></div>
                        <div class="product-body">
                            <h3 class="product-name"><?= htmlspecialchars($p['nom']) ?></h3>
                            <div class="product-price"><?= number_format((float)$p['prix'], 2, ',', ' ') ?> €</div>
                            <form method="POST" class="product-form">
                                <input type="hidden" name="produit_id" value="<?= (int)$p['id'] ?>">
                                <input class="qty-input" type="number" name="quantite" value="1" min="1">
                                <button class="btn-small" type="submit" name="add_to_cart">Ajouter</button>

                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
