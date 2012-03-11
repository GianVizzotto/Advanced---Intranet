<?php

class AvisosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario' , 'Aviso' , 'StatusAviso', 'AvisoDestinatario', 'AvisoResposta') ;
	var $helpers = array('Time', 'Paginator') ;
	
	public $paginate = array(
        		'limit' => 8
			);
		
	function index ( ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione', '0' =>'Todos') + (array)$departamentos;
		
		$this->set('departamentos' , $departamentos) ;
		
		$status_avisos = $this->StatusAviso->getStatus() ; 
		$status_avisos = array ( '' => 'Selecione' ) +(array)$status_avisos;
		
		$this->set('status_avisos' , $status_avisos);
		
		$usuario_dados = $this->Session->read('Usuario');
		
		
		//Salva novo aviso
		if(isset($this->data['Aviso'])){
			
			$this->request->data['Aviso']['usuario_id'] = $usuario_dados['Usuario']['id'];
			
			$this->Aviso->set($this->data);
			$this->AvisoDestinatario->set($this->data['AvisoDestinatario']);
			
			if ( $this->Aviso->validates() &&  $this->AvisoDestinatario->validates()) {
				
				$fileOK = $this->uploadFiles('files/avisos', $this->data['File']);
				
					// if file was uploaded ok
					if($fileOK['urls'][0] != "") {
					    // save the url in the form data
					    $this->request->data['Aviso']['anexo'] = $fileOK['urls'][0];
					    echo $this->data['Aviso']['anexo'];
				  	}
				
				
				if($this->Aviso->salvaAviso($this->data['Aviso'])) {
					
					if(!empty($this->data['AvisoDestinatario'])){
							
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
		
		//Listagem de avisos
		
		if($this->params['url']['status_aviso_id']){
		
//		Filtro todos (exibe todos os avisos enviado e recebidos)
		$conditions = array(
			'(AvisoDestinatario.departamento_id ='.$usuario_dados['Usuario']['departamento_id'].
			' and AvisoDestinatario.usuario_id is null) or (AvisoDestinatario.usuario_id ='.$usuario_dados['Usuario']['id'].')
			 or (Aviso.usuario_id ='.$usuario_dados['Usuario']['id'].') 
			 or (AvisoDestinatario.departamento_id = 0 
			 and AvisoDestinatario.usuario_id = 0)' 
		);
//		Exibe os avisos enviados
		if($this->params['url']['status_aviso_id'] && $this->params['url']['status_aviso_id'] == 2) {
			
			$conditions = array(
				'Aviso.usuario_id ='. $usuario_dados['Usuario']['id']
			);
//	Exibindo avisos recebidos no dia vigente para o usuário logado		
		} elseif($this->params['url']['status_aviso_id'] != 3) {
		
			$conditions = array(
			'(AvisoDestinatario.departamento_id ='.$usuario_dados['Usuario']['departamento_id'].' 
			and AvisoDestinatario.usuario_id is null 
			and Aviso.usuario_id !='.$usuario_dados['Usuario']['id'].') 
			or (AvisoDestinatario.usuario_id ='.$usuario_dados['Usuario']['id'].'
			and Aviso.usuario_id !='.$usuario_dados['Usuario']['id'].')
		 	or (AvisoDestinatario.departamento_id = 0 and AvisoDestinatario.usuario_id = 0
		 	and Aviso.usuario_id !='.$usuario_dados['Usuario']['id'].')' );
			
		}
		}

		$this->paginate = array(  
				'fields' => array(
					'Aviso.id',
					'Aviso.usuario_id',
					'Aviso.assunto',
					'Aviso.data_criacao',
					'Usuario.nome',
					'Destinatario.nome',
					'Departamento.nome',
					'AvisoDestinatario.usuario_id',
					),
				'joins' => array(
					array(
						'table' => 'usuarios',
						'alias' => 'Usuario',
						'type' => 'LEFT',
						'conditions' => array ( 'Aviso.usuario_id = Usuario.id' )
						),
					array(
						'table' => 'avisos_destinatarios',
						'alias' => 'AvisoDestinatario',
						'type' => 'LEFT',
						'conditions' => array ( 'Aviso.id = AvisoDestinatario.aviso_id' )
						),
					array(
						'table' => 'departamentos',
						'alias' => 'Departamento',
						'type' => 'LEFT',
						'conditions' => array ( 'AvisoDestinatario.departamento_id = Departamento.id' )
						),
					array(
						'table' => 'usuarios',
						'alias' => 'Destinatario',
						'type' => 'LEFT',
						'conditions' => array ( 'AvisoDestinatario.usuario_id = Destinatario.id' )
						),			
					),
					'conditions' => $conditions,
					'order' => array('Aviso.data_criacao' => 'DESC')
				);							

		$this->paginate['paramType'] = 'querystring';
		$this->paginate['limit'] = 8;
		
		$dados = $this->paginate('Aviso') ;
		
		$this->set('avisos', $dados);	
		$this->set('usuarios', $usuarios);
		$this->set('usuario_dados', $usuario_dados);		
		
	}
	
	function usuarios ( $departamento_id = null , $usuario_id = null ) {
		
		$usuario_dados = $this->Session->read('Usuario');
		
		$this->layout = '' ;
		
		if($departamento_id != null && $usuario_id != null){
		
			$usuarios = $this->Usuario->getUsuarioDpto($departamento_id , $usuario_id, null) ;
			
		} else {
			
			$usuarios = $this->Usuario->getUsuarioDpto($departamento_id , $usuario_dados['Usuario']['id'], 1) ;
			
		}
		
		$usuarios = array('' => 'Selecione') + $usuarios;
		
		$this->set('usuarios' , $usuarios);
		
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
		
		$usuario_dados = $this->Session->read('Usuario');
		
		$id = $this->params['url']['id'] ;
		
		$aviso = $this->Aviso->filtraAvisos($id) ;
//		echo "<pre>"; print_r( $aviso); echo "</pre>";
		if($aviso[0]['Aviso']['status_aviso_id'] == 2){
			$this->Aviso->atualizaStatus($id, 6);
		}
		
		
		$destinatarios = $this->AvisoDestinatario->getDestinatarios($id);
		
		if(empty($destinatarios)){
			$destinatarios[0]['Usuario']['nome'] = $aviso[0]['Departamento']['nome']; 
		}
		
		$this->set('aviso', $aviso);
		$this->set('destinatarios', $destinatarios);
		$this->set('usuario_id', $usuario_dados['Usuario']['id']);
		
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
			$comentarios = $this->AvisoResposta->recuperaComentarios($id, $ultimo);
			
		} else {
			
			$comentarios = $this->AvisoResposta->recuperaComentarios($id, $ultimo);
			
		}
		
		echo json_encode($comentarios);
	
	}
	
	function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}
			
		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}
		
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
		// loop through and deal with the files
		foreach($formdata as $file) {
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = true;
			// check filetype is ok
			
			
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
							chmod($url, 0777);
						} else {
							$result['errors'][] = "Error uploaded $filename. Please try again.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error uploading $filename. Please try again.";
						break;
					default:
						// an error occured
						$result['errors'][] = "System error uploading $filename. Contact webmaster.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No file Selected";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
			}
		}
		return $result;
	}
	
	function salvaAviso(){
		
		$this->request->data['AvisoDestinatario']['usuario_id'] = $this->data['Aviso']['usuario_id'];
		$usuario_dados = $this->Session->read('Usuario');
		$this->request->data['AvisoDestinatario']['departamento_id'] = $usuario_dados['Usuario']['departamento_id'];
			
		$this->request->data['Aviso']['usuario_id'] = $usuario_dados['Usuario']['id'];
		
		$this->Aviso->set($this->data);
		
		if ( $this->Aviso->validates() ) {

			if($this->Aviso->salvaAviso($this->data['Aviso'])) {
				
				if(!empty($this->data['AvisoDestinatario'])){
						
					$this->request->data['AvisoDestinatario']['aviso_id'] = $this->Aviso->getLastInsertID();
					$this->AvisoDestinatario->save($this->data['AvisoDestinatario']);
					
				}
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}
		
	}
		
}