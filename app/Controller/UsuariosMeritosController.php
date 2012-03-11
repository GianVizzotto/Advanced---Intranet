<?php

class UsuariosMeritosController extends AppController {

	var $uses = array ( 'Usuarios_merito', 'Usuario' ) ;
	var $helpers = array ( 'Paginator' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
	
		$validao_perfil = $this->Session->read('Usuario');
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
		
		$this->paginate = array(
							'fields' => array(
								'Usuarios_merito.id',
								'Usuarios_merito.conteudo',
								'Usuarios.nome'
								),
							'joins' => array(
								array(
									'table' => 'usuarios',
									'alias' => 'Usuarios',
									'type' => 'INNER',
									'conditions' => array ( 'Usuarios_merito.usuarios_id = Usuarios.id' )	
									)
								)
							);
		$filtros = "";
		
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		 // print_r($this->paginate);
		 // die;
		$this->request->data['UsuarioMeritos'] = $filtros ;
		$dados = $this->paginate() ;
		$this->set('ultimos_usuarios' , $dados);
		
	}
	
	function add($id = null){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;

		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);

		$ckfinderPath = 'js/ckfinder/';
   		$this->set('ckfinderPath', $ckfinderPath);
		
		$Usuarios = $this->Usuario->find('list' , array ( 
								'fields' => array (
									'Usuario.id',
									'Usuario.nome',
									),
								'conditions' => array ( 'status_usuario_id' => 1 ),	
								'order' => array ( 'Usuario.id' => 'DESC' ),
							 	)
							 );
		$Usuarios = array ( '' => 'Selecione' ) + (array)$Usuarios;
		
		
		if (!empty($id)){
			$this->Usuarios_merito->id = $id;
			$this->set('id' , $id);
		}else{
			$this->redirect(array('action' => 'index'));
		}
		
		
		if (!empty($this->data)){
			$this->Usuarios_merito->set($this->data);
			if ($this->Usuarios_merito->validates()){
				if ($this->Usuarios_merito->addUsuarios($this->data)){
					$this->Session->setFlash('Mérito do Funcionário editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Mérito do Funcionário!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Usuarios_merito->read();
		}
		
		$this->set('Usuarios' , $Usuarios);
		
	}

}



?>