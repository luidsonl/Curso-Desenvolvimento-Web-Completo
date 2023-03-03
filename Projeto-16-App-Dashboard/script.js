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
	/*$('#competencia').on('change', e=>{
		

		let competencia = $(e.target).val();

		$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			success:(dados)=>{console.log(dados)},
			error:(erro)=>{console.error(erro)}
		})

	})*/
	$('#ano').on('change', ()=>{
		

		let competencia = $('#ano').val() + $('#mes').val();

		$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			success:(dados)=>{console.log(dados)},
			error:(erro)=>{console.error(erro)}
		})

	})
	$('#mes').on('change', ()=>{
		

		let competencia = $('#ano').val() + $('#mes').val();

		$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			success:(dados)=>{console.log(dados)},
			error:(erro)=>{console.error(erro)}
		})

	})
}