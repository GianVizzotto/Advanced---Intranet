<?php
class AvisoDestinatario extends AppModel {
	
	public $useTable = 'avisos_destinatarios';
	
	function getDestinatarios($aviso_id){
		
		$destinatarios = $this->find('all', array(
			'fields' => array(
				'AvisoDestinatario.id',
				'AvisoDestinatario.aviso_id',
				'Usuario.nome'
			),
			'joins' => array(
				array(
					'table' => 'usuarios',
					'alias' => 'Usuario',
					'type' => 'INNER',
					'conditions' => array('AvisoDestinatario.usuario_id = Usuario.id')
					)
				),
			'conditions' => array('AvisoDestinatario.aviso_id = '.$aviso_id
				)					
			)
		);
		
		return $destinatarios;
		
	}
	
}