

//Variáveis//////
const modal = new bootstrap.Modal(document.getElementById("modal"), {});
const modalMessenge = document.getElementById('modalMessenge');
const modalButton = document.getElementById('modalButton');
const modalLabel = document.getElementById('modalLabel')
const modalConfirmButton = document.getElementById('confirmButton');

// Classes	///////
class Transaction{
	constructor(dateNum, year, month, day, origin, description, value, type){
		this.dateNum = dateNum;
		this.year = year;
		this.month = month;
		this.day = day;
		this.origin = origin;
		this.description = 'Sem descrição';
		this.value = value;
		this.type = type;

		//Substitui o valor padrão caso a descrição seja informada
		if (description){
			this.description = description;
		}
	}


	validateData(){
		for (let i in this){
			if(!this[i]){
				return false;
			}
		}
	return true;
	}
}

class Db{
	constructor(){
		
		let id = localStorage.getItem('id');
		
		if (id === null){
			localStorage. setItem('id', 0);
		}
	}


	getNextId(){
		return (parseInt(localStorage.getItem('id')) + 1);
	}

	record(data){
		let id = this.getNextId();
		localStorage.setItem(id, JSON.stringify(data));
		localStorage.setItem('id', id);
	}

	getAllDatabase(){
		
		let registerList = Array()

		let id = localStorage.getItem('id');

		//loop que irá recuperar todas as transações
		for (let i = 1; i <= id; i++){

			//Adiciona um valor caso ele não seja nulo
			if (localStorage.getItem(i)) {

				let register = JSON.parse(localStorage.getItem(i));
				register.id = i; //Adiciona o id que servirá como controle
				registerList.push(register);
			}
		}
	return(registerList);
	}

	remove(id){
		localStorage.removeItem(id);
	}

}
//Cria objeto de banco de dados
let db = new Db()



//funções ///////

function isNumeric(value) {
  var regex = /^[\d,.?!]+$/;
  return regex.test(value);
}

function addTransaction(type){

	let dateNum = document.getElementById('date').valueAsNumber + (1000*60*60*3);
	let date = new Date (dateNum);
	/*Cria um objeto data com a data informada pelo navegador e adiciona 3 horas para ficar igual a 
	UTV. Com certeza existe uma forma mais eficiente, mas foi essa a maneira que encontrei*/

	let year = date.getYear() + 1900;
	let month = date.getMonth() + 1;
	let day = date.getDate();
	let origin = document.getElementById('origin').value;
	let description = document.getElementById('description').value;

	let value = document.getElementById('value').value;

	isNumeric(value)? value = parseFloat(value.replace(",", ".")) : value = null;
	

	let transaction = new Transaction(
		dateNum,
		year, 
		month,
		day,
		origin,
		description,
		value,
		type);

	if (transaction.validateData()) {
		db.record(transaction);
		successModal();
		clearForm();
	} else{
		errorModal();
	}

}

function filterTransaction(){
	let type = document.getElementById('type').value;
	let order = document.getElementById('order').value;
	
	let minValue = document.getElementById('minValue').value;
	let maxValue = document.getElementById('maxValue').value;

	isNumeric(minValue)? minValue = parseFloat(minValue.replace(",", ".")) : minValue = null;
	isNumeric(maxValue)? maxValue = parseFloat(maxValue.replace(",", ".")) : maxValue = null;

	let initDate = document.getElementById('initDate').valueAsNumber + (1000*60*60*3);
	let endDate = document.getElementById('endDate').valueAsNumber + (1000*60*60*3);

	showDatabase(type, order, minValue, maxValue, initDate, endDate);

}

