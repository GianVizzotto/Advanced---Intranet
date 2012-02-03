<?php

class NoticiasController extends AppController {
	
	var $uses = array ( 'Tipos_conteudo' , 'Noticia' ) ;
	
	function index(){
		$ultimos_noticias = $this->Noticia->lastNews() ;
		$this->set('ultimos_noticias' , $ultimos_noticias);
	}
	
	function add($id = null){

		$Tipos_conteudos = $this->Tipos_conteudo->getTipos();
		$Tipos_conteudos = array ( '' => 'Selecione' ) + (array)$Tipos_conteudos;
		
		if (!empty($id)){
			$this->Noticia->id = $id;
			$this->set('id' , $id);
		}
		
		if (!empty($this->data)){
			$this->Noticia->set($this->data);
			if ($this->Noticia->validates()){
				if ($this->Noticia->addNoticia($this->data)){
					$this->Session->setFlash('Noticia editada com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Noticia!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Noticia->read();
		}
		
		$this->set('Tipos_conteudos' , $Tipos_conteudos);
				
	}
	
	function remove($id){
		
		$this->layout = '' ;
		
		if ($this->Noticia->deleteNoticia($id)){
			$this->Session->setFlash('Noticia exclu&iacute;da com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Noticia!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
}


?>