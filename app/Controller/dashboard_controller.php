<?php
class DashboardController extends AppController {
	
	var $uses = array ( 'Tipos_conteudo', 'Noticia', 'Aviso' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		
		$this->layout = 'advanced_layout';
		
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
		
	}
	
}