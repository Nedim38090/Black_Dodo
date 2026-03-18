<?php
require_once __DIR__ . "/db.php";

$connecte = isset($_SESSION["user"]);
$isAdmin = $connecte && isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "administrateur";

$db = getDB();

$news = [];
$topJoueurs = [];
$serveurEnLigne = true;
$joueursConnectes = 142;
$maxJoueurs = 200;

try {
    $qNews = $db->query("SELECT id, titre, contenu, image_article, date_publication FROM articles ORDER BY date_publication DESC LIMIT 3");
    $news = $qNews->fetchAll(PDO::FETCH_ASSOC);

    $qTop = $db->query("
        SELECT u.username, COUNT(a.id) AS total_achats
        FROM utilisateurs u
        LEFT JOIN achats a ON a.utilisateur_id = u.id
        GROUP BY u.id, u.username
        ORDER BY total_achats DESC, u.username ASC
        LIMIT 5
    ");
    $topJoueurs = $qTop->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $news = [];
    $topJoueurs = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cubic Infrastructure | Premium Portal</title>
    <link rel="stylesheet" href="style_index.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="logo">CUBIC<span>GROUP</span></div>
    <ul class="nav-links">
        <li><a href="index.php" class="active">Accueil</a></li>
        <li><a href="boutique.php">Boutique</a></li>

        <?php if (!$connecte): ?>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php" class="btn-login">Connexion</a></li>
        <?php else: ?>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="deconnexion.php" class="btn-login">Déconnexion</a></li>
            <li><a href="historique.php">Historique</a></li>
        <?php endif; ?>
    </ul>
</nav>

<header class="hero">
    <div class="hero-content">
        <?php if ($connecte): ?>
            <p style="margin-bottom:10px;">
                Bienvenue <strong><?= htmlspecialchars($_SESSION["user"]["username"]) ?></strong>
                (<?= htmlspecialchars($_SESSION["user"]["role"]) ?>)
            </p>
        <?php endif; ?>

        <div class="status-container">
            <span class="pulse-dot"></span>
            <span class="status-text">
                SERVEUR <?= $serveurEnLigne ? "EN LIGNE" : "HORS LIGNE" ?> : <?= (int)$joueursConnectes ?>/<?= (int)$maxJoueurs ?>
            </span>
        </div>

        <h1>DOMINEZ LE MONDE DE <span>CUBIC</span></h1>
        <p>Une expérience Survie & PvP unique avec une économie réelle.</p>

        <div class="hero-btns">
            <a href="#" class="btn-primary">REJOINDRE LE SERVEUR</a>
            <a href="boutique.php" class="btn-secondary">VOIR LA BOUTIQUE</a>
        </div>
    </div>
</header>

<div class="container">
    <main>
        <h2 class="section-title">DERNIÈRES NEWS</h2>

        <?php if (empty($news)): ?>
            <div class="news-card">
                <div class="news-body">
                    <span class="tag">INFO</span>
                    <h3>Aucune actualité pour le moment</h3>
                    <p>L’équipe Cubic publiera bientôt les prochaines annonces.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="news-grid">
                <?php foreach ($news as $article): ?>
                    <div class="news-card">
                        <div class="news-img" style="background-image: url('<?= htmlspecialchars(!empty($article['image_article']) ? $article['image_article'] : "https://images.unsplash.com/photo-1627398242454-45a1465c2479?q=80&w=1000&auto=format&fit=crop") ?>');"></div>
                        <div class="news-body">
                            <span class="tag">NEWS</span>
                            <h3><?= htmlspecialchars($article["titre"]) ?></h3>
                            <p><?= htmlspecialchars(mb_strimwidth(strip_tags($article["contenu"]), 0, 140, "...")) ?></p>
                            <small style="color:#bbb;">
                                Publié le <?= date("d/m/Y H:i", strtotime($article["date_publication"])) ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <aside>
        <h2 class="section-title">TOP JOUEURS</h2>
        <div class="leaderboard-card">
            <?php if (empty($topJoueurs)): ?>
                <div class="player-row">
                    <span class="rank">#</span>
                    <span class="name">Aucun joueur</span>
                    <span class="score">0 achat</span>
                </div>
            <?php else: ?>
                <?php $rang = 1; foreach ($topJoueurs as $joueur): ?>
                    <div class="player-row">
                        <span class="rank">#<?= $rang ?></span>
                        <span class="name"><?= htmlspecialchars($joueur["username"]) ?></span>
                        <span class="score"><?= (int)$joueur["total_achats"] ?> achats</span>
                    </div>
                    <?php $rang++; endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>
</div>

<div class="ip-box" onclick="copyIP()">
    <span id="ip-text">http://localhost/Black_Dodo/</span>
    <span id="copy-confirm">Copié !</span>
</div>

<footer class="main-footer">
    <div class="footer-content">
        <p>&copy; 2026 <strong>Cubic Infrastructure</strong>. Tous droits réservés.</p>
        <p style="font-size: 0.8rem; margin-top: 10px; color: #444;">
            Propulsé et réalisé par le Groupe <strong>Black Dodo</strong>
        </p>
    </div>
</footer>

<script>
    function copyIP() {
        const ip = document.getElementById("ip-text").innerText;
        navigator.clipboard.writeText(ip);
        const confirm = document.getElementById("copy-confirm");
        confirm.classList.add("show");
        setTimeout(() => confirm.classList.remove("show"), 2000);
    }
</script>

</body>
</html>

