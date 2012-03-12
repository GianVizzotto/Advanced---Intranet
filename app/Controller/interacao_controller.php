<?php

class InteracaoController extends AppController{
	
	var $uses = array ('Manuai', 'Usuarios_me', 'Usuarios_merito', 'Tipos_utilidade', 'Aviso', 'AvisoDestinatario');
	
	function index(){
		
		$manuais =	$this->Manuai->find('all' , array ( 
											'fields' => array (
												'id', 
												'nome', 
												'arquivo'
												),
											'order' => array ( 'id' => 'DESC' )
											)
										) ;

		$this->set('manuais',$manuais);
		
		$utilidades =	$this->Tipos_utilidade->find('all' , array ( 
													'fields' => array (
														'id', 
														'nome'
														),
													'order' => array ( 'id' => 'DESC' )
													)
												) ;

		$this->set('utilidades',$utilidades);
		
		$mes = $this->Usuarios_me->find('all' , array ( 
													'fields' => array (
														'Usuarios_me.id', 
														'Usuarios_me.conteudo',
														'Usuarios.id',
														'Usuarios.nome',
														'Usuarios.foto_url',
														'Departamentos.id'
													),
													'joins' => array(
														array(
															'table' => 'usuarios',
															'alias' => 'Usuarios',
															'type' => 'INNER',
															'conditions' => array ( 'Usuarios_me.usuarios_id = Usuarios.id' )	
															),
														array(
															'table' => 'departamentos',
															'alias' => 'Departamentos',
															'type' => 'INNER',
															'conditions' => array ( 'Usuarios.departamento_id = Departamentos.id' )	
															)
														)
													)
												) ;
		// pr($mes);
		// die;

		$this->set('mes',$mes);
		
		$merito = $this->Usuarios_merito->find('all' , array ( 
													'fields' => array (
														'Usuarios_merito.id', 
														'Usuarios_merito.conteudo',
														'Usuarios.id',
														'Usuarios.nome',
														'Usuarios.foto_url',
														'Departamentos.id'
														),
													'joins' => array(
														array(
															'table' => 'usuarios',
															'alias' => 'Usuarios',
															'type' => 'INNER',
															'conditions' => array ( 'Usuarios_merito.usuarios_id = Usuarios.id' )	
															),
														array(
															'table' => 'departamentos',
															'alias' => 'Departamentos',
															'type' => 'INNER',
															'conditions' => array ( 'Usuarios.departamento_id = Departamentos.id' )	
															)
														),
													)
												) ;
		// pr($merito);
		// die;

		$this->set('merito',$merito);		
	}
	
	function salvaAviso(){
		
		$this->autoRender = false;
		
		if(isset($this->data['Aviso'])){
			
			$usuario_dados = $this->Session->read('Usuario');
				
				$this->request->data['Aviso']['usuario_id'] = $usuario_dados['Usuario']['id'];
				
				$this->Aviso->set($this->data);
				$this->AvisoDestinatario->set($this->data['AvisoDestinatario']);
				
				if ( $this->Aviso->validates() &&  $this->AvisoDestinatario->validates()) {
					
					if($this->Aviso->salvaAviso($this->data['Aviso'])) {
						
						if(!empty($this->data['AvisoDestinatario'])){
								
							$this->request->data['AvisoDestinatario']['aviso_id'] = $this->Aviso->getLastInsertID();
							$this->AvisoDestinatario->save($this->data['AvisoDestinatario']);
							
						}
						
						$this->Session->setFlash('Aviso cadastrado com sucesso.', 'flash_confirm');
						unset($this->data);
						$this->redirect('/interacao');
						
					} else {
						
						$this->Session->setFlash('Aviso não cadastrado.', 'flash_error');
						$this->redirect('/interacao');
						
					}
					
				}
				
			}
		
	}	
	
}



?>