<?php

class CargosController extends AppController {
	
	var $uses = array ( 'Cargo' , 'Departamento' ) ;
	var $helpers = array ( 'Paginator' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);

	function index(){
		
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('departamentos' , $departamentos) ;
		
		$this->paginate = array(
			'fields' => array(
				'Cargo.id',
				'Cargo.nome',
				'Cargo.descricao',
				'Departamento.nome'
				),
			'joins' => array(
				array(
					'table' => 'departamentos',
					'alias' => 'Departamento',
					'type' => 'INNER',
					'conditions' => array ( 'Cargo.departamento_id = Departamento.id' )	
				)
			)
		);
		
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Cargo.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['departamento_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					'Departamento.id = '. $filtros['departamento_id']
				);
				
				$x++ ;
				
			}
			
		}
		
		$this->paginate['limit'] = 20;
		$this->paginate['paramType'] = 'querystring';
		
		$this->request->data['Cargos'] = $filtros ;
		
		$dados = $this->paginate('Cargo') ;
		$this->set('cargos' , $dados) ;
		
	}

	function add($id = null){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		if (!empty($id)){
			$this->Cargo->id = $id;
			$this->set('id' , $id);
		}
		
		if (!empty($this->data)){
			$this->Cargo->set($this->data);
			if ($this->Cargo->validates()){
				if ($this->Cargo->addCargo($this->data)){
					$this->Session->setFlash('Cargo editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Cargo!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Cargo->read();
		}
		
		$this->set('departamentos' , $departamentos) ;
		
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		if ($this->Cargo->deleteCargo($id)){
			$this->Session->setFlash('Cargo exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Cargo!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
}
		