<?php

class Aviso extends AppModel {
	
	var $validate = array ( 
			'departamento_id' => array ( 
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
		
		return $this->save($dados);
		
	}
	
	function filtraAvisos($tipo_filtro , $valor = null , $usuario_id=null, $departamento_id=null, $aviso_id=null) {
		
		if($tipo_filtro == 1){
			
			if($valor != 3){
				$condição = 'Aviso.status_aviso_id ='.  $valor; 
			} else {
				$condição = array ( '1=1 and Aviso.usuario_id = '.$usuario_id.' or Aviso.departamento_id = '.$departamento_id );
			}
			
		} elseif ( $tipo_filtro == 3 ) {
			
			$condição = array( 'Aviso.id = '.$aviso_id );
			
		} else {
			
			$fim = "'". date('Y-m-d')." 23:59:59" ."'";
			$inicio = "'". date('Y-m-d')." 00:00:00" ."'";
			
			$condição = array("Aviso.data_criacao >=  $inicio and Aviso.data_criacao <= $fim", 'Aviso.usuario_id = '.$usuario_id.' or Aviso.departamento_id = '.$departamento_id);
						
		}
		
		$avisos =	$this->find('all' , array ( 
						'fields' => array(
							'Aviso.id',
							'Aviso.assunto',
							'Aviso.mensagem',
							'Aviso.data_criacao',
							'Aviso.anexo',
							'Usuario.nome',
							'Departamento.nome',
							'Cargo.nome'
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
								),
							array(
								'table' => 'cargos',
								'alias' => 'Cargo',
								'type' => 'INNER',
								'conditions' => array ( 'Usuario.cargo_id = Cargo.id' )
								)	
							),
						'conditions' => $condição
						)							
					);
					
		return $avisos ;			
			
	}
	
}