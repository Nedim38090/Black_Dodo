<?php
session_start();

define('ENCRYPTION_KEY', 'CUBIC-SECURE-KEY-99!');

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





function encryptData($data) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decryptData($data) {
    if (strpos($data, '::') === false) return $data;
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', ENCRYPTION_KEY, 0, $iv);
}