<?php
require_once 'env.php';

$cat_diary = $_ENV['db_cat_diary'];
$user = $_ENV['db_user'];

$conn = new mysqli($cat_diary, $user);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}