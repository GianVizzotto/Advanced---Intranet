<?php

//App::import('Sanitize');

class UsuariosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' ) ;
	var $components = array ( 'Date' ) ;
	
	function cadastro( $id = null ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$perfis = $this->Perfil->getPerfis();
		$perfis = array ( '' => 'Selecione' ) + (array)$perfis;
		
		$ultimos_cadastrados = $this->Usuario->lastUsers() ;
		
		if( !empty($id) ) {
			
//			$this->Usuario->id = Sanitize::clean($id);	
			$this->Usuario->id = $id;
			
			$this->request->data = $this->Usuario->read();
			$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
			
			$this->set('id' , $id);
			
		} else {
			
			if ( !empty($this->data['Usuario']) ) {
				
				//Atentar-se que não é mais possivel gravar no $this->data, necessário usar $this->request->data para sobrescrita de valor
				$this->request->data['Usuario']['data_nascimento'] = $this->Date->ReadToDB($this->data['Usuario']['data_nascimento']);
	
				$this->Usuario->set($this->data['Usuario']);
				
				if ( $this->Usuario->validates() ) {
					
					if ( $this->Usuario->addusuario($this->data['Usuario']) ) {
						
						//$this->redirect('/usuarios/cadastro');
						
					} else {
						
						echo "Problemas ao Salvar!" ;
						
					}
					
				} else {
					
					$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
					
				}
				
			}
			
		}	
		
		$this->set('departamentos' , $departamentos);
		$this->set('perfis' , $perfis);
		$this->set('ultimos_cadastrados' , $ultimos_cadastrados);
		
	}
	
}