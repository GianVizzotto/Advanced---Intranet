<?php

class Cargo extends AppModel {
	
	var $useTable = 'cargos' ;
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 ),
	'departamento_id' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Escolha um departamento'
		 ),
	'descricao' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		)	
	);
	
	function getCargos($departamento_id, $cargo_id = null) {
		
		if($cargo_id){
			$conditions = array('departamento_id = '.$departamento_id, 'id ='. $cargo_id);
		} else {
			$conditions = array('departamento_id = '.$departamento_id);
		}
		
		$cargos =	$this->find('list' , array ( 
								'fields' => array ( 
									'id',
									'nome'
									),
								'conditions' => $conditions	
								)
							) ;
							
		if($cargo_id == null){
			$cargos = array ( '' => 'Selecione' ) + (array)$cargos;
		}					
							
		return $cargos ;
		
	}
	
	function addCargo($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteCargo($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
	
}