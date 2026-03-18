<?php
require_once __DIR__ . "/db.php";

function estConnecte()
{
    return isset($_SESSION['user']['id']);
}

function estAdmin()
{
    return (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'administrateur');
}