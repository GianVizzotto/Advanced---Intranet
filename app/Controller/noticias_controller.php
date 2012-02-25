<?php

class NoticiasController extends AppController {
	
	var $uses = array ( 'Tipos_conteudo' , 'Noticia' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		$Tipos_conteudos = $this->Tipos_conteudo->getTipos();
		$Tipos_conteudos = array ( '' => 'Selecione' ) + (array)$Tipos_conteudos;
		$this->set('Tipos_conteudos' , $Tipos_conteudos);

		$this->paginate = array(
			'fields' => array(
				'Noticia.id',
				'Noticia.nome',
				'Tipos_conteudos.nome'
				),
			'joins' => array(
				array(
					'table' => 'tipos_conteudos',
					'alias' => 'Tipos_conteudos',
					'type' => 'INNER',
					'conditions' => array ( 'Noticia.tipos_conteudos_id = Tipos_conteudos.id' )	
					)
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Noticia.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['tipos_conteudo_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Tipos_conteudos.id = ".$filtros['tipos_conteudo_id'] 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 1;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Noticia'] = $filtros ;
		$dados = $this->paginate('Noticia') ;
		$this->set('ultimos_noticias' , $dados);
	}
	
	function add($id = null){
		
		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);

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