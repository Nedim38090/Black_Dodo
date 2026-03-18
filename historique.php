<?php
require_once __DIR__ . "/db.php";

if (!estConnecte()) {
    header("Location: connexion.php");
    exit;
}

$db = getDB();
$userId = (int)$_SESSION["user"]["id"];

$qAchats = $db->prepare("
    SELECT a.id, a.date_achat, a.prix_paye, a.transaction_id, a.statut, p.nom AS produit
    FROM achats a
    JOIN produits p ON p.id = a.produit_id
    WHERE a.utilisateur_id = ?
    ORDER BY a.date_achat DESC
");
$qAchats->execute([$userId]);
$achats = $qAchats->fetchAll(PDO::FETCH_ASSOC);

$qSanctions = $db->prepare("
    SELECT type, raison, date_sanction, est_actif
    FROM sanctions
    WHERE utilisateur_id = ?
    ORDER BY date_sanction DESC
");
$qSanctions->execute([$userId]);
$sanctions = $qSanctions->fetchAll(PDO::FETCH_ASSOC);
require_once 'html_historique.html'
?>

