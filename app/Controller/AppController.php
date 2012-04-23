<?php
class AppController extends Controller {
	
	public $uses = array('Departamento');
	
	function beforeFilter(){
		$this->layout = 'advanced_layout' ;
		
		if($this->params['controller'] == 'avisos' && !$this->Session->read('Usuario')){
			$this->redirect('/login');
		}
		$menu = $this->Departamento->find('all', array(
									'fields' => array(
											'id',
											'nome'
											),
									'order' => array ( 'nome' => 'DESC')
									)
								);
		$this->set('menudinamico',$menu);
		
	}
	
	function requestActionHTML ( $url ) {
    	
    	$get = $_GET;
    	$request = $_REQUEST;

    	# Parseia URL para separ GET
    	$urlParsed =  parse_url ( $url ) ;
    	if(isset($urlParsed['query'])){
    		parse_str ( $urlParsed['query'] , $_GET ) ;
    	}
    	$_REQUEST = $_GET;
    
    	# Executa action e captura retorno
    	@ob_start ( );
    	new Dispatcher ( $url );
    	$content = @ob_get_clean ( );
    	
    	# Reseta a GET
    	$_GET = $get;
    	$_REQUEST = $request;
    	
    	return $content;
    	
    }
	
}