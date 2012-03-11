<?php

class Manuai extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 )
	);
	
	function addManual($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteManual($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
	function getUrlArquivo($id){
		$url_imagem =	$this->find('first' , array ( 
										'fields' => array ( 
											'arquivo'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $url_imagem ;
	}
	
	function getManual($id){
		$manual_unico =	$this->find('first' , array ( 
										'fields' => array (
											'id', 
											'nome', 
											'arquivo'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $manual_unico ;
	}
	
}


?>