

function editar(id, textTarefa){
    // Cria um form de edição
    let form = document.createElement('form');
    form.action = pag +'.php?pag='+pag+'&acao=atualizar';
    form.method = 'post';
    form.className = 'row';

    // cria as colunas
    let colInputTarefa = document.createElement('div');
    colInputTarefa.className = 'col-md-9';

    let colButton = document.createElement('div');
    colButton.className = 'col-md-3';

    // Cria um input para entrada do texto
    let inputTarefa = document.createElement('input');
    inputTarefa.type = 'text';
    inputTarefa.name = 'tarefa';
    inputTarefa.className = 'form-control';
    inputTarefa.autocomplete = 'off';
    inputTarefa.value = textTarefa;

    //Cria input hidden para guardar o id da tarefa
    let inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = id;

    // Cria um button para envio do form
    let button = document.createElement('button');
    button.type = 'submit';
    button.className = 'btn btn-info';
    button.innerHTML = 'Atualizar';

    // Inlcui inputTarefa no form
    colInputTarefa.appendChild(inputTarefa);
    form.appendChild(colInputTarefa);

    // Inlcui button no form
    colButton.appendChild(button);
    form.appendChild(colButton);

    // Inclui inputId no form
    form.appendChild(inputId);

    // Selecionar a div tarefa
    let tarefa = document.getElementById('tarefa_'+id);

    // Limpar conteúdo interno da div
    tarefa.innerHTML ='';

    // Incluindo form na página
    tarefa.insertBefore(form, tarefa.firstChild);

}

function remover(id){
    location.href= pag +'.php?pag='+pag+'&acao=remover&id='+id;
}

function marcarRealizada(id){
    location.href= pag +'.php?pag='+pag+'&acao=marcarRealizada&id='+id;

}