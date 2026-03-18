<?php
include("db/conexao.php");

if(isset($_POST['registar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn->query("INSERT INTO clientes (nome,email,password) VALUES ('$nome','$email','$password')");
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Registo</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body { 
    font-family:'Roboto',sans-serif; 
    margin:0;
    height:100vh; 
    display:flex; 
    justify-content:center; 
    align-items:center;

    background: 
        linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
        url('https://images.unsplash.com/photo-1494976388531-d1058494cdd8');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

.card {
    background:#fff;
    padding:2rem;
    border-radius:12px;
    width:350px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2 { text-align:center; margin-bottom:1.5rem; }

input {
    width:100%;
    padding:0.7rem;
    margin-bottom:1rem;
    border-radius:6px;
    border:1px solid #ccc;
}

button {
    width:100%;
    padding:0.7rem;
    border:none;
    background:#3f3f3f;
    color:#fff;
    border-radius:6px;
    cursor:pointer;
}

button:hover { background:#000; }

.link { text-align:center; margin-top:1rem; }
</style>
</head>
<body>

<div class="card">
<h2>Criar Conta</h2>

<form method="POST">
<input type="text" name="nome" placeholder="Nome" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Senha" required>
<button name="registar">Registar</button>
</form>

<div class="link">
<a href="login.php">Já tenho conta</a>
</div>
</div>

</body>
</html>