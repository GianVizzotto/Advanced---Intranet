<?php

class DepartamentosController extends AppController {
	
	var $uses = array ( 'Departamento' ) ;
	
	function index(){
		$ultimos_departamentos = $this->Departamento->lastDptos() ;
		$this->set('ultimos_departamentos' , $ultimos_departamentos);
		// print_r ($ultimos_departamentos);
		// die;
	}
	
	function add($id = null){

		if (!empty($id)){
			$this->Departamento->id = $id;
			$this->set('id' , $id);
		}
		
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
	
}


?>