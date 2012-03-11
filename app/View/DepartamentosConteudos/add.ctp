<?php
	echo $this->Html->script('ckeditor/ckeditor.js');
	echo $this->Html->script('ckfinder/ckfinder.js');
?> 
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<?php if($id):?>
			<h1>EDI&Ccedil;&Atilde;O DE CONTEÚDOS</h1>
		<?php else:?>
			<h1>NOVO CONTEÚDO</h1>
		<?php endif; ?> 
		<div class="conteudo" style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Departamentos_conteudo', array ('enctype' => 'multipart/form-data') ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
                                
					<label for="Titulo">
						Título: <br />
						<?php echo $this->Form->input('titulo' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>

					<label for="Tipos">
						Departamento: <br />                                           
						<?php echo $this->Form->input('departamentos_id' , array ( 'options' => $departamentos , 'label' => false) ) ;?> 
					</label>
					 
					<label for="Conteudo">
						Conte&uacute;do: <br />                                           
						<?php echo $this->Form->input('conteudo' , array ( 'type' => 'textarea' , 'label' => false, 'class' => $ckeditorClass) ) ;?> 
					</label>
					
					<br />   
				                    
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
                                
			</div>  
		</div>
	</div>
</div>
<script type="text/javascript">
  var ck_newsContent = CKEDITOR.replace( 'data[Departamentos_conteudo][conteudo]', {toolbar : [
			[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
			[ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ],
			['Link', 'Unlink', '-', 'Maximize'],
			'/',
			['FontSize', 'Bold', 'Italic','Underline','StrikeThrough','Subscript','Superscript','RemoveFormat'],
			[ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
			[ 'Image','Table','HorizontalRule','Smiley','SpecialChar' ],
			['TextColor', 'BGColor', '-','Table','HorizontalRule', '-', 'Smiley','SpecialChar']
		],
		filebrowserBrowseUrl : '/js/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' });
</script>