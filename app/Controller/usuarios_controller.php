<?php

//App::import('Sanitize');

class UsuariosController extends AppController {
	
	var $uses = array ( 'Departamento' , 'Perfil' , 'Usuario' , 'StatusUsuario', 'Noticia', 'Cargo' ) ;
	var $components = array ( 'Date' ) ;
	var $helpers = array ( 'Paginator' ) ;
	
	public $paginate = array(
        	'limit' => 25
			);
			
	function index(){
		
		$this->layout = '';
		
		$this->redirect(array('action' => 'listar'));
		
	}		
	
	function cadastro( $id = null ) {
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$perfis = $this->Perfil->getPerfis();
		$perfis = array ( '' => 'Selecione' ) + (array)$perfis;
				
		$ultimos_cadastrados = $this->Usuario->lastUsers() ;
		
		if( !empty($id) ) {
			
//			$this->Usuario->id = Sanitize::clean($id);	
			$this->Usuario->id = $id;
			$this->set('id' , $id);
			$url_foto = $this->Usuario->getUrlImagem($id);
			$this->set('url_foto' , $url_foto['Usuario']['foto_url']);
			
		} 
		
		if ( !empty($this->data) ) {

			//Atentar-se que não é mais possivel gravar no $this->data, necessário usar $this->request->data para sobrescrita de valor
			$this->request->data['Usuario']['data_nascimento'] = $this->Date->ReadToDB($this->data['Usuario']['data_nascimento']);

			$this->Usuario->set($this->data);
			
			if ( $this->Usuario->validates() ) {
					
				$fileOK = $this->uploadFiles('files/usuarios', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Usuario']['foto_url'] = $fileOK['urls'][0];
				    
				}
				
				if ( $this->Usuario->addusuario($this->data) ) {
					
					$this->Session->setFlash('Usuário cadastrado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'listar'));
					
				} else {
					
					$this->Session->setFlash('Erro ao cadastrar usuário!', 'flash_error');
					$this->redirect(array('action' => 'listar'));
					
				}
				
			} else {
				
				$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
				
			}
			
		} else {
			
			$this->request->data = $this->Usuario->read();
			$this->request->data['Usuario']['data_nascimento'] = $this->Date->DBToRead($this->data['Usuario']['data_nascimento']);
			
			if(isset($this->data['Usuario']['cargo_id'])){
				$this->set('cargo_id', $this->data['Usuario']['cargo_id']);
			}
			
		}
		
		$this->set('departamentos' , $departamentos);
		$this->set('perfis' , $perfis);
		$this->set('ultimos_cadastrados' , $ultimos_cadastrados);
				
	}
	
	function listar() {

		$status = $this->StatusUsuario->getStatus() ;
		$status = array('' => 'Selecione') + (array)$status;
		
		$departamentos = $this->Departamento->getDepartamentos();
		$departamentos = array ( '' => 'Selecione' ) + (array)$departamentos;
		
		$this->set('status' , $status) ;
		$this->set('departamentos' , $departamentos) ;
		
		$this->paginate = array(
			'fields' => array(
				'Usuario.id',
				'Usuario.nome',
				'Usuario.email',
				'Departamento.nome',
				'Status.nome'
				),
			'joins' => array(
				array(
					'table' => 'departamentos',
					'alias' => 'Departamento',
					'type' => 'INNER',
					'conditions' => array ( 'Usuario.departamento_id = Departamento.id' )	
				),
				array(
					'table' => 'status_usuarios',
					'alias' => 'Status',
					'type' => 'INNER',
					'conditions' => array ( 'Usuario.status_usuario_id = Status.id' )
					)
				)
		);
		
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Usuario.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['email'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Usuario.email) like lower('".$filtros['email']."')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['departamento_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					'Departamento.id = '. $filtros['departamento_id']
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['status_usuario_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					'Status.id = '. $filtros['status_usuario_id']
				);
				
			}
			
		}
		
		$this->paginate['limit'] = 20;
		$this->paginate['paramType'] = 'querystring';
		
		$this->request->data['Usuarios'] = $filtros ;
		
		$dados = $this->paginate('Usuario') ;
		$this->set('usuarios' , $dados) ;
		
	}
	
	function alterafoto($id) {
	
		$this->Usuario->id = $id ;
		
		$fileOK = $this->uploadFiles('files/usuarios', $this->data['File']);
		// if file was uploaded ok
		if($fileOK['urls'][0] != "") {
		    // save the url in the form data
		    $dados['Usuario']['foto_url'] = $fileOK['urls'][0];
		    
		}
		$result = $this->Usuario->invalidaLogin($dados) ;
		
		if($result){
			
			$this->Session->setFlash('Foto alterada com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'perfil'));
			
		} else {
			
			$this->Session->setFlash('Erro ao alterar foto!', 'flash_error');
			$this->redirect(array('action' => 'perfil'));
			
		}		
		
	}
	
	function alterasenha($id) {
	
		$this->Usuario->id = $id ;
		
	    $dados['Usuario']['senha'] = $this->data['password'];

		$result = $this->Usuario->invalidaLogin($dados) ;
		
		if($result){
			
			$this->Session->setFlash('Senha alterada com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'perfil'));
			
		} else {
			
			$this->Session->setFlash('Erro ao alterar senha!', 'flash_error');
			$this->redirect(array('action' => 'perfil'));
			
		}		
		
	}
	
	function perfil(){
		
		$this->layout = 'advanced_layout';
		
		$noticias_direita = $this->Noticia->find('all', array(
													'fields' => array (
																'id', 
																'nome', 
																'data_criacao', 
																'conteudo'
																),
															'order' => array ( 'id' => 'DESC' ),
															'limit' => 3
													)
												);
		$this->set('noticias_direita' , $noticias_direita);
		
		$usuario_sessao = $this->Session->read('Usuario');
		
		$usuario_perfil = $this->Usuario->find('first', array(
													'fields' => array(
																'Usuario.id',
																'Usuario.nome',
																'Usuario.email',
																'Usuario.data_nascimento',
																'Usuario.ramal',
																'Usuario.telefone',
																'Usuario.celular',
																'Usuario.foto_url',
																'Departamento.nome',
																'Cargo.nome'
																),
													'joins' => array(
																array(
																	'table' => 'departamentos',
																	'alias' => 'Departamento',
																	'type' => 'INNER',
																	'conditions' => array ( 'Usuario.departamento_id = Departamento.id',
																							'Usuario.id' =>  $usuario_sessao['Usuario']['id'])	
																),
																array(
																	'table' => 'cargos',
																	'alias' => 'Cargo',
																	'type' => 'INNER',
																	'conditions' => array ( 'Usuario.cargo_id = Cargo.id' )	
																)
													)
												)
											);
		$this->set('usuario_perfil' , $usuario_perfil);									
		
	}

	/**
	 * uploads files to the server
	 * @params:
	 *		$folder 	= the folder to upload the files e.g. 'img/files'
	 *		$formdata 	= the array containing the form files
	 *		$itemId 	= id of the item (optional) will create a new sub folder
	 * @return:
	 *		will return an array with the success of each file upload
	 */
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
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}
			
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
	
	function cargos($departamento_id, $cargo_id = null){
		
		$this->layout = '';
		
		if($cargo_id){
			$cargos = $this->Cargo->getCargos($departamento_id, $cargo_id);
		} else {
			$cargos = $this->Cargo->getCargos($departamento_id);
		}		
		
		$this->set('cargos' , $cargos);
		
	}
	
}