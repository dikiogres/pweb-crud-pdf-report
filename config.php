<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "pdf-report";

$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);

if (!$pdo) {
    die("Failed to connect with database.");
}