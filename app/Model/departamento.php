<?php

class Departamento extends AppModel {
	
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
	
}