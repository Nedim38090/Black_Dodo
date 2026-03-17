<?php
require_once __DIR__ . "/db.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cubic Infrastructure | Premium Portal</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="logo">CUBIC<span>GROUP</span></div>
    <ul class="nav-links">
        <li><a href="index.php" class="active">Accueil</a></li>
        <li><a href="achat.php">Boutique</a></li>
        <li><a href="inscription.php" class="active">Inscription</a></li>
        <li><a href="profil.php" class="active">Profil</a></li>
        <li><a href="connexion.php" class="btn-login">Connexion</a></li>
    </ul>
</nav>
</nav>

<header class="hero">
    <div class="hero-content">
        <div class="status-container">
            <span class="pulse-dot"></span>
            <span class="status-text">SERVEUR EN LIGNE : 142/200</span>
        </div>
        <h1>DOMINEZ LE MONDE DE <span>CUBIC</span></h1>
        <p>Une expérience Survie & PvP unique avec une économie réelle.</p>
        <div class="hero-btns">
            <a href="#" class="btn-primary">REJOINDRE LE SERVEUR</a>
            <a href="#" class="btn-secondary">VOIR LA BOUTIQUE</a>
        </div>
    </div>
</header>

<div class="container">
    <main>
        <h2 class="section-title">DERNIÈRES NEWS</h2>
        <div class="news-grid">
            <div class="news-card">
                <div class="news-img" style="background-image: url('https://images.unsplash.com/photo-1627398242454-45a1465c2479?q=80&w=1000&auto=format&fit=crop');"></div>
                <div class="news-body">
                    <span class="tag">EVENT</span>
                    <h3>Le Tournoi des Champions</h3>
                    <p>Préparez vos épées, le tournoi commence ce samedi à 21h au spawn...</p>
                    <a href="#" class="read-more">Lire la suite →</a>
                </div>
            </div>
        </div>
    </main>

    <aside>
        <h2 class="section-title">TOP JOUEURS</h2>
        <div class="leaderboard-card">
            <div class="player-row">
                <span class="rank">#1</span>
                <span class="name">Notch_Hunter</span>
                <span class="score">1240 Kills</span>
            </div>
            <div class="player-row">
                <span class="rank">#2</span>
                <span class="name">DiamondSlayer</span>
                <span class="score">982 Kills</span>
            </div>
        </div>
    </aside>
</div>

</body>
</html>

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

        setTimeout(() => {
            confirm.classList.remove("show");
        }, 2000);
    }
</script>
</body>

