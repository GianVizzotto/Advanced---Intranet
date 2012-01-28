// JavaScript Document


$(document).ready(function(){
	
	// INICIO FANCY BOX GALERIA DE IMAGENS
	/*
	$(".fotos a").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	200, 
		'speedOut'		:	200 
	});
*/
	// SCROLLER DA PÁGINA PORTFÓLIO
	
	//$("#clientes").simplyScroll({
	//	className: 'vert',
	//	horizontal: false,
	//	frameRate: 20,
	//	speed: 5
	//});
	
	// INICIANDO O PNGFIX PARA O SITE INTEIRO
	$(document).pngFix();
	
	// INICIANDO O EFEITO CARROSSEL - HOME
	$('#novidades_home').jcarousel(); 
	
	// MÁSCARA PARA CAMPO "TELEFONE" DO FORMULÁRIO
	$("#telefone").mask("(99) 9999 - 9999");
	
	// ACCORDION PADRÃO DAS PÁGINAS
	// $("#accordion").accordion();
	
	$("a[rel^='prettyPopin']").prettyPopin();
	
	
	

});


