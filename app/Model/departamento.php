<?php

class Departamento extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 )
	);
	
	function getDepartamentos() {
		
		$departamentos =	$this->find('list' , array ( 
								'fields' => array ( 
									'id',
									'nome'
									)
								)
							) ;
							
		return $departamentos ;
								
	}
	
	function lastDptos() {
		
		$lasts = $this->find('all' , array ( 
					'fields' => array (
						'Departamento.id',
						'Departamento.nome',
						'Departamento.descricao'
						),
					'order' => array ( 'Departamento.id' => 'DESC' ),
					'limit' => 8	
				 	)
				 );
		
		return $lasts;
				 
	}
	
	function addDepartamento($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteDepartamento($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
}