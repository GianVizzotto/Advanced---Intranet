<?php 
class StatusAviso extends AppModel {
	
	var $useTable = 'status_avisos' ;
	
	function getStatus(){
		
		$status = $this->find('list' , array(
			'fields' => array(
				'id',
				'nome'
				)
			)
		);
		
		return $status ;
		
	}
	
}