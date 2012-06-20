<?php

class UtilidadesController extends AppController {
	
	var $uses = array ( 'Utilidade' , 'Tipos_utilidade', 'Evento' ) ;
	var $helpers = array ( 'Paginator', 'Time' ) ;
	
	public $paginate = array(
        	'limit' => 1
			);
	
	function index(){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
			
		$Tipos_utilidades = $this->Tipos_utilidade->getTipos();
		$Tipos_utilidades = array ( '' => 'Selecione' ) + (array)$Tipos_utilidades;
		$this->set('Tipos_utilidades' , $Tipos_utilidades);

		$this->paginate = array(
			'fields' => array(
				'Utilidade.id',
				'Utilidade.nome',
				'Tipos_utilidades.nome'
				),
			'joins' => array(
				array(
					'table' => 'tipos_utilidades',
					'alias' => 'Tipos_utilidades',
					'type' => 'INNER',
					'conditions' => array ( 'Utilidade.tipos_utilidades_id = Tipos_utilidades.id' )	
					)
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Utilidade.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['tipos_utilidade_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Tipos_utilidades.id = ".$filtros['tipos_utilidade_id'] 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 10;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Utilidade'] = $filtros ;
		$dados = $this->paginate('Utilidade') ;
		$this->set('ultimos_utilidades' , $dados);
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
		
		$Tipos_utilidades = $this->Tipos_utilidade->getTipos();
		$Tipos_utilidades = array ( '' => 'Selecione' ) + (array)$Tipos_utilidades;
		
		if (!empty($id)){
			$this->Utilidade->id = $id;
			$url_imagem = $this->Utilidade->getUrlImagem($id);
			$this->set('id' , $id);
			$this->set('url_imagem' , $url_imagem['Utilidade']['imagem']);
		}
		
		if (!empty($this->data)){
			$this->Utilidade->set($this->data);
			if ($this->Utilidade->validates()){
				$fileOK = $this->uploadFiles('files/utilidades', $this->data['File']);
				// if file was uploaded ok
				if($fileOK['urls'][0] != "") {
				    // save the url in the form data
				    $this->request->data['Utilidade']['imagem'] = $fileOK['urls'][0];
				    
				}
				if ($this->Utilidade->addUtilidade($this->data)){
					$this->Session->setFlash('Utilidade editada com sucesso!', 'flash_confirm');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Erro ao editar Utilidade!', 'flash_error');
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Utilidade->read();
		}
		
		$this->set('Tipos_utilidades' , $Tipos_utilidades);
				
	}
	
	function remove($id){
		$validao_perfil = $this->Session->read('Usuario');
		
		if ($validao_perfil['Usuario']['perfil_id'] != 1):
			$this->redirect('/dashboard');
		endif;
				
		$this->layout = '' ;
		$url_imagem = $this->Utilidade->getUrlImagem($id);
		if ($this->Utilidade->deleteUtilidade($id)){
			@unlink($url_imagem['Utilidade']['imagem']);
			$this->Session->setFlash('Utilidade exclu&iacute;da com sucesso!', 'flash_confirm');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Erro ao excluir Utilidade!', 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
	}

	function visualizar(){
		$Tipos_utilidades = $this->Tipos_utilidade->getTipos();
		$Tipos_utilidades = array ( '' => 'Selecione' ) + (array)$Tipos_utilidades;
		$this->set('Tipos_utilidades' , $Tipos_utilidades);

		$this->paginate = array(
			'fields' => array(
				'Utilidade.id',
				'Utilidade.nome',
				'Utilidade.conteudo',
				'Tipos_utilidades.nome'
				),
			'order' => array ( 'Utilidade.id' => 'DESC' ),
			'joins' => array(
				array(
					'table' => 'tipos_utilidades',
					'alias' => 'Tipos_utilidades',
					'type' => 'INNER',
					'conditions' => array ( 'Utilidade.tipos_utilidades_id = Tipos_utilidades.id' )	
					)
				)
			);
		$filtros = "";
		if( $this->params['url'] ) {
			
			$filtros = $this->params['url'];
			$x = 0 ;
			
			if ( !empty ( $filtros['nome'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"lower(Utilidade.nome) like lower('%".$filtros['nome']."%')" 
				);
				
				$x++ ;
				
			}
			if ( !empty ( $filtros['tipos_utilidade_id'] ) ) {
				
				$this->paginate['conditions'][$x] = array(
					"Tipos_utilidades.id = ".$filtros['tipos_utilidade_id'] 
				);
				
				$x++ ;
				
			}
			
		}
		$this->paginate['limit'] = 5;
		$this->paginate['paramType'] = 'querystring';
		// print_r($this->paginate);
		// die;
		$this->request->data['Utilidade'] = $filtros ;
		$dados = $this->paginate('Utilidade') ;
		$this->set('ultimos_utilidades' , $dados);
		
		$eventos_direita = $this->Evento->find('all', array(
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
		$this->set('eventos_direita' , $eventos_direita);
	}
	
	function modalbox($id){
		$this->layout = '' ;
		$utilidade_unico = $this->Utilidade->getUtilidade($id);
		$this->set('utilidade_unico' , $utilidade_unico);
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