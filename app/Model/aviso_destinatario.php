<?php
class AvisoDestinatario extends AppModel {
	
	public $useTable = 'avisos_destinatarios';
	
	public $validate = array(
		'departamento_id' => array ( 
			'rule' => 'notEmpty',
			'message' => 'Este campo não pode ser vazio'
		),
	);
	
	
	function getDestinatarios($aviso_id){
		
		$destinatarios = $this->find('all', array(
			'fields' => array(
				'AvisoDestinatario.id',
				'AvisoDestinatario.aviso_id',
				'AvisoDestinatario.departamento_id',
				'AvisoDestinatario.usuario_id',
				'Departamento.nome',
				'Usuario.nome'
			),
			'joins' => array(
				array(
					'table' => 'usuarios',
					'alias' => 'Usuario',
					'type' => 'LEFT',
					'conditions' => array('AvisoDestinatario.usuario_id = Usuario.id')
					),
				array(
					'table' => 'departamentos',
					'alias' => 'Departamento',
					'type' => 'LEFT',
					'conditions' => array('AvisoDestinatario.departamento_id = Departamento.id')
					)	
				),
			'conditions' => array('AvisoDestinatario.aviso_id = '.$aviso_id)					
			)
		);
		
		return $destinatarios;
		
	}
	
}