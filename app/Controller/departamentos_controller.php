<?php

class DepartamentosController extends AppController {
	
	var $uses = array ( 'Departamento', 'Noticia', 'Departamentos_conteudo' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);

	function index(){

		$this->paginate = array(
			'fields' => array(
				'Departamento.id',
				'Departamento.nome',
				'Departamento.descricao'
				)
			);
				
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Departamento.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['descricao'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Departamento.descricao) like lower('%".$filtros['descricao']."%')" 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		
		$this->request->data['Departamentos'] = $filtros ;
		$dados = $this->paginate('Departamento') ;
		$this->set('ultimos_departamentos' , $dados) ;
		
	}
	
	function add($id = null){

		if (!empty($id)){
			$this->Departamento->id = $id;
			$this->set('id' , $id);
		}
		
		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);
		
		$ckfinderPath = 'js/ckfinder/';
   		$this->set('ckfinderPath', $ckfinderPath);
		
		if (!empty($this->data)){
			$this->Departamento->set($this->data);
			if ($this->Departamento->validates()){
				if ($this->Departamento->addDepartamento($this->data)){
					$this->Session->setFlash('Departamento editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Departamento!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Departamento->read();
		}
		
	}
	
	function remove($id){
		
		$this->layout = '' ;
		
		if ($this->Departamento->deleteDepartamento($id)){
			$this->Session->setFlash('Departamento exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Departamento!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function visualizar($id = null){
		
		if (!empty($id)){
			$this->Departamento->id = $id;
			$this->set('id' , $id);
			
			$noticias_direita = $this->Noticia->find('all', array(
														'fields' => array (
																	'id', 
																	'nome', 
																	'data_criacao', 
																	'conteudo'
																	),
																'order' => array ( 'id' => 'DESC' ),
																'limit' => 3
														)
													);
			$this->set('noticias_direita' , $noticias_direita);
			
			$conteudo_baixo = $this->Departamentos_conteudo->find('all', array(
																	'fields' => array (
																				'id', 
																				'titulo', 
																				),
																			'conditions' => array ('departamentos_id' => $id),
																			'order' => array ( 'id' => 'DESC' ),
																	)
																);
			$this->set('conteudo_baixo' , $conteudo_baixo);
			
			
			
			$departamento = $this->Departamento->read();
			$this->set('departamento',$departamento);
		}else{
			$this->redirect(array('controller' => 'dashboard'));
		}
		
	}
	
}


?>