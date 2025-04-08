<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=mvc_stampee;port=3306;charset=utf8', 'root', '');
    echo "Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
