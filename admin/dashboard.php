
<?php

require_once "../db.php";
require_once "../fonctions_session.php";

if (!estAdmin()) {
    header("Location: ../connexion.php");
    exit;
}

$db = getDB();

// --- 1. RÉCUPÉRATION DES KPI ---

// Total Joueurs
$res = $db->query("SELECT COUNT(*) FROM utilisateurs WHERE role = 'joueur'");
$totalJoueurs = $res->fetchColumn();

// Total Articles
$res = $db->query("SELECT COUNT(*) FROM articles");
$totalArticles = $res->fetchColumn();

// Chiffre d'Affaires (Somme des prix payés)
$res = $db->query("SELECT SUM(prix_paye) FROM achats");
$caTotal = $res->fetchColumn() ?: 0; // Si vide, affiche 0

// --- 2. RÉCUPÉRATION DES ALERTES (Activité récente) ---

// 5 dernières inscriptions
$dernièresInscriptions = $db->query("SELECT username, date_inscription FROM utilisateurs ORDER BY date_inscription DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

// 5 derniers achats (avec jointure pour avoir les noms)
$derniersAchats = $db->query("
    SELECT u.username, p.nom as produit, a.prix_paye, a.date_achat 
    FROM achats a
    JOIN utilisateurs u ON a.utilisateur_id = u.id
    JOIN produits p ON a.produit_id = p.id
    ORDER BY a.date_achat DESC 
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Cubic</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; margin: 20px; }
        .stats-container { display: flex; gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card h3 { margin: 0; color: #666; font-size: 14px; text-transform: uppercase; }
        .card p { font-size: 24px; font-weight: bold; margin: 10px 0 0; color: #2c3e50; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .recent-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>

    <h1>Tableau de Bord Administrateur</h1>
    <p><a href="../home.php">← Retour au site</a> | <a href="gestion_news.php">Gérer les News</a></p>

    <div class="stats-container">
        <div class="card">
            <h3>Joueurs Inscrits</h3>
            <p><?= $totalJoueurs ?></p>
        </div>
        <div class="card">
            <h3>Articles Publiés</h3>
            <p><?= $totalArticles ?></p>
        </div>
        <div class="card">
            <h3>Revenus Boutique</h3>
            <p><?= number_format($caTotal, 2) ?> €</p>
        </div>
    </div>

    <div class="grid">
        <div class="recent-box">
            <h3>Dernières Inscriptions</h3>
            <table>
                <tr><th>Pseudo</th><th>Date</th></tr>
                <?php foreach($dernièresInscriptions as $inscrit): ?>
                <tr>
                    <td><?= htmlspecialchars($inscrit['username']) ?></td>
                    <td><?= date('d/m H:i', strtotime($inscrit['date_inscription'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="recent-box">
            <h3>Ventes Récentes</h3>
            <table>
                <tr><th>Joueur</th><th>Produit</th><th>Prix</th></tr>
                <?php foreach($derniersAchats as $achat): ?>
                <tr>
                    <td><?= htmlspecialchars($achat['username']) ?></td>
                    <td><?= htmlspecialchars($achat['produit']) ?></td>
                    <td><?= $achat['prix_paye'] ?> €</td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>
</html>