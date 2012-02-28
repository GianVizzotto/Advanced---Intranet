<?php
class AppController extends Controller {
	
	function beforeFilter(){
		
		$this->layout = 'advanced_layout' ;
		
		if(!$this->Session->read('Usuario') && $this->params['controller'] != 'login'){
			$this->redirect('/login');
		}
		
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