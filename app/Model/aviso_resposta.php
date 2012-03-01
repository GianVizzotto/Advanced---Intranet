<?php
class AvisoResposta extends AppModel {
	
	public $useTable = 'avisos_respostas';
	
	function salvaResposta($dados){
		
		$this->save($dados);
		
	}
	
	function recuperaComentarios($id, $ultimo){
		
		if($ultimo) {
			
			$conditions = array('AvisoResposta.aviso_id = '.$id, 'AvisoResposta.id = '.$ultimo);
			
		} else {
			
			$conditions = array('aviso_id = '.$id);
			
		}
		
		return	$this->find('all', array(
					'fields' => array(
						'AvisoResposta.id',
						'AvisoResposta.aviso_id',
						'AvisoResposta.resposta',
						'Usuario.nome',
						'AvisoResposta.data_criacao'
						),
					'joins' => array(
						array(
							'table' => 'usuarios',
							'alias' => 'Usuario',
							'type'	=> 'INNER',
							'conditions' => array('AvisoResposta.usuario_id = Usuario.id')
							)
						),
					'conditions' => $conditions
						)
				);
		
	}
	
}