<?php
session_start();

function getDB() {
    $dsn = "mysql:host=localhost;dbname=Black_Dodo;charset=utf8mb4";
    try {
        $db = new PDO($dsn, "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}