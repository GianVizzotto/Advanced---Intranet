<?php

class AvisosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario' , 'Aviso' , 'StatusAviso') ;
	var $components = array ( 'Date' ) ;
	
	function index ( ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('departamentos' , $departamentos) ;
		
		$status_avisos = $this->StatusAviso->getStatus() ; 
		$status_avisos = array ( '' => 'Selecione' ) +(array)$status_avisos;
		
		$this->set('status_avisos' , $status_avisos);
		
		$avisos = $this->Aviso->ultimosAvisos();
		
		if($this->data){
			
			$this->Aviso->set($this->data);
			
			if ( $this->Aviso->validates() ) {
				
				if($this->Aviso->salvaAviso($this->data['Aviso'])) {
					
					$this->Session->setFlash('Aviso cadastrado com sucesso.', 'confirm_message');
					$this->redirect('/');
					
				} else {
					
					$this->Session->setFlash('Aviso não cadastrado.', 'error_message');
					
				}
				
			}
			
		}
		
		if ( !empty($this->data['Aviso']['departamento_id'] ) ) {
			
			$usuarios = $this->requestActionHTML('/avisos/usuarios/'.$this->data['Aviso']['departamento_id'].'/'.$this->data['Aviso']['usuario_id']) ;
			
		} else {
			
			$usuarios = $this->requestActionHTML('/avisos/usuarios/') ;
			
		}

		$this->set('usuarios' , $usuarios);
		$this->set('avisos' , $avisos);
		
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