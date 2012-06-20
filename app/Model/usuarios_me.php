<?php

class Usuarios_me extends AppModel {
	
	var $useTable = 'usuarios_mes' ;
	
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