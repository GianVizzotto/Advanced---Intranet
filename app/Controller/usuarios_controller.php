<?php

//App::import('Sanitize');

class UsuariosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' ) ;
	var $components = array ( 'Date' ) ;
	var $helpers = array ( 'Paginator' ) ;
	
	function cadastro( $id = null ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$perfis = $this->Perfil->getPerfis();
		$perfis = array ( '' => 'Selecione' ) + (array)$perfis;
		
		$ultimos_cadastrados = $this->Usuario->lastUsers() ;
		
		if( !empty($id) ) {
			
//			$this->Usuario->id = Sanitize::clean($id);	
			$this->Usuario->id = $id;
			
		} 
		
		if ( !empty($this->data['Usuario']) ) {
			
			//Atentar-se que não é mais possivel gravar no $this->data, necessário usar $this->request->data para sobrescrita de valor
			$this->request->data['Usuario']['data_nascimento'] = $this->Date->ReadToDB($this->data['Usuario']['data_nascimento']);

			$this->Usuario->set($this->data['Usuario']);
			
			if ( $this->Usuario->validates() ) {
				
				if ( $this->Usuario->addusuario($this->data['Usuario']) ) {
					
					$this->Session->setFlash('Usuário cadastrado com sucesso!', 'confirm_message');
					$this->redirect('/usuarios/cadastro');
					
				} else {
					
					$this->Session->setFlash('Erro ao cadastrar usuário!', 'error_message');
					
				}
				
			} else {
				
				$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
				
			}
			
		} else {
			
			$this->request->data = $this->Usuario->read();
			$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
			
		}
	
		$this->set('departamentos' , $departamentos);
		$this->set('perfis' , $perfis);
		$this->set('ultimos_cadastrados' , $ultimos_cadastrados);
		
	}
	
	function listar(){

		//Under Construction
		
	}
	
	function excluir($id) {
	
		$this->render = false ;
		
		$this->Usuario->id = $id ;
		
		$dados['Usuario'] = array('status_usuarios_id' => 2) ;
		
		$result = $this->Usuario->invalidaLogin($dados) ;
		
		if($result){
			
			$this->Session->setFlash('Usuário inativado com sucesso!', 'confirm_message');
			$this->redirect('/usuarios/cadastro');
			
		} else {
			
			$this->Session->setFlash('Erro ao inativar usuário!', 'error_message');
			$this->redirect('/usuarios/cadastro');
			
		}		
		
	}
	
}