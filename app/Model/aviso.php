<?php

class Aviso extends AppModel {
	
	var $validate = array ( 
			'departamento_id' => array ( 
				'rule' => 'notEmpty',
				'message' => 'Este campo não pode ser vazio'
				 ),
			'usuario_id' => array (
				 'rule' => 'notEmpty',
				 'message' => 'Este campo não pode ser vazio'
				 ),
			'assunto' => array (
				 'rule' => 'notEmpty',
				 'message' => 'Este campo não pode ser vazio'
				 ),
			'mensagem' => array (
				 'rule' => 'notEmpty',
				 'message' => 'Este campo não pode ser vazio'
				 ),	 
			);
	
	function salvaAviso($dados){
		
		$this->save($dados);
		
	}
	
	function ultimosAvisos($departamento_id = null) {
		
		$hoje = "'". date('Y-m-d')." 23:59:59" ."'" ;
		
		$avisos =	$this->find('all' , array ( 
						'fields' => array(
							'Aviso.id',
							'Aviso.assunto',
							'Aviso.mensagem',
							'Aviso.data_criacao',
							'Usuario.nome',
							'Departamento.nome'
							),
						'joins' => array(
							array(
								'table' => 'usuarios',
								'alias' => 'Usuario',
								'type' => 'INNER',
								'conditions' => array ( 'Aviso.usuario_id = Usuario.id' )
							),
							array(
								'table' => 'departamentos',
								'alias' => 'Departamento',
								'type' => 'INNER',
								'conditions' => array ( 'Aviso.departamento_id = Departamento.id' )
								)
							),
						'conditions' => "Aviso.data_criacao <=  $hoje"
						)							
					);
					
		return $avisos;					
				
	}
	
}