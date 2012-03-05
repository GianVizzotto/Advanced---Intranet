<?php
class DashboardController extends AppController {
	
	var $uses = array ( 'Noticia', 'Aviso', 'Usuario', 'Departamento' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		
		$this->layout = 'advanced_layout';
		
//		Noticias
		
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
		
//		Aniversarios
		$usuarios_esquerda = $this->Usuario->find('all', array(
													'fields' => array (
																'Usuario.id', 
																'Usuario.nome', 
																'Usuario.data_nascimento', 
																'Usuario.foto_url',
																'Departamentos.nome'
																),
																'joins' => array(
																		array(
																			'table' => 'departamentos',
																			'alias' => 'Departamentos',
																			'type' => 'INNER',
																			'conditions' => array ( 'Usuario.departamento_id = Departamentos.id',
																									'MONTH(Usuario.data_nascimento) = MONTH(CURDATE())' )	
																			)
																		),
															'order' => array ( 'Usuario.data_nascimento' => 'DESC' ),
															'limit' => 3
													)
												);
														
		$this->set('usuarios_esquerda' , $usuarios_esquerda);

//		Avisos

		$usuario_dados = $this->Session->read('Usuario');
		
		$avisos = $this->Aviso->getAvisos($usuario_dados, 5);
		
		$this->set('avisos', $avisos);
		
	}
	
}