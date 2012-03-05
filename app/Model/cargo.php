<?php

class Cargo extends AppModel {
	
	var $useTable = 'cargos' ;
	
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
	
}