<?php

require_once __DIR__ . "/db.php";

unset($_SESSION["user"]);
session_destroy();

header("Location: connexion.php");
exit;