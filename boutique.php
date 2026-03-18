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
require_once 'html_boutique.html';
?>

