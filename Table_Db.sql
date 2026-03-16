



CREATE TABLE utilisateurs (
    id INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL, -- Stockage du hash (password_hash)
    role ENUM('joueur', 'moderateur', 'administrateur') DEFAULT 'joueur',
    description_profil TEXT,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE articles (
    id INT NOT NULL AUTO_INCREMENT,
    titre VARCHAR(150) NOT NULL,
    contenu TEXT NOT NULL,
    image_article VARCHAR(255),
    utilisateurs_id INT,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_news_auteur FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs(id) ON DELETE SET NULL
);


CREATE TABLE categories_boutique (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE produits (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    categorie_id INT,
    image_produit VARCHAR(255) DEFAULT 'default_item.png',
    PRIMARY KEY (id),
    CONSTRAINT fk_produit_categorie FOREIGN KEY (categorie_id) REFERENCES categories_boutique(id) ON DELETE CASCADE
);


CREATE TABLE achats (
    id INT NOT NULL AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    prix_paye DECIMAL(10, 2) NOT NULL,
    methode_paiement VARCHAR(50) DEFAULT 'Carte Bancaire',
    transaction_id VARCHAR(100),
    statut ENUM('en_attente', 'termine', 'echoue') DEFAULT 'termine',
    PRIMARY KEY (id),
    CONSTRAINT fk_achat_joueur FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    CONSTRAINT fk_achat_item FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE RESTRICT
);


CREATE TABLE sanctions (
    id INT NOT NULL AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    type ENUM('avertissement', 'bannissement') NOT NULL,
    raison TEXT NOT NULL,
    date_sanction DATETIME DEFAULT CURRENT_TIMESTAMP,
    est_actif BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (id),
    CONSTRAINT fk_sanction_joueur FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);