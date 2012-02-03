<?php

class Noticia extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 ),
	'conteudo' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Digite um conteudo'
		 ),
	'tipos_conteudos_id' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Escolha um tipo'
		 )
	);
	
	function addNoticia($dados) {

		return $this->save($dados) ;
		
	}
	
	function lastNews() {
		
		$lasts = $this->find('all' , array ( 
					'fields' => array (
						'Noticia.id',
						'Noticia.nome',
						'Tipos_conteudos.nome'
						),
					'joins' => array(
						array(
							'table' => 'tipos_conteudos',
							'alias' => 'Tipos_conteudos',
							'type' => 'INNER',
							'conditions' => array ( 'Noticia.tipos_conteudos_id = Tipos_conteudos.id' )
							)
						),
					'order' => array ( 'Noticia.id' => 'DESC' ),
					'limit' => 8	
				 	)
				 );
		
		return $lasts;
				 
	}
	
	function deleteNoticia($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
}


?>