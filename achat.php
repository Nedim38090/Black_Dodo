<?php
// Black_Dodo/achat.php
require_once __DIR__ . "/db.php";
$db = getDB();

if (isset($_POST['acheter_produit'])) {
    // Vérification de la connexion
    if (!isset($_SESSION['user'])) {
        header("Location: connexion.php");
        exit;
    }

    $u_id = $_SESSION['user']['id'];
    $p_id = $_POST['produit'];

    // Chiffrement des données sensibles via les fonctions de db.php
    $nom = encryptData($_POST['nom']);
    $prenom = encryptData($_POST['prenom']);
    $cb = encryptData($_POST['carte_bleue']);
    $ccb = encryptData($_POST['ccb']);

    $trans_id = "CUBIC-" . strtoupper(uniqid());

    try {
        // Récupération du prix réel du produit
        $stmt_prix = $db->prepare("SELECT prix FROM produits WHERE id = ?");
        $stmt_prix->execute([$p_id]);
        $res = $stmt_prix->fetch();
        $prix = $res ? $res['prix'] : 0;

        // Insertion en base de données
        $sql = "INSERT INTO achats (utilisateur_id, produit_id, prix_paye, transaction_id, statut, nom, prenom, carte_bleue, ccb) 
                VALUES (:u_id, :p_id, :prix, :t_id, 'termine', :nom, :prenom, :cb, :ccb)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'u_id' => $u_id,
            'p_id' => $p_id,
            'prix' => $prix,
            't_id' => $trans_id,
            'nom'  => $nom,
            'prenom' => $prenom,
            'cb'   => $cb,
            'ccb'  => $ccb
        ]);

        echo "<script>alert('Achat sécurisé enregistré !'); window.location.href='index.php';</script>";
        exit;

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}

// On appelle le fichier de vue à la fin
require_once __DIR__ . "/Achat_html.php";