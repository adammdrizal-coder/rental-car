<?php

    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_NAME', 'CarRental');
    DEFINE('DB_USER', 'root');
    DEFINE('DB_PASS', '');

    try {
        
        $pdo = new Pdo ("mysql:host=" .DB_HOST. ";dbname=" .DB_NAME, DB_USER, DB_PASS);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Could not connect: " .$e->getMessage());
    }