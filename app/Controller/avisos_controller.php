<?php

class AvisosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario' , 'Aviso' , 'StatusAviso', 'AvisoDestinatario') ;
	var $helpers = array('Time') ;
		
	function index ( ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('departamentos' , $departamentos) ;
		
		$status_avisos = $this->StatusAviso->getStatus() ; 
		$status_avisos = array ( '' => 'Selecione' ) +(array)$status_avisos;
		
		$this->set('status_avisos' , $status_avisos);
		
		if($this->data){
			
			$this->Aviso->set($this->data);
			
			if ( $this->Aviso->validates() ) {
				
				if($this->Aviso->salvaAviso($this->data['Aviso'])) {
					
					$this->Session->setFlash('Aviso cadastrado com sucesso.', 'confirm_message');
					unset($this->data);
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
	
	function filtraAvisos($tipo_filtro , $valor=null) {
		
		$this->layout = '' ;
		
		if ($valor != null){
			$avisos = $this->Aviso->filtraAvisos($tipo_filtro , $valor);
		} else {
			$avisos = $this->Aviso->filtraAvisos($tipo_filtro);
		}
		
		$this->set('avisos' , $avisos) ;
		
	}
	
	function aviso_detalhe(){
		
		$this->layout = '' ;
		
		$id = $this->params['url']['id'] ;
		
		$aviso = $this->Aviso->filtraAvisos(3,null,null,$id) ;
		$destinatarios = $this->AvisoDestinatario->getDestinatarios($id);
		
		$this->set('aviso', $aviso);
		$this->set('destinatarios', $destinatarios);
		
	}
	
}