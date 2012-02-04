<?php

class Tipos_conteudo extends AppModel {
	
	var $useTable = 'tipos_conteudos' ;
	
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