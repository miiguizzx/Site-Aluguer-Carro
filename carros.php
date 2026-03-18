<?php
include("db/conexao.php");
session_start();

$marcas = [];
$tipos = [];

$marca_result = $conn->query("SELECT DISTINCT marca FROM carros WHERE disponivel=1");
while($row = $marca_result->fetch_assoc()) $marcas[] = $row['marca'];

$tipo_result = $conn->query("SELECT DISTINCT tipo FROM carros WHERE disponivel=1");
while($row = $tipo_result->fetch_assoc()) $tipos[] = $row['tipo'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carros Disponíveis</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style>

body{
font-family:'Roboto',sans-serif;
margin:0;
padding:0;

background:
linear-gradient(rgba(255, 255, 255, 0.6),rgba(0,0,0,0.6)),
url('https://images6.alphacoders.com/996/thumb-1920-996739.png');

background-size:cover;
background-position:center;
background-repeat:no-repeat;
background-attachment:fixed;
}

/* NAVBAR */

nav{
background:#3f3f3f;
color:#fff;
padding:1rem 2rem;
display:flex;
justify-content:space-between;
align-items:center;
}

nav .logo{
font-weight:700;
font-size:1.5rem;
color:#fff;
}

nav ul{
list-style:none;
display:flex;
gap:1rem;
margin:0;
padding:0;
}

nav ul li a,
nav ul li a:visited{
color:#fff;
text-decoration:none;
font-weight:500;
transition:0.2s;
}

nav ul li a:hover{
color:#000;
}

/* TITULO */

h2{
text-align:center;
margin:2rem 0;
}

/* FILTROS */

.filters{
max-width:1200px;
margin:0 auto 1rem;
padding:0 2rem;
display:flex;
gap:1rem;
flex-wrap:wrap;
}

.filters select,
.filters input{
padding:0.5rem;
border-radius:6px;
border:1px solid #ccc;
}

.filters button{
padding:0.5rem 1rem;
border:none;
background:#3f3f3f;
color:white;
border-radius:6px;
cursor:pointer;
}

/* CATÁLOGO */

.catalog{
max-width:1200px;
margin:0 auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:1.5rem;
padding:0 2rem;
}

.car-card{
background:#fff;
border-radius:12px;
overflow:hidden;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
transition:0.2s;
}

.car-card:hover{
transform:translateY(-5px);
}

.car-card img{
width:100%;
height:180px;
object-fit:cover;
}

.car-card .info{
padding:1rem;
}

.car-card .info h3{
margin-bottom:0.5rem;
}

.car-card .info p{
margin-bottom:0.5rem;
color:#777;
}

.car-card .price{
font-weight:700;
color:#000;
margin-bottom:0.5rem;
}

.car-card .info a{
display:inline-block;
background:#3f3f3f;
color:#fff;
text-decoration:none;
padding:0.5rem 1rem;
border-radius:8px;
transition:0.2s;
}

.car-card .info a:hover{
background:#8d8a8a;
}

/* FOOTER */

footer{
background:#3f3f3f;
color:#fff;
text-align:center;
padding:1.5rem 2rem;
margin-top:2rem;
}

footer a{
color:#fff;
text-decoration:none;
}

</style>
</head>

<body>

<!-- NAVBAR -->

<nav>

<div class="logo">Renda o Seu Carro</div>

<ul>

<li><a href="index.php">Home</a></li>

<?php if(isset($_SESSION['user_id'])): ?>

<li><a href="minhas_reservas.php">Minhas Reservas</a></li>
<li><a href="logout.php">Sair</a></li>

<?php else: ?>

<li><a href="login.php">Login</a></li>
<li><a href="registo.php">Registo</a></li>

<?php endif; ?>

</ul>

</nav>

<h2>Carros Disponíveis</h2>

<!-- FILTROS -->

<div class="filters">

<select id="marcaFiltro">
<option value="">Todas as Marcas</option>
<?php foreach($marcas as $m) echo "<option value='$m'>$m</option>"; ?>
</select>

<select id="tipoFiltro">
<option value="">Todos os Tipos</option>
<?php foreach($tipos as $t) echo "<option value='$t'>$t</option>"; ?>
</select>

<input type="number" id="precoMax" placeholder="Preço máximo €/dia">

<button onclick="carregarCarros()">Filtrar</button>

</div>

<!-- CATÁLOGO -->

<div class="catalog" id="catalog"></div>

<script>

async function carregarCarros(){

const catalog = document.getElementById('catalog');

const marca = document.getElementById('marcaFiltro').value;
const tipo = document.getElementById('tipoFiltro').value;
const precoMax = document.getElementById('precoMax').value;

catalog.innerHTML = 'Carregando...';

let url = `carros_api.php?marca=${marca}&tipo=${tipo}&precoMax=${precoMax}`;

const res = await fetch(url);
const carros = await res.json();

catalog.innerHTML='';

if(carros.length===0){
catalog.innerHTML='<p>Nenhum carro encontrado.</p>';
return;
}

carros.forEach(c=>{

const card=document.createElement('div');
card.classList.add('car-card');

card.innerHTML=`

${c.imagem_url ? `<img src="${c.imagem_url}">` : ''}

<div class="info">

<h3>${c.marca} ${c.modelo}</h3>

<p>Ano: ${c.ano}</p>
<p>Tipo: ${c.tipo}</p>

<div class="price">${c.preco_dia}€/dia</div>

<a href="reserver.php?id=${c.id}">Reservar</a>

</div>

`;

catalog.appendChild(card);

});

}

carregarCarros();

</script>

<footer>

<p>
© 2026 Renda o Seu Carro. Todos os direitos reservados.
</p>

</footer>

</body>
</html>