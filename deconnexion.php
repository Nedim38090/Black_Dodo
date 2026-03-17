<?php

require_once __DIR__ . "/db.php";

unset($_SESSION["user"]);
session_destroy();
echo "vous êtes bien déconnectez";
header("Location: index.php");

exit;