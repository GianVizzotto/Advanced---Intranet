<?php

//App::import('Sanitize');

class UsuariosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario' ) ;
	var $components = array ( 'Date' ) ;
	var $helpers = array ( 'Paginator' ) ;
	
	public $paginate = array(
        	'limit' => 25
			);
			
	function index(){
		
		$this->redirect('/usuarios/listar'); 
		
	}		
	
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
	
	function listar() {

		$status = $this->StatusUsuario->getStatus() ;
		$status = array('' => 'Selecione') + (array)$status;
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('status' , $status) ;
		$this->set('departamentos' , $departamentos) ;
		
		$this->paginate = array(
			'fields' => array(
				'Usuario.id',
				'Usuario.nome',
				'Usuario.email',
				'Departamento.nome',
				'Status.nome'
				),
			'joins' => array(
				array(
					'table' => 'departamentos',
					'alias' => 'Departamento',
					'type' => 'INNER',
					'conditions' => array ( 'Usuario.departamento_id = Departamento.id' )	
				),
				array(
					'table' => 'status_usuarios',
					'alias' => 'Status',
					'type' => 'INNER',
					'conditions' => array ( 'Usuario.status_usuario_id = Status.id' )
					)
				)
		);
		
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Usuario.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['email'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Usuario.email) like lower('".$filtros['email']."')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['departamento_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					'Departamento.id = '. $filtros['departamento_id']
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['status_usuario_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					'Status.id = '. $filtros['status_usuario_id']
				);
				
			}
			
		}
		
		$this->request->data['Usuarios'] = $filtros ;
		
		$dados = $this->paginate('Usuario') ;
		$this->set('usuarios' , $dados) ;
		
	}
	
	function excluir($id) {
	
		$this->render = false ;
		
		$this->Usuario->id = $id ;
		
		$dados['Usuario'] = array('status_usuario_id' => 2) ;
		
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