<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Renda o Seu Carro</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body { font-family:'Roboto',sans-serif; margin:0; background:#d1d1d1; }

nav{ background:#3f3f3f; padding:1rem 2rem; display:flex; justify-content:space-between; align-items:center; }
nav .logo { font-weight:700; font-size:1.5rem; color:#fff;}
nav ul{ list-style:none; display:flex; gap:1rem; }
nav ul li a,
nav ul li a:visited{ color:#fff; text-decoration:none; font-weight:500; transition:0.2s; }
nav ul li a:hover{ color:#000; }

.hero {
    height:85vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('https://wallpapers.com/images/hd/black-and-white-car-1920-x-1080-wallpaper-2ukx01djv7ggk11k.jpg');
    background-size:cover;
    background-position:center;
    color:#fff;
}

.hero h1 { font-size:3rem; margin-bottom:1rem; }
.hero p { font-size:1.2rem; margin-bottom:2rem; }

.btn {
    background:#3f3f3f;
    padding:0.8rem 1.5rem;
    border-radius:8px;
    color:#fff;
    text-decoration:none;
    font-weight:500;
    transition:0.2s;
}

.btn:hover { background:#000; }

footer {
    background:#3f3f3f;
    color:#fff;
    text-align:center;
    padding:1rem;
}
</style>
</head>
<body>

<nav>
  <div class="logo">Renda o Seu Carro</div>
  <ul>
    <li><a href="carros.php">Carros</a></li>
    <?php if(isset($_SESSION['user_id'])): ?>
        <li><a href="minhas_reservas.php">Minhas Reservas</a></li>
        <li><a href="logout.php">Sair</a></li>
    <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="registo.php">Registo</a></li>
    <?php endif; ?>
  </ul>
</nav>

<section class="hero">
    <h1>Alugue o carro perfeito para si</h1>
    <p>Conforto, segurança e os melhores preços do mercado.</p>
    <a href="carros.php" class="btn">Ver Carros Disponíveis</a>
</section>

<footer>
&copy; 2026 Renda o Seu Carro. Todos os direitos reservados.
</footer>

</body>
</html>