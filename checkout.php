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
require_once 'html_chekout.html';
?>
