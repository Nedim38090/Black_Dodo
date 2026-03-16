<?php
session_start();


function getDB() {
    $dsn = "mysql:host=localhost;dbname=Black_Dodo;charset=utf8mb4";
    $user = "root";
    $password = "";

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}