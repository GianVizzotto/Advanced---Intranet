<?php
class StatusUsuario extends AppModel {
	
	var $useTable = status_usuarios ;
	var $name = 'StatusUsuario' ;
	
	function getStatus() {
		
		$status =	$this->find('list' , array ( 
						'fields' => array(
							'id',
							'nome'
							) ,
						)
					);
					
		return $status ;			
		
	}
	
}