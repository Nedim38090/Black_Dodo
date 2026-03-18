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
require_once 'html_index.html';
?>

