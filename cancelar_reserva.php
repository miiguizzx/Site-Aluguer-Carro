<?php
session_start();
include("db/conexao.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Apagar reserva apenas se for do utilizador
$conn->query("DELETE FROM reservas WHERE id='$id' AND cliente_id='$user_id'");

header("Location: minhas_reservas.php");
?>