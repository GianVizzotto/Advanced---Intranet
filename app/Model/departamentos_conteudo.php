<?php

class Departamentos_conteudo extends AppModel {
	
	var $useTable = 'departamentos_conteudos' ;
	
	var $validate = array (
		'titulo' => array ( 
			'rule' => 'notEmpty',
			'message' => 'Este campo não pode ser vazio'
			 ),
		'conteudo' => array ( 
			'rule' => 'notEmpty',
			'message' => 'Este campo não pode ser vazio'
			 )
	);
	
	function addDptoConteudos($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteDptoConteudos($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
	function getDptoConteudos($id) {
		
		$dptos_conteudos_unico =	$this->find('first' , array ( 
												'fields' => array ( 
													'id',
													'titulo',
													'conteudo'
																										),
												'conditions' => array ( 'id' => $id )
												)
											) ;
							
		return $dptos_conteudos_unico ;
		
	}
	
}