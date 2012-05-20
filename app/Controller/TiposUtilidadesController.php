<?php

class TiposUtilidadesController extends AppController {

	var $uses = array ( 'Tipos_utilidade' ) ;
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
								'id',
								'nome'
								)
							);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			
		}
		
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		 // print_r($this->paginate);
		 // die;
		$this->request->data['TipoUtilidades'] = $filtros ;
		$dados = $this->paginate() ;
		$this->set('ultimos_tipos' , $dados);
		
	}
	
	function add($id = null){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		if (!empty($id)){
			$this->Tipos_utilidade->id = $id;
			$this->set('id' , $id);
		}
		
		if (!empty($this->data)){
			$this->Tipos_utilidade->set($this->data);
			if ($this->Tipos_utilidade->validates()){
				if ($this->Tipos_utilidade->addTipos($this->data)){
					$this->Session->setFlash('Categoria editada com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Categoria!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Tipos_utilidade->read();
		}
		
	}

	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		if ($this->Tipos_utilidade->deleteTipos($id)){
			$this->Session->setFlash('Categoria exclu&iacute;da com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Categoria!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
}



?>