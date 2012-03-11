<?php

class DepartamentosConteudosController extends AppController {

	var $uses = array ( 'Departamentos_conteudo', 'Departamento' ) ;
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
		$this->set('departamentos' , $departamentos);
		
		$this->paginate = array(
							'fields' => array(
								'Departamentos_conteudo.id',
								'Departamentos_conteudo.titulo',
								'Departamentos.nome'
								),
							'joins' => array(
								array(
									'table' => 'departamentos',
									'alias' => 'Departamentos',
									'type' => 'INNER',
									'conditions' => array ( 'Departamentos_conteudo.departamentos_id = Departamentos.id' )	
									)
								)
							);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['titulo'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(titulo) like lower('%".$filtros['titulo']."%')" 
				);
				
				$x++ ;
				
			}
			
			if ( !empty ( $filtros['departamentos_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Departamentos.id = ".$filtros['departamentos_id'] 
				);
				
				$x++ ;
				
			}
			
			
		}
		
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		 // print_r($this->paginate);
		 // die;
		$this->request->data['DepartamentoConteudos'] = $filtros ;
		$dados = $this->paginate() ;
		$this->set('ultimos_dptos' , $dados);
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
				
		if (!empty($id)){
			$this->Departamentos_conteudo->id = $id;
			$this->set('id' , $id);
		}
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		if (!empty($this->data)){
			$this->Departamentos_conteudo->set($this->data);
			if ($this->Departamentos_conteudo->validates()){
				if ($this->Departamentos_conteudo->addDptoConteudos($this->data)){
					$this->Session->setFlash('Conteúdo editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Conteúdo!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Departamentos_conteudo->read();
		}
		$this->set('departamentos' , $departamentos);
		
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		if ($this->Departamentos_conteudo->deleteDptoConteudos($id)){
			$this->Session->setFlash('Conteúdo exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Conteúdo!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function modalbox($id){
		$this->layout = '' ;
		$conteudo_unico = $this->Departamentos_conteudo->getDptoConteudos($id);
		$this->set('conteudo_unico' , $conteudo_unico);
	}
	
}
?>
		