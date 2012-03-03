<?php
class RamaisController extends AppController {
	
	var $uses = array ( 'Aviso', 'Usuario', 'Departamento' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		
		$this->layout = 'advanced_layout';
		
		$select_departamento = $this->Departamento->find('list' , array(
														'fields' => array(
															'id',
															'nome'
															)
														)
													) ;
		$select_departamento = array('' => 'Selecione') + (array)$select_departamento ;
		$this->set( 'select_departamento' , $select_departamento  ) ;
		
		$this->paginate = array(
							'fields' => array (
											'Usuario.id', 
											'Usuario.nome', 
											'Usuario.ramal',
											'Usuario.email',
											'Departamentos.id',
											'Departamentos.nome'
																						),
											'joins' => array(
													array(
														'table' => 'departamentos',
														'alias' => 'Departamentos',
														'type' => 'INNER',
														'conditions' => array ( 'Usuario.departamento_id = Departamentos.id' )	
														)
													),
										'order' => array ( 'Usuario.data_nascimento' => 'DESC' )
							);
		$filtros = "";
		
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['departamento'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Usuario.departamento_id = ".$filtros['departamento']
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['func'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Usuario.id = ".$filtros['func']
				);
				
				$x++ ;
				
			}
			
		}
		
		if(isset($this->data['Departamentos']['id'])){
			$select_nomes = $this->requestActionHTML('/ramais/nomes/'.$this->data['Departamentos']['id'].'/'.$this->data['Usuario']['id']) ;
		} else {
			$select_nomes = $this->requestActionHTML('/ramais/nomes/') ;
		}
		$this->set('select_nomes' , $select_nomes);
		
		
		$this->paginate['limit'] = 5;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Usuario'] = $filtros ;
		$dados = $this->paginate('Usuario') ;
		$this->set('ultimos_usuarios' , $dados);
	}

	function nomes($departamento = 0, $usuario_id = null){
		
		$this->layout = '' ;
			
		$select_nomes = $this->Usuario->find('list' , array(
														'fields' => array(
															'id',
															'nome'
															),
														'conditions' => array('departamento_id = '.$departamento)	
														)
													) ;
		$select_nomes = array('' => 'Selecione') + (array)$select_nomes ;
		$this->set( 'select_nomes' , $select_nomes ) ;
		$this->set( 'usuario_id' , $usuario_id ) ;
		
	}
	
}