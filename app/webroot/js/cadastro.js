$(document).ready(function(){
	
	$('#UsuarioTelefone').mask("(99)9999-9999");
	$("#UsuarioCelular").mask("(99)9999-9999");
	
	$('#UsuarioDataNascimento').mask("99/99/9999", function(){
		$('#UsuarioDataNascimento').attr('maxlength' , '8');
	});
	
	cargo_id = $("#cargo_id_aux").val();
	
	if(cargo_id != undefined){
		
		dpto_id = $("#UsuarioDepartamentoId").val();
		mostraUsuarios(dpto_id,'cargos','usuarios','cargos',cargo_id);
		
	}
	
});