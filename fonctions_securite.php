<?php
require_once(db.php);

session_start();
function estConnecte()
{
    return isset($_SESSION['utilisateur_id']);
}
function estAdmin()
{
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur');
}
