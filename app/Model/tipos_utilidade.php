<?php

class Tipos_utilidade extends AppModel {
	
	var $useTable = 'tipos_utilidades' ;
	
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
		
		$tipos_utilidades =	$this->find('list' , array ( 
										'fields' => array ( 
											'id',
											'nome'
											)
										)
									) ;
							
		return $tipos_utilidades ;
		
	}
	
}