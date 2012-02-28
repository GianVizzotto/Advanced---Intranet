$(document).ready(function(){
	
	if ( $('#FiltroAvisoStatusAvisoId').val() == '') {
		getAvisos(2);
	}
	
	$('#FiltroAvisoStatusAvisoId').change(function(){
		
		filtro = $('#FiltroAvisoStatusAvisoId').val();
		
		if(filtro != 'undefined' && filtro != '' && filtro != 1){
			getAvisos(1,filtro);			
		} else {
			if(filtro == 1){
				getAvisos(2);
			}
		}		
	});
	
});

function getAvisos(tipo_filtro , filtro){
	
	if(filtro == '') {
		
		stringUrl = '/avisos/filtraAvisos/' + tipo_filtro;
		exibir = 'Últimos';
		
	} else {
		
		stringUrl = '/avisos/filtraAvisos/' + tipo_filtro + '/' + filtro;
			
		switch(filtro) {
			case '1':
				exibir = " Últimos";
				break;
			case '2':
				exibir = " Não lidos";
				break;
			case '3':
				exibir = " Todos";
				break;
			case '4':
				exibir = " Arquivados";
				break;
			case '5':
				exibir = " Lixeira";
				break;
			default:
				exibir = " Últimos";
		}
		
	}
	
	$('#exibir').html(exibir);
	
	$.ajax({
		url: stringUrl,
		dataType: 'html',
		success: function(html){
		
			if(html != '') {
				$('#grid').html(html);
			} else {
				$('#grid').html('<center><strong>Nenhum resultado encontrado.</strong></center>');
			}			
		},
		error: function(err){
			alert('Impossível carregar avisos.');
		}
	});
	
}