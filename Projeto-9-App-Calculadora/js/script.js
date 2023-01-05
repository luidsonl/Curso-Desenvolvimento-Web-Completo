document.getElementById('display').value = null;
var locked = false; //serve como trava para digitar números



//funções
function calc(type, value){
		
	if (type == 'action') {
		locked = false; //destrava

		if (value==="clear") {
			clear();

		}else if(value==="="){
			calculate();

		}else{
			
			if (endsWithNumber(document.getElementById('display').value)) {
				document.getElementById('display').value += value;
			}
		}
		



	} else if(type=='value'){
		if (locked) {
			clear();
			locked = false;
		}
	document.getElementById('display').value += value;
	}
}

//limpa a tela e o previousValue
function clear(){
	document.getElementById('display').value = null;
}
// realiza a operação
function calculate(){
	var finalValue = eval(document.getElementById('display').value);
	document.getElementById('display').value = finalValue;
	locked = true; // trava após finalizar a operação
}

//Testa se termina com um número
function endsWithNumber(str) {
  return str.match(/\d$/);
}

