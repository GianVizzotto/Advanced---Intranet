<?php

class Ajuda extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 ),
	'conteudo' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Digite um conteudo'
		 ),
	'tipos_ajudas_id' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Escolha um tipo'
		 )
	);
	
	function addAjuda($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteAjuda($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
	function getUrlImagem($id){
		$url_imagem =	$this->find('first' , array ( 
										'fields' => array ( 
											'imagem'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $url_imagem ;
	}
	
	function getAjuda($id){
		$ajuda_unico =	$this->find('first' , array ( 
										'fields' => array (
											'id', 
											'nome', 
											'conteudo', 
											'imagem'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $ajuda_unico ;
	}
}


?>