function mostraUsuarios(departamento_id, classe, controller, action,id_extra){
	
	if(id_extra != undefined){
	
		$.ajax({
			url:'/'+controller+'/'+action+'/'+departamento_id+'/'+id_extra,
			type:'GET',
			dataType:'html',
			beforeSend: function(){
				$('.'+classe).html('Carregando...');
			},
			success: function(result){
				
				$('.'+classe).html(result);
			},
			error: function(err){
				alert("Erro ao procurar usuários.");
			}
		});
	
	} else {
		
		if(departamento_id != ''){
		
			$.ajax({
				url:'/'+controller+'/'+action+'/'+departamento_id,
				type:'GET',
				dataType:'html',
				beforeSend: function(){
					$('.'+classe).html('Carregando...');
				},
				success: function(result){
					$('.'+classe).html(result);
				},
				error: function(err){
					alert("Erro ao procurar usuários.");
				}
			});
		
		} else {
			$('.'+classe).html('Usu&aacute;rios<br /><select><option value=>Selecione</option></select>');
		}
		
	}
	
}