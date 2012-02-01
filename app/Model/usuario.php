<?php

class Usuario extends AppModel {
	
	var $validate = array (
		'nome' => array ( 
			'rule' => 'notEmpty',
			'message' => 'Este campo não pode ser vazio'
			 ),
		'email' => array (
			 'rule' => 'email',
			 'message' => 'Digite um e-mail válido'
			 ),
		'senha' => array (
			 'rule' => array ( 
			 	'notEmpty',
			 	'maxLenght',
			 	'10'
			 	),
			 'message' => 'Digite uma senha de até 10 caracteres'	
			 ),
		'departamento_id' => array (
			 'rule' => 'notEmpty',
			 'message' => 'Escolha um departamento'
			 ),
		'ramal' => array ( 
			 'rule' => 'numeric',
			 'message' => 'Digite um ramal válido'
			 ),
		'data_nascimento' => array ( 
			 'rule' => array ( 'date', 'ymd' ),
			 'message' => 'Digite uma data válida'
			),
		'perfil_id' => array ( 
			'rule' => 'notEmpty',
			'message' => 'Este campo não pode ser vazio'
			)	
		);
		
	function addUsuario($dados) {

		return $this->save($dados) ;
		
	}
	
	function lastUsers() {
		
		$lasts = $this->find('all' , array ( 
					'fields' => array (
						'Usuario.id',
						'Usuario.nome',
						'Departamento.nome'
						),
					'joins' => array(
						array(
							'table' => 'departamentos',
							'alias' => 'Departamento',
							'type' => 'INNER',
							'conditions' => array ( 'Usuario.departamento_id = Departamento.id' )
							)
						),
					'conditions' => array ( 'status_usuarios_id' => 1 ),	
					'order' => array ( 'Usuario.id' => 'DESC' ),
					'limit' => 8	
				 	)
				 );
		
		return $lasts;
				 
	}
	
	function invalidaLogin ($dados) {
		
	 	return $this->save($dados);
		
	}
	
}