<?php


if (!defined("BASE_PATH")) {
     echo "permmison denied";
     die;
}
// other sintax
defined("BASE_PATH") or die("permmison denied");

try {
     $pdo = new PDO("mysql:host={$database_config->host};dbname={$database_config->db}", $database_config->user, $database_config->pass);
} catch (PDOException $e) {
     diePage("Connection failed: " . $e->getMessage());
}

// var_dump($pdo);
