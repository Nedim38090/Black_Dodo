<?php
require_once __DIR__ . "/db.php";
$db = getDB();

if (isset($_POST['acheter_produit'])) {
    if (!estConnecte()) {
        header("Location: connexion.php");
        exit;
    }

    $u_id = $_SESSION['user']['id'];
    $p_id = $_POST['produit'];
    $nom = encryptData($_POST['nom']);
    $prenom = encryptData($_POST['prenom']);
    $cb = encryptData($_POST['carte_bleue']);
    $ccb = encryptData($_POST['ccb']);
    $trans_id = "CUBIC-" . strtoupper(uniqid());

    try {
        $stmt_prix = $db->prepare("SELECT prix FROM produits WHERE id = ?");
        $stmt_prix->execute([$p_id]);
        $prix = $stmt_prix->fetchColumn() ?: 0;

        $sql = "INSERT INTO achats (utilisateur_id, produit_id, prix_paye, transaction_id, statut, nom, prenom, carte_bleue, ccb) 
                VALUES (:u_id, :p_id, :prix, :t_id, 'termine', :nom, :prenom, :cb, :ccb)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'u_id' => $u_id, 'p_id' => $p_id, 'prix' => $prix, 't_id' => $trans_id,
            'nom'  => $nom, 'prenom' => $prenom, 'cb'   => $cb, 'ccb'  => $ccb
        ]);

        echo "<script>alert('Achat réussi !'); window.location.href='index.php';</script>";
        exit;
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
require_once __DIR__ . "/Achat_html.php";