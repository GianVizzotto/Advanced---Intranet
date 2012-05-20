<?php
class AniversariantesController extends AppController {
	
	var $uses = array ( 'Aviso', 'Usuario', 'Departamento' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		
		$this->layout = 'advanced_layout';
		
		if($this->params['url']){
			$filtros_aviso = $this->params['url'];
			if (!empty ( $filtros_aviso['dpto_aviso'] )){
				$dpto_aviso = $filtros_aviso['dpto_aviso'];
				$this->set( 'dpto_aviso' , $dpto_aviso  ) ;
			}
			if (!empty ( $filtros_aviso['func_aviso'] )){
				$usuarios = $this->Usuario->getUsuarioDpto($filtros_aviso['dpto_aviso'],$filtros_aviso['func_aviso']) ;
				$this->set( 'func_aviso' , $filtros_aviso['func_aviso']  ) ;
			}
		} else {
			$usuarios = "";
		}
		
		$this->set('usuarios' , $usuarios);
		
		$select_departamento_aviso = $this->Departamento->find('list' , array(
																'fields' => array(
																	'id',
																	'nome'
																	)
																)
															) ;
		$select_departamento_aviso = array('' => 'Selecione') + (array)$select_departamento_aviso ;
		$this->set( 'select_departamento_aviso' , $select_departamento_aviso  ) ;
		
		$this->paginate = array(
							'fields' => array (
											'Usuario.id', 
											'Usuario.nome', 
											'Usuario.data_nascimento', 
											'Usuario.foto_url',
											'Cargos.nome',
											'Departamentos.id',
											'Departamentos.nome'
																						),
											'joins' => array(
													array(
														'table' => 'cargos',
														'alias' => 'Cargos',
														'type' => 'INNER',
														'conditions' => array ( 'Usuario.cargo_id = Cargos.id',
																				'MONTH(Usuario.data_nascimento) = MONTH(CURDATE())')	
														),
													array(
														'table' => 'departamentos',
														'alias' => 'Departamentos',
														'type' => 'INNER',
														'conditions' => array ( 'Usuario.departamento_id = Departamentos.id' )	
														)
													),
										'order' => array ( 'Usuario.data_nascimento' => 'DESC')
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

	function usuarios ( $departamento_id = null , $usuario_id = null ) {
		
		$this->layout = '' ;
		
		if($departamento_id != null){
		
			$usuarios = $this->Usuario->getUsuarioDpto($departamento_id , $usuario_id) ;
			
			$this->set('usuarios' , $usuarios);
			
		} else {
			
			$usuarios = array('' => 'Selecione');
			$this->set('usuarios' , $usuarios);
			
		}
		
	}
	
}