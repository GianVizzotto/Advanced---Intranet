<?php

class EventosController extends AppController {
	
	var $uses = array ( 'Tipos_conteudo' , 'Evento' ) ;
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
				'Evento.id',
				'Evento.nome',
				'Evento.data_criacao',
				'Tipos_conteudos.nome'
				),
			'joins' => array(
				array(
					'table' => 'tipos_conteudos',
					'alias' => 'Tipos_conteudos',
					'type' => 'INNER',
					'conditions' => array ( 'Evento.tipos_conteudo_id = Tipos_conteudos.id' )	
					)
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Evento.nome) like lower('%".$filtros['nome']."%')" 
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
		$this->request->data['Evento'] = $filtros ;
		$dados = $this->paginate('Evento') ;
		$this->set('ultimos_eventos' , $dados);
	}
	
	function add($id = null){
		
		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);

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