//Responsável por salvar um aviso da maneira normal, porém quando a origem vem de um outro aviso dentro do modal box

function salvaAviso(){
	
	var dados = $("#Aviso").serialize();
	
	$.ajax({		
		url: '/avisos/salvaAviso/',
		type: 'post',
		data:dados,	
		dataType: 'html',
		success: function(ret){
			location.href="/avisos#";
		},
		error: function(err){
			alert('Erro');
			//location.href="/avisos#";
		}
	});
	
	return false;
}

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
