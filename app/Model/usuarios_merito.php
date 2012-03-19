<?php

class Usuarios_merito extends AppModel {
	
	var $useTable = 'usuarios_meritos' ;
	
	function addUsuarios($dados) {

		return $this->save($dados) ;
		
	}
	
	function deleteMerito($dados){
		if ($this->delete($dados)){
			return true;
		}else{
			return false;
		}
	}
	
}