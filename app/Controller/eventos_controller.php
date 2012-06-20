<?php

class EventosController extends AppController {
	
	var $uses = array ( 'Evento' , 'Noticia' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->paginate = array(
			'fields' => array(
				'Evento.id',
				'Evento.nome',
				'Evento.status',
				'Evento.data_criacao'
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Evento.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['status'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Evento.status) like lower('%".$filtros['status']."%')" 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Evento'] = $filtros ;
		$dados = $this->paginate('Evento') ;
		$this->set('ultimos_eventos' , $dados);
	}
	
	function add($id = null){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);
		
		$ckfinderPath = 'js/ckfinder/';
   		$this->set('ckfinderPath', $ckfinderPath);

		if (!empty($id)){
			$this->Evento->id = $id;
			$url_imagem = $this->Evento->getUrlImagem($id);
			$this->set('id' , $id);
			$this->set('url_imagem' , $url_imagem['Evento']['imagem']);
		}
		
		if (!empty($this->data)){
			$this->Evento->set($this->data);
			if ($this->Evento->validates()){
				$fileOK = $this->uploadFiles('files/eventos', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Evento']['imagem'] = $fileOK['urls'][0];
				    
				}
				if ($this->Evento->addEvento($this->data)){
					$this->Session->setFlash('Evento editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Evento!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Evento->read();
		}
		
	}

	function suggest($id = null){
				
		$ckeditorClass = 'CKEDITOR';
		$this->set('ckeditorClass', $ckeditorClass);
		
		$ckfinderPath = 'js/ckfinder/';
   		$this->set('ckfinderPath', $ckfinderPath);

		if (!empty($id)){
			$this->Evento->id = $id;
			$url_imagem = $this->Evento->getUrlImagem($id);
			$this->set('id' , $id);
			$this->set('url_imagem' , $url_imagem['Evento']['imagem']);
		}
		
		if (!empty($this->data)){
			$this->Evento->set($this->data);
			if ($this->Evento->validates()){
				$fileOK = $this->uploadFiles('files/eventos', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Evento']['imagem'] = $fileOK['urls'][0];
				    
				}
				$this->request->data['Evento']['status'] = 2;
				if ($this->Evento->addEvento($this->data)){
					$this->Session->setFlash('Evento indicado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'visualizar'));
				}else{
					$this->Session->setFlash('Erro ao indicar Evento!', 'flash_error');
					$this->redirect(array('action' => 'visualizar'));
				}
			}
		}else{
			$this->request->data = $this->Evento->read();
		}
		
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		$url_imagem = $this->Evento->getUrlImagem($id);
		if ($this->Evento->deleteEvento($id)){
			@unlink($url_imagem['Evento']['imagem']);
			$this->Session->setFlash('Evento exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Evento!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function visualizar(){

		$this->paginate = array(
			'fields' => array(
				'Evento.id',
				'Evento.nome',
				'Evento.data_criacao',
				'Evento.conteudo'
				),
			'order' => array ( 'id' => 'DESC' ),
			'conditions' => array ( "Evento.status = 1" )
			);
		$filtros = "";
		$this->paginate['limit'] = 5;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Evento'] = $filtros ;
		$dados = $this->paginate('Evento') ;
		$this->set('ultimos_eventos' , $dados);
		
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
	}

	function modalbox($id){
		$this->layout = '' ;
		$evento_unico = $this->Evento->getEvento($id);
		$this->set('evento_unico' , $evento_unico);
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
	
}


?>