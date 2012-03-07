<?php

class Tipos_conteudo extends AppModel {
	
	var $useTable = 'tipos_conteudos' ;
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 )
	);
	
	function addTipos($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteTipos($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
	function getTipos() {
		
		$tipos_conteudos =	$this->find('list' , array ( 
										'fields' => array ( 
											'id',
											'nome'
											),
										'conditions' => array ( 'id > 1' )
										)
									) ;
							
		return $tipos_conteudos ;
		
	}
	
}