<?php
require_once __DIR__ . "/db.php";

$db = getDB();

$produits = [];
$erreur = "";

try {
    $qProduits = $db->query("SELECT id, nom, prix FROM produits ORDER BY nom ASC");
    $produits = $qProduits->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $produits = [];
    $erreur = "Impossible de charger les produits.";
}

if (isset($_POST['acheter_produit'])) {
    if (!isset($_SESSION['user']['id'])) {
        header("Location: connexion.php");
        exit;
    }

    $u_id = (int)$_SESSION['user']['id'];
    $p_id = isset($_POST['produit']) ? (int)$_POST['produit'] : 0;

    $stmtUser = $db->prepare("SELECT id FROM utilisateurs WHERE id = ?");
    $stmtUser->execute([$u_id]);
    if (!$stmtUser->fetch(PDO::FETCH_ASSOC)) {
        unset($_SESSION['user']);
        header("Location: connexion.php");
        exit;
    }

    $stmtProduit = $db->prepare("SELECT id, prix FROM produits WHERE id = ?");
    $stmtProduit->execute([$p_id]);
    $produit = $stmtProduit->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        $erreur = "Produit introuvable.";
    } else {
        $nom = encryptData(trim($_POST['nom'] ?? ''));
        $prenom = encryptData(trim($_POST['prenom'] ?? ''));
        $cb = encryptData(trim($_POST['carte_bleue'] ?? ''));
        $ccb = encryptData(trim($_POST['ccb'] ?? ''));

        $trans_id = "CUBIC-" . strtoupper(uniqid());
        $prix = $produit['prix'];

        try {
            $sql = "INSERT INTO achats (utilisateur_id, produit_id, prix_paye, transaction_id, statut, nom, prenom, carte_bleue, ccb)
                    VALUES (:u_id, :p_id, :prix, :t_id, 'termine', :nom, :prenom, :cb, :ccb)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                'u_id' => $u_id,
                'p_id' => $p_id,
                'prix' => $prix,
                't_id' => $trans_id,
                'nom' => $nom,
                'prenom' => $prenom,
                'cb' => $cb,
                'ccb' => $ccb
            ]);

            header("Location: historique.php");
            exit;
        } catch (PDOException $e) {
            $erreur = "Erreur SQL lors de l'achat.";
        }
    }
}

require_once __DIR__ . "/Achat_html.php";