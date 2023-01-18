/*Variáveis globais*/

let height = window.innerHeight;
let width = window.innerWidth;

/*Variáveis de controle*/
let gameSpeed;
let time;
let life = 1;

let settedGameSpeed;
let settedTime;



/*Funções*/

//funções para modificar tela de jogo

function showMenuScreen(){
	document.getElementById('main-menu-screen').style.display = 'block';
	document.getElementById('game-screen').style.display = 'none';
	document.getElementById('victory-screen').style.display = 'none';
	document.getElementById('game-over-screen').style.display = 'none';
}

function showGameScreen(){
	document.getElementById('main-menu-screen').style.display = 'none';
	document.getElementById('game-screen').style.display = 'block';
	document.getElementById('victory-screen').style.display = 'none';
	document.getElementById('game-over-screen').style.display = 'none';
}

function showGameOverScreen(){
	document.getElementById('main-menu-screen').style.display = 'none';
	document.getElementById('game-screen').style.display = 'none';
	document.getElementById('victory-screen').style.display = 'none';
	document.getElementById('game-over-screen').style.display = 'block';
}

function showVictoryScreen(){
	document.getElementById('main-menu-screen').style.display = 'none';
	document.getElementById('game-screen').style.display = 'none';
	document.getElementById('victory-screen').style.display = 'block';
	document.getElementById('game-over-screen').style.display = 'none';
}





function adjustScreen(){
	height = window.innerHeight;
	width = window.innerWidth;
}


function randomPosition(){

	lifeUpdate();

	let positionX = Math.floor(Math.random() * width) - 100;
	let positionY = Math.floor(Math.random() * height) - 135;

	positionX = positionX < 0 ? 0 : positionX;
	positionY = positionY < 0 ? 0 : positionY;

	//criar elemento html
	let ufo = document.createElement('img');
	ufo.src = randomUfo();
	ufo.className = randomSize() + (' ') + randomSide();
	ufo.style.position = 'absolute';
	ufo.style.left = positionX + 'px';
	ufo.style.top = positionY + 'px';
	ufo.id = 'ufo';
	ufo.onclick = function(){
		destroy();
	}

	document.body.appendChild(ufo);
}



function fragment(id){
	let fragment = document.createElement('img');
	fragment.src = 'img/explosao.png';
	fragment.style.position = ufo.style.position;
	fragment.style.left = ufo.style.left;
	fragment.style.top = ufo.style.top;
	fragment.className = ufo.className;
	fragment.id = 'f' + id;

	document.body.appendChild(fragment);

	setTimeout(function(){
		destroyElement(fragment.id);
	},1500)
	
	
}

function destroy(){
	fragment(time);
	destroyElement('ufo');
}

function destroyElement(id){
	document.getElementById(id).remove();
}

function randomUfo(){
	let x = Math.floor(Math.random() * 3);
	switch(x){
		case 0:
			return './img/ovni1.png';
		case 1:
			return './img/ovni2.png';
		case 2:
			return './img/ovni3.png';
	}
}

function randomSize(){
	let x = Math.floor(Math.random() * 4);
	switch(x){
		case 0:
			return 'size0';
		case 1:
			return 'size1';
		case 2:
			return 'size2';
		case 3:
			return 'size3';
	}
}

function randomSide(){
	let x = Math.floor(Math.random() * 2);

	switch(x){
		case 0:
		return 'sideA';

		case 1:
		return 'sideB';
	}
}

//Contém condições de vitória
function startGame(){
	lifeReset();
	life = 1;

	gameSpeed = document.getElementById('select-speed').value;
	time = document.getElementById('select-time').value;

	if (gameSpeed && time){
		showGameScreen();

		/*Variáveis de intervalo*/
		let interval = setInterval(randomPosition, gameSpeed);

		let timer = setInterval(
			function(){
				
				if (life >= 6) {
					clearInterval(interval);
					clearInterval(timer);
				}

				time--;

				if (time < 0) {
					clearInterval(interval);
					clearInterval(timer);
					showVictoryScreen();


					

				} else{
					document.getElementById('counter').innerHTML = time;
				}

				
			}, 1000)
	}
	else{
		alert('Informe a velocidade e o tempo da partida');
	}
	
}

//Contém condições de derrota

function lifeUpdate(){
	//remover ovni anterior se houver
	if(document.getElementById('ufo')){
		document.getElementById('ufo').remove();
		//testa se deu game over
		if (life >= 5) {
			showGameOverScreen();
			}
		//atualiza a barra de vida
		document.getElementById('v'+ life).src = 'img/cidade-destruida.png'
		life++;
	}
}
//Reseta as vidas ao reiniciar o jogo
function lifeReset() {
	for (var i = 1; i <= 5; i++) {
		document.getElementById('v'+ i).src = 'img/cidade-inteira.png'
	}
}

showMenuScreen();