$(document).ready(() => {

	

	$('#dashboard').on('click',()=>{
		$('#pagina').load('content/dashboard.html')
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