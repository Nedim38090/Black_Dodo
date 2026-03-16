<?php
$dsn = "http://localhost/c:/www/Black_Dodo";
$user = "root";
$password = "";

try {

    $db = new PDO($dsn, $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connecté !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}