<?php

class Evento extends AppModel {
	
	var $validate = array (
	'nome' => array ( 
		'rule' => 'notEmpty',
		'message' => 'Este campo não pode ser vazio'
		 ),
	'conteudo' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Digite um conteudo'
		 ),
	'tipos_conteudo_id' => array (
		 'rule' => 'notEmpty',
		 'message' => 'Escolha um tipo'
		 )
	);
	
	function addEvento($dados) {

		return $this->save($dados) ;
		
	}
	
	function lastUsers() {
		
		$lasts = $this->find('all' , array ( 
					'fields' => array (
						'Evento.id',
						'Evento.nome',
						'Tipos_conteudos.nome'
						),
					'joins' => array(
						array(
							'table' => 'tipos_conteudos',
							'alias' => 'Tipos_conteudos',
							'type' => 'INNER',
							'conditions' => array ( 'Evento.tipos_conteudo_id = Tipos_conteudos.id' )
							)
						),
					'order' => array ( 'Evento.id' => 'DESC' ),
					'limit' => 8	
				 	)
				 );
		
		return $lasts;
				 
	}
	
	function deleteEvento($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
}


?>