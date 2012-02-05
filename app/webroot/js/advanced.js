function mostraUsuarios(departamento_id, classe, controller, action){
	
	$.ajax({
		url:'/'+controller+'/'+action+'/'+departamento_id,
		type:'GET',
		dataType:'html',
		beforeSend: function(){
			$('.'+classe).html('Carregando...');
		},
		success: function(result){
			$('.'+classe).html(result);
		}	
	});
	
}