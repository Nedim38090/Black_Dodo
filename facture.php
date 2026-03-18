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
require_once 'html_facture.html'
?>
