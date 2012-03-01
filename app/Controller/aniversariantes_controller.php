<?php
class AniversariantesController extends AppController {
	
	var $uses = array ( 'Aviso', 'Usuario' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		
		$this->layout = 'advanced_layout';
		
		$this->paginate = array(
							'fields' => array (
											'Usuario.id', 
											'Usuario.nome', 
											'Usuario.data_nascimento', 
											'Usuario.foto_url',
											'Cargos.nome',
											'Departamentos.nome'
											),
											'joins' => array(
													array(
														'table' => 'cargos',
														'alias' => 'Cargos',
														'type' => 'INNER',
														'conditions' => array ( 'Usuario.cargo_id = Cargos.id')	
														),
													array(
														'table' => 'departamentos',
														'alias' => 'Departamentos',
														'type' => 'INNER',
														'conditions' => array ( 'Usuario.departamento_id = Departamentos.id',
																				'MONTH(Usuario.data_nascimento) = MONTH(CURDATE())' )	
														)
													),
										'order' => array ( 'Usuario.data_nascimento' => 'DESC' )
							);
		$filtros = "";
		$this->paginate['limit'] = 5;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Usuario'] = $filtros ;
		$dados = $this->paginate('Usuario') ;
		$this->set('ultimos_usuarios' , $dados);
	}
	
}