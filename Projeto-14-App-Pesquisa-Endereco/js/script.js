/*Variáveis*/
const mensagemLoading = document.getElementById('mensagemLoading');
const endereco = document.getElementById('endereco');
const bairro = document.getElementById('bairro');
const cidade = document.getElementById('cidade');
const uf = document.getElementById('uf');

function getCep(cep) {
  // Define a url da API
  const url = 'https://viacep.com.br/ws/' + cep + '/json/';
  
  //Adiciona gif de loading
  mensagemLoading.innerHTML = '<img src = "img/loading.gif" height="42" width="42">';

  // cria objeto XMLHttpRequest
  let xmlHttp = new XMLHttpRequest();
  

  // Faz requisição
  xmlHttp.open('GET', url);

  xmlHttp.onreadystatechange = () => {

    if (xmlHttp.readyState === 4 && xmlHttp.status == 200){
      
      // Modifica os valores caso ocorra sucesso na conexão
      let jsonText = xmlHttp.responseText;
      let jsonObj = JSON.parse(jsonText);

      mensagemLoading.innerHTML = '';


      endereco.value = jsonObj.logradouro;
      bairro.value = jsonObj.bairro;
      cidade.value = jsonObj.localidade;
      uf.value = jsonObj.uf;

    }else{
      // Deixa os valores vazios caso ocorra erro
      endereco.value = '';
      bairro.value = '';
      cidade.value = '';
      uf.value = '';

      mensagemLoading.innerHTML = 'Não foi possivel encontrar o CEP informado';

    }
  }

  xmlHttp.send();
}

function trigger(){
  let cep = document.getElementById('cep').value;
  getCep(cep);
}