<?php
session_start();
include("db/conexao.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT r.*, c.marca, c.modelo, c.preco_dia
FROM reservas r
JOIN carros c ON r.carro_id = c.id
WHERE r.cliente_id = '$user_id'
ORDER BY r.data_inicio DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minhas Reservas</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body{
font-family:'Roboto',sans-serif;
margin:0;
padding:0;

background:
linear-gradient(rgba(255, 255, 255, 0.6),rgba(0,0,0,0.6)),
url('https://wallpapercave.com/wp/wp7395312.jpg');

background-size:cover;
background-position:center;
background-repeat:no-repeat;
background-attachment:fixed;
}
nav{ background:#3f3f3f; padding:1rem 2rem; display:flex; justify-content:space-between; align-items:center; }
nav .logo { font-weight:700; font-size:1.5rem; color:#fff; }
nav ul{ list-style:none; display:flex; gap:1rem; }
nav ul li a,
nav ul li a:visited{ color:#fff; text-decoration:none; font-weight:500; transition:0.2s; }
nav ul li a:hover{ color:#000; }

.container { max-width:1000px; margin:2rem auto; padding:0 2rem; }
.card { background:#fff; padding:1rem; border-radius:12px; margin-bottom:1rem; box-shadow:0 4px 12px rgba(0,0,0,0.1); }

.total { font-weight:700; color:#000; }
.btn-cancel { display:inline-block; margin-top:0.5rem; background:#b00020; color:#fff; padding:0.4rem 0.8rem; border-radius:6px; text-decoration:none; }
</style>
</head>
<body>

<nav>
  <div class="logo">Renda o Seu Carro</div>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="carros.php">Carros</a></li>
    <li><a href="logout.php">Sair</a></li>
  </ul>
</nav>

<div class="container">
<h2>Minhas Reservas</h2>

<?php
if($result->num_rows == 0){
    echo "<p>Você ainda não tem reservas.</p>";
}

while($reserva = $result->fetch_assoc()){

    $inicio = new DateTime($reserva['data_inicio']);
    $fim = new DateTime($reserva['data_fim']);
    $dias = $inicio->diff($fim)->days;

    if($dias == 0) $dias = 1;

    $total = $dias * $reserva['preco_dia'];

    echo "<div class='card'>";
    echo "<h3>".$reserva['marca']." ".$reserva['modelo']."</h3>";
    echo "<p>De: ".$reserva['data_inicio']." até ".$reserva['data_fim']."</p>";
    echo "<p>Dias: ".$dias."</p>";
    echo "<p class='total'>Total: ".$total."€</p>";
    echo "<a class='btn-cancel' href='cancelar_reserva.php?id=".$reserva['id']."'>Cancelar</a>";
    echo "</div>";
}
?>

</div>

</body>
</html>