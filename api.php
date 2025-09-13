<?php
header("Content-Type: application/json");
$pdo = new PDO("mysql:host=localhost;dbname=burundi;charset=utf8", "root", "");
$type = $_GET["type"] ?? "";

if ($type === "provinces") {
  echo json_encode($pdo->query("SELECT id, nom FROM provinces")->fetchAll(PDO::FETCH_ASSOC));
}

if ($type === "communes" && isset($_GET["province_id"])) {
  $stmt = $pdo->prepare("SELECT id, nom FROM communes WHERE province_id=?");
  $stmt->execute([$_GET["province_id"]]);
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

if ($type === "collines" && isset($_GET["commune_id"])) {
  $stmt = $pdo->prepare("SELECT id, nom FROM collines WHERE commune_id=?");
  $stmt->execute([$_GET["commune_id"]]);
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
