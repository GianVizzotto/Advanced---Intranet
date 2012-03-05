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
	
//	function filtraAvisos($tipo_filtro , $valor = null , $usuario_id=null, $departamento_id=null, $aviso_id=null) {
//		
//		if($tipo_filtro == 1){
//			
//			if($valor != 3){
//				$condição = 'Aviso.status_aviso_id ='.  $valor; 
//			} else {
//				$condição = array ( '1=1 and Aviso.usuario_id = '.$usuario_id.' or AvisoDestinatario.departamento_id = '.$departamento_id );
//			}
//			
//		} elseif ( $tipo_filtro == 3 ) {
//			
//			$condição = array( 'Aviso.id = '.$aviso_id );
//			
//		} else {
//			
//			$fim = "'". date('Y-m-d')." 23:59:59" ."'";
//			$inicio = "'". date('Y-m-d')." 00:00:00" ."'";
//			
//			$condição = array("Aviso.data_criacao >=  $inicio and Aviso.data_criacao <= $fim", 'Aviso.usuario_id = '.$usuario_id.' or Aviso.departamento_id = '.$departamento_id);
//						
//		}
//		
//		$avisos =	$this->find('all' , array ( 
//						'fields' => array(
//							'Aviso.id',
//							'Aviso.assunto',
//							'Aviso.mensagem',
//							'Aviso.data_criacao',
//							'Aviso.anexo',
//							'Usuario.nome',
//							'Departamento.nome',
//							'Cargo.nome'
//							),
//						'joins' => array(
//							array(
//								'table' => 'usuarios',
//								'alias' => 'Usuario',
//								'type' => 'INNER',
//								'conditions' => array ( 'Aviso.usuario_id = Usuario.id' )
//							),
//							array(
//								'table' => 'departamentos',
//								'alias' => 'Departamento',
//								'type' => 'INNER',
//								'conditions' => array ( 'Aviso.departamento_id = Departamento.id' )
//								),
//							array(
//								'table' => 'cargos',
//								'alias' => 'Cargo',
//								'type' => 'INNER',
//								'conditions' => array ( 'Usuario.cargo_id = Cargo.id' )
//								)	
//							),
//						'conditions' => $condição
//						)							
//					);
//					
//		return $avisos ;			
//			
//	}

//	Exibe os detalhes de determinado aviso
	function filtraAvisos($aviso_id){

		$avisos = $this->find('all', array(
			'fields' => array(
				'Aviso.id',
				'Aviso.assunto',
				'Aviso.mensagem',
				'Aviso.data_criacao',
				'Aviso.anexo',
				'Aviso.status_aviso_id',
				'Usuario.nome',
				'Departamento.nome',
				'Cargo.nome'						
			),
			'joins' => array(
					array(
						'table' => 'usuarios',
						'alias' => 'Usuario',
						'type' => 'LEFT',
						'conditions' => array ( 'Aviso.usuario_id = Usuario.id' )
					),
					array(
						'table' => 'departamentos',
						'alias' => 'Departamento',
						'type' => 'LEFT',
						'conditions' => array ( 'Usuario.departamento_id = Departamento.id' )
						),
					array(
						'table' => 'cargos',
						'alias' => 'Cargo',
						'type' => 'LEFT',
						'conditions' => array ( 'Usuario.cargo_id = Cargo.id' )
						),
					),
			'conditions'=>'Aviso.id = '.$aviso_id		
			)
		);
					
		return $avisos;					
		
	}
	
	function atualizaStatus($aviso_id, $status){
		
		$dados['Aviso'] = array('id' => $aviso_id, 'status_aviso_id' => $status);
		
		$this->save($dados);
		
	}
	
	/**
	 * 
	 * Lista os avisos para determinada pessoa apenas de o aviso foi direcionado a ela ou ao departamento que pertence
	 */
	
	function getAvisos($usuario_dados, $limit=null){
		
		$conditions = array('(AvisoDestinatario.departamento_id ='.$usuario_dados['Usuario']['departamento_id'].' and AvisoDestinatario.usuario_id is null) or (AvisoDestinatario.usuario_id ='.$usuario_dados['Usuario']['id'].') or (Aviso.usuario_id ='.$usuario_dados['Usuario']['id'].')' );
		
		$avisos = $this->find('all', array(
			'fields' => array(
					'Aviso.id',
					'Aviso.usuario_id',
					'Aviso.assunto',
					'Aviso.data_criacao',
					'Usuario.nome',
					'Destinatario.nome',
					'Departamento.nome',
					'AvisoDestinatario.usuario_id',
					),
				'joins' => array(
					array(
						'table' => 'usuarios',
						'alias' => 'Usuario',
						'type' => 'INNER',
						'conditions' => array ( 'Aviso.usuario_id = Usuario.id' )
						),
					array(
						'table' => 'avisos_destinatarios',
						'alias' => 'AvisoDestinatario',
						'type' => 'LEFT',
						'conditions' => array ( 'Aviso.id = AvisoDestinatario.aviso_id' )
						),
					array(
						'table' => 'departamentos',
						'alias' => 'Departamento',
						'type' => 'INNER',
						'conditions' => array ( 'AvisoDestinatario.departamento_id = Departamento.id' )
						),
					array(
						'table' => 'usuarios',
						'alias' => 'Destinatario',
						'type' => 'LEFT',
						'conditions' => array ( 'AvisoDestinatario.usuario_id = Destinatario.id' )
						),			
					),
					'conditions' => $conditions,
					'order' => array('Aviso.data_criacao' => 'DESC'),
					'limit' => $limit
				)
			);	

		return $avisos;
		
	}
	
}