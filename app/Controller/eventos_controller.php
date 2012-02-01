<?php

class EventosController extends AppController {
	
	var $uses = array ( 'Tipos_conteudo' , 'Evento' ) ;
	
	function index(){
		$ultimos_eventos = $this->Evento->lastUsers() ;
		$this->set('ultimos_eventos' , $ultimos_eventos);
	}
	
	function add($id = null){

		$Tipos_conteudos = $this->Tipos_conteudo->getTipos();
		$Tipos_conteudos = array ( '' => 'Selecione' ) + (array)$Tipos_conteudos;
		
		if (!empty($id)){
			$this->Evento->id = $id;
			$this->set('id' , $id);
		}
		
		if (!empty($this->data)){
			$this->Evento->set($this->data);
			if ($this->Evento->validates()){
				if ($this->Evento->addEvento($this->data)){
					$this->Session->setFlash('Evento editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Evento!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Evento->read();
		}
		
		$this->set('Tipos_conteudos' , $Tipos_conteudos);
				
	}
	
	function remove($id){
		
		$this->layout = '' ;
		
		if ($this->Evento->deleteEvento($id)){
			$this->Session->setFlash('Evento exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Evento!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
}


?>