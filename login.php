<?php
session_start();
include("db/conexao.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM clientes WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        header("Location: carros.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Login</title>
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
        url('https://wallpapers.com/images/high/black-and-white-car-2880-x-1920-wallpaper-2ckfd8w9nmcx7uk3.webp');

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

.erro { color:red; text-align:center; margin-bottom:1rem; }

.link { text-align:center; margin-top:1rem; }
</style>
</head>
<body>

<div class="card">
<h2>Login</h2>

<?php if(isset($erro)) echo "<div class='erro'>$erro</div>"; ?>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Senha" required>
<button name="login">Entrar</button>
</form>

<div class="link">
<a href="registo.php">Criar conta</a>
</div>
</div>

</body>
</html>