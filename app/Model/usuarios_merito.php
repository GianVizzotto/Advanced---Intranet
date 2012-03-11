<?php

class Usuarios_merito extends AppModel {
	
	var $useTable = 'usuarios_meritos' ;
	
	function addUsuarios($dados) {

		return $this->save($dados) ;
		
	}
	
}