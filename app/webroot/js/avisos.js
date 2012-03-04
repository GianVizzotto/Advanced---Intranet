//$(document).ready(function(){
//	
//	var departamento_id = $("#FiltroAvisoDepartamentoId").val();
//	var usuario_id = $("#FiltroAvisoUsuarioId").val();
//	
//	if ( $('#FiltroAvisoStatusAvisoId').val() == '') {
//		getAvisos(2, '', usuario_id, departamento_id);
//	}
//	
//	$('#FiltroAvisoStatusAvisoId').change(function(){
//		
//		filtro = $('#FiltroAvisoStatusAvisoId').val();
//		
//		if(filtro != 'undefined' && filtro != '' && filtro != 1){
//			getAvisos(1, filtro, usuario_id, departamento_id);			
//		} else {
//			if(filtro == 1){
//				getAvisos(2, '', usuario_id, departamento_id);
//			}
//		}		
//	});
//	
//});
//
//function getAvisos(tipo_filtro, filtro, usuario_id, departamento_id){
//	
//	if(filtro == '') {
//		
//		stringUrl = '/avisos/filtraAvisos/' + tipo_filtro +'/'+ null +'/'+ usuario_id +'/'+ departamento_id;
//		exibir = 'Últimos';
//		
//	} else {
//		
//		stringUrl = '/avisos/filtraAvisos/' + tipo_filtro + '/' + filtro +'/'+ usuario_id +'/'+ departamento_id;
//			
//		switch(filtro) {
//			case '1':
//				exibir = " Últimos";
//				break;
//			case '2':
//				exibir = " Não lidos";
//				break;
//			case '3':
//				exibir = " Todos";
//				break;
//			case '4':
//				exibir = " Arquivados";
//				break;
//			case '5':
//				exibir = " Lixeira";
//				break;
//			default:
//				exibir = " Últimos";
//		}
//		
//	}
//	
//	$('#exibir').html(exibir);
//	
//	$.ajax({
//		url: stringUrl,
//		dataType: 'html',
//		success: function(html){
//		
//			if(html != '') {
//				$('#grid').html(html);
//			} else {
//				$('#grid').html('<center><strong>Nenhum resultado encontrado.</strong></center>');
//			}			
//		},
//		error: function(err){
//			alert('Impossível carregar avisos.');
//		}
//	});
//	
//}

function gravaResposta(){
	
	msg = $("#AvisoRespostaResposta").val();
	id = $("#AvisoRespostaId").val();
	
	if(msg !=''){
	
		$.ajax({		
			url: '/avisos/salvaResposta/' + id + '/1/' + msg,
			dataType: 'json',
			success: function(ret){
			
				$("#semComentario").hide();
				$("#AvisoRespostaResposta").attr('value', '');
				
				for(i in ret){
					
					$(".comentarios").append(
							"<div class=topico>"
							+"<p>"+$.format.date(ret[i]['AvisoResposta']['data_criacao'], "dd/MM/yyyy - HH:mm")+" - "+ret[i]['Usuario']['nome']+"</p>"
							+"<p>"+ret[i]['AvisoResposta']['resposta']+"</p>"
							+"</div><hr>"
							);
					
				}
				$("#data").attr("class", "longDateFormat");
				$.format.date();
			},
			error: function(err){
				alert('Impossível salvar comentários.');
			}
		});
		
	}	
	
	return false;
}

function recuperaRespostas(id){
	
	$.ajax({		
		url: '/avisos/salvaResposta/' + id + '/2',
		dataType: 'json',
		success: function(ret){
		
			if(ret != ''){
			
				$("#semComentario").hide();
				
				for(i in ret){
					
					$(".comentarios").append(
							"<div class=topico>"
							+"<p>"+$.format.date(ret[i]['AvisoResposta']['data_criacao'], "dd/MM/yyyy - HH:mm")+" - "+ret[i]['Usuario']['nome']+"</p>"
							+"<p>"+ret[i]['AvisoResposta']['resposta']+"</p>"
							+"</div><hr>"
							);
					
				}				
				
			} else {
				
				$(".comentarios").append("<p id=semComentario>Nenhum comentário até o momento.</p>");
			}
			
		},
		error: function(err){
			alert('Impossível recuperar comentários.');
		}
	});			
	
}