function showDatabase(type, order='newFirst', minValue, maxValue, initDate, endDate){

	//cria a variável que vai armazenar o banco de dados
	let registerList = Array();
	registerList = db.getAllDatabase();

	//pega a variável que irá armazenar a tabela
	let tableRegisterList = document.getElementById('tableRegisterList');

	//pega o elemento que vai exibir a soma total
	let tableSum = document.getElementById('tableSum');

	//Zera a tabela antes de inserir novos valores
	tableRegisterList.innerHTML = '';
	
	// aplica filtros se eles forem informados
	if (type) {
		registerList = typeFilter(registerList, type);
	}
	
	if (order === 'newFirst') {
		sortNewFirst(registerList);
	} else if (order === 'oldFirst') {
		sortOldFirst(registerList);
	}

	if (minValue) {
		registerList = minValueFilter(registerList, minValue);
	}

	if (maxValue) {
		registerList = maxValueFilter(registerList, maxValue);
	}

	if (initDate) {
		registerList = initDateFilter(registerList, initDate);
	}

	if (endDate) {
		registerList = endDateFilter(registerList, endDate);
	}


	//Cria tabela com os valores
	// Percorrer o array e recuperar valores internos
	registerList.forEach(function(obj){
		
		//Inserindo linha na tabela
		let row = tableRegisterList.insertRow();
		
		// Testando se a operação foi de entrada ou saída
		if (obj.type === 'in') {
			//Alterando a cor do <tr>
			row.className = 'bg-success text-light';
		} else if (obj.type === 'out'){
			row.className = 'bg-danger text-light';
		}
			
		
		// Criando os elementos <td>
		row.insertCell(0).innerHTML = `${obj.day}/${obj.month}/${obj.year}`;
		row.insertCell(1).innerHTML = obj.origin;
		row.insertCell(2).innerHTML = obj.description;
		row.insertCell(3).innerHTML = obj.value.toFixed(2);

		// criando botão de exclusão
		let btn = document.createElement("button");
		btn.className = "btn border"
		btn.innerHTML =  '<i class="fas fa-times"></i>';
		btn.id = `deleteId${obj.id}`;
		
		btn.onclick = function(){
			//Chama popup de remoção e passa o id
			let id = this.id.replace('deleteId', '');
			deleteConfirmationModal(id);
		}

		row.insertCell(4).append(btn);
	})

	tableSum.innerHTML = getTableSum(registerList);



}
/*As funções abaixo irão complementar a função acima*/

//Ordena os itens para a data mais antiga
function sortNewFirst(list){
	list.sort(function(a,b) {
	    if(a.dateNum < b.dateNum) return 1;
	    if(a.dateNum > b.dateNum) return -1;
	    return 0;
	});
}

//Ordena os itens para a data mais recente
function sortOldFirst(list){
	list.sort(function(a,b) {
	    if(a.dateNum < b.dateNum) return -1;
	    if(a.dateNum > b.dateNum) return 1;
	    return 0;
	});
}

function typeFilter(objArr, value){
	let fiteredList = objArr.filter(function(objArr) { return objArr.type == value; });
	return fiteredList;
}

function minValueFilter(objArr, value){
	let fiteredList = objArr.filter(function(objArr) { return objArr.value >= value; });
	return fiteredList;
}

function maxValueFilter(objArr, value){
	let fiteredList = objArr.filter(function(objArr) { return objArr.value <= value; });
	return fiteredList;
}

function initDateFilter(objArr, value){
	let fiteredList = objArr.filter(function(objArr) { return objArr.dateNum >= value; });
	return fiteredList;
}

function endDateFilter(objArr, value){
	let fiteredList = objArr.filter(function(objArr) { return objArr.dateNum <= value; });
	return fiteredList;
}

function getTableSum(objArr){
	let inFilteredList = typeFilter(objArr, 'in'); //reaproveita a função criada anteriormente
	let outFilteredList = typeFilter(objArr, 'out');
	let inSum = 0;
	let outSum = 0;

	inFilteredList.forEach(function(obj){
    	inSum += obj.value;
  	});
	
	outFilteredList.forEach(function(obj){
    	outSum += obj.value;
  	});

  	return (inSum - outSum).toFixed(2);//retorna as entradas menos as saídas
}
/*------------------------*/

//Limpar campos e exibir os popups

function successModal(){
	modalLabel.innerHTML = 'Feito!';
	modalMessenge.innerHTML = 'Alteração feita com sucesso';
	modalButton.classList.remove('btn-danger');
	modalButton.classList.add('btn-success');
	modal.show();
}


function errorModal(){
	modalLabel.innerHTML = 'Ops...';
	modalMessenge.innerHTML = 'As informações inseridas estão incompletas ou no formato inadequado. <br>Corrija e tente novamente.';
	modalButton.classList.remove('btn-success');
	modalButton.classList.add('btn-danger');
	modal.show();

}

function deleteConfirmationModal(id){

	modalLabel.innerHTML = 'Atenção!';
	modalMessenge.innerHTML = 'Deseja mesmo deletar esta informação';

	modalConfirmButton.onclick = function(){
		db.remove(id);
		showDatabase();
	}

	modal.show();
}

function clearForm(){
	document.getElementById('date').value = null;
	document.getElementById('origin').value = '';
	document.getElementById('description').value = null;
	document.getElementById('value').value = null;
}

function clearFilter(){
	document.getElementById('type').value = '';
	document.getElementById('minValue').value = null;
	document.getElementById('maxValue').value = null;
	document.getElementById('order').value = 'newFirst';
	document.getElementById('initDate').value = null;
	document.getElementById('endDate').value = null;
	showDatabase();
}

