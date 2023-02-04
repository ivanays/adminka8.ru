<?php
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=adminka2', 'adminka2', 'adminka2');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $error = 'Ошибка в подключении к базе данных.';
  include 'error.html.php';
  exit();
}
