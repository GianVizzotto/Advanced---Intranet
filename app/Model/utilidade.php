<?php

class Utilidade extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 ),
	'conteudo' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Digite um conteudo'
		 ),
	'tipos_utilidades_id' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Escolha um tipo'
		 )
	);
	
	function addUtilidade($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteUtilidade($dados){
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
	
	function getUtilidade($id){
		$utilidade_unico =	$this->find('first' , array ( 
										'fields' => array (
											'id', 
											'nome', 
											'conteudo', 
											'imagem'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $utilidade_unico ;
	}
}


?>