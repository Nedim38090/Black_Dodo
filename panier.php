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
require_once 'html_panier.html'
?>
