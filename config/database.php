<?php
declare(strict_types=1);
$host='localhost'; $dbname='bersih_negeri'; $username='root'; $password='';
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false];
try {
    $pdo=new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4",$username,$password,$options);
} catch(PDOException $e) {
    http_response_code(500);
    exit('Koneksi database gagal. Periksa config/database.php dan pastikan database sudah diimpor.');
}
