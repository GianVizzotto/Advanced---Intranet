<?php echo $this->Html->script('cadastro');?>
<?php echo $this->Html->script('advanced');?>
<?php
	echo $this->Html->script('ckeditor/ckeditor.js');
	echo $this->Html->script('ckfinder/ckfinder.js');
?> 
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Novo Usuário</h1> 
		<div class="conteudo"  style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Usuario' , array( 'options' => array ( 'action' => 'cadastro' , 'controller' => 'usuarios' ), 'enctype' => 'multipart/form-data' ) ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
 					
 					<?php echo $this->Form->input('status_usuario_id' , array ( 'type' => 'hidden' , 'value' => 1 ) ) ;?>
                                
					<label for="Nome">
						Nome: <br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					
					<label for="Email">
						E-mail: <br />                                           
						<?php echo $this->Form->input('email' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Senha">
						Senha (De 3 a 10 caracteres): <br />                                           
						<?php echo $this->Form->input('senha' , array ( 'type' => 'password' , 'label' => false) ) ;?> 
					</label>
						
 						
					<label for="Departamento">
						Departamento: <br />                                           
						<?php echo $this->Form->input('departamento_id' , array ( 'options' => $departamentos, 'onchange' => "mostraUsuarios(this.value,'cargos','usuarios','cargos')", 'label' => false) ) ;?> 
					</label>
					
					<?php if($cargo_id):?>
						<?php echo $this->Form->input('cargo_id_aux' , array ( 'type' => 'hidden', 'value' => $cargo_id, 'id' => 'cargo_id_aux' ) ) ;?>
					<?php endif;?>
						<label for="Cargo">
							<div class="cargos">
								<?php if ($lista_cargos): ?>
									Cargo<br/>
									<?php echo $this->Form->input('cargo_id' , array ( 'options' => $lista_cargos, 'selected' => $cargo_id , 'div' => false , 'label' => false ) ) ;?>
								<?php endif; ?>
							</div> 
						</label>
				
					<label for="Perfil">
						Perfil: <br />                                           
						<?php echo $this->Form->input('perfil_id' , array ( 'options' => $perfis, 'label' => false) ) ;?> 
					</label>
				                    
					<label for="Ramal">
						Ramal: <br />                                           
						<?php echo $this->Form->input('ramal' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Data_Nascimento">
						Data de Nascimento: <br />                                           
						<?php echo $this->Form->input('data_nascimento' , array ( 'type' => 'text' , 'maxLenght' => '10' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Telefone">
						Telefone: <br />                                           
						<?php echo $this->Form->input('telefone' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					                                                             
					<label for="Celular">
						Celular: <br />                                           
						<?php echo $this->Form->input('celular' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>

					<label for="Foto_url">
						Foto: <br />                                           
						<input type="file" name="data[File][imagem]" id="FileImage" />
						<br />
						<?php if($url_foto){ echo "<a href='/$url_foto' target='_blank' ><img width='200' src=/$url_foto /></a>";}?>
					</label>
					
					<label for="Descricao">
						Mini currículo: <br />                                           
						<?php echo $this->Form->input('descricao' , array ( 'type' => 'textarea' , 'label' => false, 'class' => $ckeditorClass) ) ;?> 
					</label>
					                                                             
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
           </div>  
		</div>
	</div>
	

</div>
<script type="text/javascript">
  var ck_newsContent = CKEDITOR.replace( 'data[Usuario][descricao]', {toolbar : [
			[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
			['Link', 'Unlink', '-', 'Maximize'],
			'/',
			['FontSize', 'Bold', 'Italic','Underline','StrikeThrough','Subscript','Superscript','RemoveFormat'],
			[ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ]
		],
		filebrowserBrowseUrl : '/js/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' });
</script>