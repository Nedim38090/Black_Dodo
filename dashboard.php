<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black dodo Panel</title>
    <link rel="stylesheet" href="paneladmin.css">
    <link rel="stylesheet" href="effet_page.css">
</head>
<body>
<div class="loader-content page-transition">
    <div class="futuristic-loader">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="dot"></div>
    </div>
    <span class="loader-text">SCANNING SYSTEM...</span>
</div>
<div class="mouse-glow"></div>
<div class="grid-overlay"></div>
<script src="effet_souris.js"></script>

    <nav class="sidebar">
    <div class="logo">BLACK DODO</div>


    
    <div class="nav-section">
        <a href="index.php" class="btn-return">Retour à l'acceuil</a>
        <a href="dashboard.php" class="nav-link active">
            <span class="icon">📊</span> Dashboard
        </a>
        <a href="historique_user.php" class="nav-link ">
            <span class="icon">💸</span> Historique Flux
        </a>
        <a href="sanctions.php" class="nav-link">
            <span class="icon">⚠️</span> Sanctions
        </a>
    </div>

    
</nav>

    <main>
        <header>
            <h1>Console de Commande</h1>
            <p>Admin // Status : Actif </p> <!--On sait pas faire du HTML j'ai peur pour la suite || Mathys Noa-->
        </header>

        <section class="stats-grid">
            <div class="stat-card">
                <h3>Chiffre d'affaire</h3>
                <p>24.8M €</p>
            </div>
            <div class="stat-card" ><!--On mets pas de CSS dans du HTML sale fou || Mathys Noa-->
                <h3>nombre d'utilisateurs</h3>
                <p>12.4k</p>
            </div>
            <div class="stat-card">
                <h3>nouveaux utilisateurs</h3>
                <p>1407</p>
            </div>
            <div class="stat-card">
                <h3>membres actifs</h3>
                <p>1,204</p>
            </div>
        </section>

        <section class="editor-panel">
    <div class="editor-header">
        
        <div class="editor-actions">
            <h2>CRÉER UNE ANNONCE</h2>
            <button class="btn-primary" >PUBLIER</button>
        </div>
    </div>

    <div class="editor-body">
        <div class="input-group">
            <label>TITRE DE L'ARTICLE</label>
            <input type="text" id="postTitle" placeholder="Entrez le titre de l'article...">
        </div>

        <div class="input-row">
            <div class="input-group">
                <label>CATÉGORIE</label>
                <select id="postCategory">
                    <option value="news">ANNONCE SYSTÈME</option>
                    <option value="patch">PATCH NOTES</option>
                    <option value="event">ÉVÈNEMENT</option>
                </select>
            </div>
            <div class="input-group">
                <label>NIVEAU D'ACCÈS</label>
                <select id="postSecurity">
                    <option value="1">PUBLIC</option>
                    <option value="2">VIP</option>
                </select>
            </div>
        </div>
        <div class="input-group">
                    <label>IMAGE DE COUVERTURE (OPTIONNEL)</label>
                    <div class="image-upload-container" id="dropZone" onclick="document.getElementById('fileInput').click()">
                        <div class="icon">📷</div>
                        <div class="text">GLISSER-DÉPOSER OU CLIQUER POUR UPLOADER</div>
                        <img id="imagePreview" src="#" alt="Aperçu de l'image">
                    </div>
                    <input type="file" id="fileInput" accept="image/*">
                </div>
        <div class="input-group">
            <label>CONTENU DU MESSAGE</label>
            <textarea id="postContent" rows="10" placeholder="Tapez le contenu de l'article ici..."></textarea>
        </div>
    </div>
</section>
    </main>
<script src="effet_page.js"></script>
</body>
</html>