<?php

class Tipos_conteudo extends AppModel {
	
	var $useTable = 'tipos_conteudos' ;
	
	function getTipos() {
		
		$tipos_conteudos =	$this->find('list' , array ( 
										'fields' => array ( 
											'id',
											'nome'
											)
										)
									) ;
							
		return $tipos_conteudos ;
		
	}
	
}