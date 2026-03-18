const carros = [

{
id:1,
marca:"BMW",
modelo:"M4",
tipo:"Desportivo",
preco:150,
imagem:"imagens/bmw.jpg"
},

{
id:2,
marca:"Audi",
modelo:"A5",
tipo:"Sedan",
preco:120,
imagem:"imagens/audi.jpg"
},

{
id:3,
marca:"Mercedes",
modelo:"C300",
tipo:"Sedan",
preco:140,
imagem:"imagens/mercedes.jpg"
}

];



function mostrarCarros(lista = carros){

let div=document.getElementById("catalog");

if(!div) return;

div.innerHTML="";

lista.forEach(c=>{

div.innerHTML+=`

<div class="car">

<img src="${c.imagem}">

<h3>${c.marca} ${c.modelo}</h3>

<p>${c.tipo}</p>

<p>${c.preco}€/dia</p>

<button onclick="abrirReserva(${c.id})">

Reservar

</button>

</div>

`;

});

}



function filtrarCarros(){

let marca=document.getElementById("marcaFiltro").value;
let tipo=document.getElementById("tipoFiltro").value;
let preco=document.getElementById("precoFiltro").value;
let pesquisa=document.getElementById("pesquisa").value.toLowerCase();
let ordenar=document.getElementById("ordenar").value;

let filtrados = carros.filter(c => {

return (!marca || c.marca===marca)
&& (!tipo || c.tipo===tipo)
&& (!preco || c.preco<=preco)
&& (!pesquisa || (c.marca+c.modelo).toLowerCase().includes(pesquisa))

});


if(ordenar==="menor"){

filtrados.sort((a,b)=>a.preco-b.preco);

}

if(ordenar==="maior"){

filtrados.sort((a,b)=>b.preco-a.preco);

}


mostrarCarros(filtrados);

}



function abrirReserva(id){

let data = prompt("Escolhe a data (YYYY-MM-DD)");

if(!data) return;

reservar(id,data);

}



function reservar(id,data){

let user=localStorage.getItem("user");

if(!user){

alert("Faz login");
return;

}

let reservas=JSON.parse(localStorage.getItem("reservas"))||[];

reservas.push({

user,
carro:id,
data

});

localStorage.setItem("reservas",JSON.stringify(reservas));

alert("Reservado");

}



function mostrarReservas(){

let user=localStorage.getItem("user");

let reservas=JSON.parse(localStorage.getItem("reservas"))||[];

let div=document.getElementById("reservas");

if(!div) return;

div.innerHTML="";

reservas.forEach(r=>{

if(r.user===user){

let carro=carros.find(c=>c.id===r.carro);

div.innerHTML+=`

<div class="car">

<img src="${carro.imagem}">

<h3>${carro.marca} ${carro.modelo}</h3>

<p>${carro.preco}€/dia</p>

<p>Data: ${r.data}</p>

</div>

`;

}

});

}

// ===== REGISTO =====

function registar(){

let email=document.getElementById("email").value;
let pass=document.getElementById("pass").value;

if(!email || !pass){

alert("Preenche tudo");
return;

}

let users=JSON.parse(localStorage.getItem("users"))||[];

users.push({

email,
pass

});

localStorage.setItem("users",JSON.stringify(users));

alert("Registado");

location.href="login.html";

}



// ===== LOGIN =====

function login(){

let email=document.getElementById("email").value;
let pass=document.getElementById("pass").value;

let users=JSON.parse(localStorage.getItem("users"))||[];

let encontrado=users.find(u => u.email===email && u.pass===pass);

if(encontrado){

localStorage.setItem("user",email);

alert("Login feito");

location.href="index.html";

}else{

alert("Dados errados");

}

}