<?php
session_start();
include("db/conexao.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$carro_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if(isset($_POST['data_inicio']) && isset($_POST['data_fim'])){

    $inicio = $_POST['data_inicio'];
    $fim = $_POST['data_fim'];

    $sql = "INSERT INTO reservas (carro_id, cliente_id, data_inicio, data_fim)
            VALUES ('$carro_id','$user_id','$inicio','$fim')";

    $conn->query($sql);

    header("Location: minhas_reservas.php");
}

$carro = $conn->query("SELECT * FROM carros WHERE id='$carro_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Reservar Carro</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style>

body{
font-family:'Roboto',sans-serif;
margin:0;
height:100vh;
display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7');

background-size:cover;
background-position:center;
}

.card{

background:rgba(255,255,255,0.95);
padding:30px;
border-radius:12px;
width:350px;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
text-align:center;

}

.card h2{
margin-bottom:10px;
}

.car-info{
margin-bottom:20px;
color:#555;
}

input{

width:100%;
padding:10px;
margin-bottom:15px;
border-radius:6px;
border:1px solid #ccc;
font-size:14px;

}

button{

width:100%;
padding:10px;
border:none;
border-radius:8px;
background:#3f3f3f;
color:white;
font-size:16px;
cursor:pointer;
transition:0.2s;

}

button:hover{

background:#000;

}

a{
display:block;
margin-top:10px;
text-decoration:none;
color:#333;
}

</style>
</head>

<body>

<div class="card">

<h2>Reservar Carro</h2>

<div class="car-info">
<b><?php echo $carro['marca']." ".$carro['modelo']; ?></b><br>
<?php echo $carro['preco_dia']; ?> €/dia
</div>

<form method="POST">

<input type="date" name="data_inicio" required>

<input type="date" name="data_fim" required>

<button type="submit">Confirmar Reserva</button>

</form>

<a href="carros.php">Voltar</a>

</div>

</body>
</html>