<?php
require_once __DIR__ . "/../config/db.php";

session_start();

function estConnecte()
{
    return isset($_SESSION['user']['id']);
}

function estAdmin()
{
    return (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'administrateur');
}