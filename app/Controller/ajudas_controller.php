<?php

class AjudasController extends AppController {
	
	var $uses = array ( 'Ajuda' , 'Tipos_ajuda' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
			
		$Tipos_ajudas = $this->Tipos_ajuda->getTipos();
		$Tipos_ajudas = array ( '' => 'Selecione' ) + (array)$Tipos_ajudas;
		$this->set('Tipos_ajudas' , $Tipos_ajudas);

		$this->paginate = array(
			'fields' => array(
				'Ajuda.id',
				'Ajuda.nome',
				'Tipos_ajudas.nome'
				),
			'joins' => array(
				array(
					'table' => 'tipos_ajudas',
					'alias' => 'Tipos_ajudas',
					'type' => 'INNER',
					'conditions' => array ( 'Ajuda.tipos_ajudas_id = Tipos_ajudas.id' )	
					)
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Ajuda.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['tipos_ajuda_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Tipos_ajudas.id = ".$filtros['tipos_ajuda_id'] 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Ajuda'] = $filtros ;
		$dados = $this->paginate('Ajuda') ;
		$this->set('ultimos_ajudas' , $dados);
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
		
		$Tipos_ajudas = $this->Tipos_ajuda->getTipos();
		$Tipos_ajudas = array ( '' => 'Selecione' ) + (array)$Tipos_ajudas;
		
		if (!empty($id)){
			$this->Ajuda->id = $id;
			$url_imagem = $this->Ajuda->getUrlImagem($id);
			$this->set('id' , $id);
			$this->set('url_imagem' , $url_imagem['Ajuda']['imagem']);
		}
		
		if (!empty($this->data)){
			$this->Ajuda->set($this->data);
			if ($this->Ajuda->validates()){
				$fileOK = $this->uploadFiles('files/utilidades', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Ajuda']['imagem'] = $fileOK['urls'][0];
				    
				}
				if ($this->Ajuda->addAjuda($this->data)){
					$this->Session->setFlash('Ajuda editada com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Ajuda!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Ajuda->read();
		}
		
		$this->set('Tipos_ajudas' , $Tipos_ajudas);
				
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		$url_imagem = $this->Ajuda->getUrlImagem($id);
		if ($this->Ajuda->deleteAjuda($id)){
			@unlink($url_imagem['Ajuda']['imagem']);
			$this->Session->setFlash('Ajuda exclu&iacute;da com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Ajuda!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}

	function visualizar(){
		$Tipos_ajudas = $this->Tipos_ajuda->getTipos();
		$Tipos_ajudas = array ( '' => 'Selecione' ) + (array)$Tipos_ajudas;
		$this->set('Tipos_ajudas' , $Tipos_ajudas);

		$this->paginate = array(
						'fields' => array(
							'Ajuda.id',
							'Ajuda.nome',
							'Ajuda.conteudo',
							'Tipos_ajudas.nome'
							),
						'joins' => array(
							array(
								'table' => 'tipos_ajudas',
								'alias' => 'Tipos_ajudas',
								'type' => 'INNER',
								'conditions' => array ( 'Ajuda.tipos_ajudas_id = Tipos_ajudas.id' )	
								)
							)
						);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Ajuda.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['tipos_ajuda_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Tipos_ajudas.id = ".$filtros['tipos_ajuda_id'] 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 5;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Ajuda'] = $filtros ;
		$dados = $this->paginate('Ajuda') ;
		$this->set('ultimos_ajudas' , $dados);
		
	}
	
	function modalbox($id){
		$this->layout = '' ;
		$ajuda_unico = $this->Ajuda->getAjuda($id);
		$this->set('ajuda_unico' , $ajuda_unico);
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