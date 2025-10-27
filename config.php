<?php
session_start();
define("HOST", "localhost");
define("USER","jan_guestbook");
define("PASSWORD","yandex40");
define("DBNAME","jan_guestbook");
define("CHARSET","utf8");
define("SALT","webDEVblog");

$dsn = "mysql:host=".HOST.";dbname=".DBNAME.";charset=".CHARSET;
try {
    $pdo = new PDO($dsn, USER, PASSWORD);
}   catch (PDOException $e) {
    die("Connection lost: " . $e->getMessage());
}