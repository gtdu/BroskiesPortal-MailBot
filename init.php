<?php

error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$ini = parse_ini_file("config.ini", true)["mail"];

// Start session if not already created
if (session_status() == PHP_SESSION_NONE) {
    session_name("broskies_lore");
    session_start();
}

date_default_timezone_set('America/New_York');
