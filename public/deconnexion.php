<?php

require_once __DIR__ . "/../config/db.php";

unset($_SESSION["user"]);
session_destroy();

header("Location: login.php");
exit;