<?php
include("db/conexao.php");
header('Content-Type: application/json');

$marca = $_GET['marca'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$precoMax = $_GET['precoMax'] ?? '';

$where = "WHERE disponivel=1";
if($marca) $where .= " AND marca='$marca'";
if($tipo) $where .= " AND tipo='$tipo'";
if($precoMax) $where .= " AND preco_dia <= $precoMax";

$sql = "SELECT * FROM carros $where";
$result = $conn->query($sql);

$carros = [];
while($row = $result->fetch_assoc()){
  $carros[] = $row;
}

echo json_encode($carros);