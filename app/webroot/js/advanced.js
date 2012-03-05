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
				alert(id_extra);
			}
		});
	
	} else {
		
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
				alert(id_extra);
			}
		});
		
	}
	
}