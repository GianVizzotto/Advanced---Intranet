<?php

class UsuariosMesController extends AppController {

	var $uses = array ( 'Usuarios_me', 'Usuario' ) ;
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
								'Usuarios_me.id',
								'Usuarios_me.conteudo',
								'Usuarios.nome'
								),
							'joins' => array(
								array(
									'table' => 'usuarios',
									'alias' => 'Usuarios',
									'type' => 'INNER',
									'conditions' => array ( 'Usuarios_me.usuarios_id = Usuarios.id' )	
									)
								)
							);
		$filtros = "";
		
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		 // print_r($this->paginate);
		 // die;
		$this->request->data['UsuarioMes'] = $filtros ;
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
		
		
		// if (!empty($id)){
			// $this->Usuarios_me->id = $id;
			// $this->set('id' , $id);
		// }else{
			// $this->redirect(array('action' => 'index'));
		// }
		if (!empty($id)){
			$this->Usuarios_me->id = $id;
			$this->set('id' , $id);
		}
		
		if (!empty($this->data)){
			$this->Usuarios_me->set($this->data);
			if ($this->Usuarios_me->validates()){
				if ($this->Usuarios_me->addUsuarios($this->data)){
					$this->Session->setFlash('Funcionário do Mês editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Funcionário do Mês!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Usuarios_me->read();
		}
		
		$this->set('Usuarios' , $Usuarios);
		
	}

	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		if ($this->Usuarios_merito->deleteMerito($id)){
			$this->Session->setFlash('Funcionário do Mês exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Funcionário do Mês!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
}



?>