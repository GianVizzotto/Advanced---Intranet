<?php

class Perfil extends AppModel {
	
	var $useTable = 'perfis' ;
	
	function getPerfis() {
		
		$perfis =	$this->find('list' , array ( 
								'fields' => array ( 
									'id',
									'nome'
									)
								)
							) ;
							
		return $perfis ;
		
	}
	
}