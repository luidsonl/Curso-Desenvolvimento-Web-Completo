$(document).ready(() => {

	$('#dashboard').on('click',()=>{
		$('#pagina').load('content/dashboard.html', ()=>{
			JQueryUpdate()
		})
	})

	$('#documentacao').on('click',()=>{
		$('#pagina').load('content/documentacao.html')
	})

	$('#suporte').on('click',()=>{
		$('#pagina').load('content/suporte.html')
	})

	// Exibe a dashboard por padrão
	$('#dashboard').click();

		
})

// Função que irá fazer com que o jquery pegue os elementos na página do dashboard
function JQueryUpdate(){

	// Ajax
	$('#ano').on('change', ()=>{
		ajaxUpdate();
		

	})
	$('#mes').on('change', ()=>{
		ajaxUpdate();
		
	})
}

function ajaxUpdate(){
	if($('#ano').val() && $('#mes').val()){

		let competencia = $('#ano').val()+ '-' + $('#mes').val();

		$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			dataType: 'json',
			success:(dados)=>{
				$('#numero_vendas').html(dados.numero_vendas);
				$('#total_vendas').html(dados.total_vendas);
				},
			error:(erro)=>{console.error(erro)}
		})
	}
}