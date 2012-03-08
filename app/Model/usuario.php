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
						'Usuario.perfil_id',
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
					'conditions' => array ( 'status_usuario_id' => 1 ),	
					'order' => array ( 'Usuario.id' => 'DESC' ),
					'limit' => 8	
				 	)
				 );
		
		return $lasts;
				 
	}
	
	function invalidaLogin ($dados) {
		
	 	return $this->save($dados);
		
	}
	
	function getUsuarioDpto($departamento_id , $usuario_id, $tipo = null) {
		
		if($departamento_id != 0) {
		
			if ($tipo == null) {
				
				$condicao = array( 'id = '.$usuario_id, 'departamento_id ='. $departamento_id ) ;
				
			} elseif ($tipo == 1) {
				
				$condicao = array('departamento_id ='. $departamento_id, 'id != '.$usuario_id ) ;
	
			}
			
			$usuarios =	$this->find('list' , array(
							'fields' => array(
								'id',
								'nome'
								),
							'conditions' => $condicao
							)
						);
			
			return $usuarios ;
			
		} else {
			
			return $usuarios = array('0' => 'Todos');
			
		}
		
	}
	
	function getUrlImagem($id){
		$url_imagem =	$this->find('first' , array ( 
										'fields' => array ( 
											'foto_url'
											),
										'conditions' => array ( 'id' => $id )
										)
									) ;
							
		return $url_imagem ;
	}
	
}