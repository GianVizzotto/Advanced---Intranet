<?php

class AvisosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario' , 'Aviso' , 'StatusAviso', 'AvisoDestinatario', 'AvisoResposta') ;
	var $helpers = array('Time') ;
		
	function index ( ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('departamentos' , $departamentos) ;
		
		$status_avisos = $this->StatusAviso->getStatus() ; 
		$status_avisos = array ( '' => 'Selecione' ) +(array)$status_avisos;
		
		$this->set('status_avisos' , $status_avisos);
		
		$usuario_dados = $this->Session->read('Usuario');
		
		if($this->data){
			
			$this->request->data['Aviso']['usuario_id'] = $usuario_dados['Usuario']['id'];
			
			$this->Aviso->set($this->data);
			
			if ( $this->Aviso->validates() ) {
				
				if($this->Aviso->salvaAviso($this->data['Aviso'])) {
					
					if(!empty($this->data['AvisoDestinatario']['usuario_id'])){
							
						$this->request->data['AvisoDestinatario']['aviso_id'] = $this->Aviso->getLastInsertID();
						$this->AvisoDestinatario->save($this->data['AvisoDestinatario']);
						
					}
					
					$this->Session->setFlash('Aviso cadastrado com sucesso.', 'flash_confirm');
					unset($this->data);
					$this->redirect('/avisos');
					
				} else {
					
					$this->Session->setFlash('Aviso não cadastrado.', 'flash_error');
					
				}
				
			}
			
		}
		
		if ( !empty($this->data['Aviso']['departamento_id'] ) ) {
			
			$usuarios = $this->requestActionHTML('/avisos/usuarios/'.$this->data['Aviso']['departamento_id'].'/'.$this->data['Aviso']['usuario_id']) ;
			
		} else {
			
			$usuarios = $this->requestActionHTML('/avisos/usuarios/') ;
			
		}

		$this->set('usuarios', $usuarios);
		$this->set('usuario_dados', $usuario_dados);		
		
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
	
	function filtraAvisos($tipo_filtro, $valor=null, $usuario_id, $departamento_id) {
		
		$this->layout = '' ;
		
		if ($valor != null){
			$avisos = $this->Aviso->filtraAvisos($tipo_filtro, $valor, $usuario_id, $departamento_id);
		} else {
			$avisos = $this->Aviso->filtraAvisos($tipo_filtro, null, $usuario_id, $departamento_id);
		}
		
		$this->set('avisos' , $avisos) ;
		
	}
	
	function aviso_detalhe(){
		
		$this->layout = '' ;
		
		$id = $this->params['url']['id'] ;
		
		$aviso = $this->Aviso->filtraAvisos(3,null,null,null,$id) ;
		$destinatarios = $this->AvisoDestinatario->getDestinatarios($id);
		
		if(empty($destinatarios)){
			$destinatarios[0]['Usuario']['nome'] = $aviso[0]['Departamento']['nome']; 
		}
		
		$this->set('aviso', $aviso);
		$this->set('destinatarios', $destinatarios);
		
	}
	
	function salvaResposta($id, $tipo, $msg=false){
		
		$this->autoRender = false;
		
		$ultimo = false;
		
		if($tipo == 1){
			
			$usuario = $this->Session->read('Usuario');
			
			$dados = array(
				'aviso_id' => $id,
				'resposta' => $msg,
				'usuario_id' => $usuario['Usuario']['id']
				);
	
			$this->AvisoResposta->salvaResposta($dados);
			$ultimo = $this->AvisoResposta->getLastInsertId();
			$comentario = $this->AvisoResposta->recuperaComentarios($id, $ultimo);
			
		} else {
			
			$comentario = $this->AvisoResposta->recuperaComentarios($id, $ultimo);
			
		}
		
		echo json_encode($comentario);
	
	}
	
}