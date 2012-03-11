<?php

class ManuaisController extends AppController {
	
	var $uses = array ( 'Manuai') ;
	var $helpers = array ( 'Paginator' ) ;
	
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
				'Manuai.id',
				'Manuai.nome',
				'Manuai.arquivo'
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Manuai.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Manuai'] = $filtros ;
		$dados = $this->paginate('Manuai') ;
		$this->set('ultimos_manuais' , $dados);
	}
	
	function add($id = null){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		if (!empty($id)){
			$this->Manuai->id = $id;
			$url_arquivo = $this->Manuai->getUrlArquivo($id);
			$this->set('id' , $id);
			$this->set('url_arquivo' , $url_arquivo['Manuai']['arquivo']);
		}
		
		if (!empty($this->data)){
			$this->Manuai->set($this->data);
			if ($this->Manuai->validates()){
				$fileOK = $this->uploadFiles('files/manuais', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Manuai']['arquivo'] = $fileOK['urls'][0];
				    
				}
				if ($this->Manuai->addManual($this->data)){
					$this->Session->setFlash('Manual editado com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Manual!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Manuai->read();
		}
		
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		$url_arquivo = $this->Manuai->getUrlArquivo($id);
		if ($this->Manuai->deleteManual($id)){
			@unlink($url_arquivo['Manuai']['arquivo']);
			$this->Session->setFlash('Manual exclu&iacute;do com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Manual!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
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
	
}


?>