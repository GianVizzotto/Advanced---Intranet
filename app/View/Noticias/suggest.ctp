<?php
	echo $this->Html->script('ckeditor/ckeditor.js');
	echo $this->Html->script('ckfinder/ckfinder.js');
?> 
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<?php if($id):?>
			<h1>EDI&Ccedil;&Atilde;O DE NOTÍCIA</h1>
		<?php else:?>
			<h1>NOVA NOTÍCIA</h1>
		<?php endif; ?> 
		<div class="conteudo" style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Noticia', array ('enctype' => 'multipart/form-data') ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
                                
					<label for="Nome">
						Nome: <br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					
					<label for="Fonte">
						Fonte: <br />
						<?php echo $this->Form->input('fonte' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					
					<label for="Conteudo">
						Conte&uacute;do: <br />                                           
						<?php echo $this->Form->input('conteudo' , array ( 'type' => 'textarea' , 'label' => false, 'class' => $ckeditorClass) ) ;?> 
					</label>
					
					<label for="Imagem">
						Imagem de contexto: <br />                                           
						<input type="file" name="data[File][imagem]" id="FileImage" />
						<br />
						<?php if($url_imagem){ echo "<a href='/$url_imagem' target='_blank' >$url_imagem</a>";}?>
					</label>
					
					<label for="Tipos">
						Tipo de Conte&uacute;do: <br />                                           
						<?php echo $this->Form->input('tipos_conteudos_id' , array ( 'options' => $Tipos_conteudos , 'label' => false) ) ;?> 
					</label> 

					<br />   
				                    
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
                                
			</div>  
		</div>
	</div>
</div>
<script type="text/javascript">
  var ck_newsContent = CKEDITOR.replace( 'data[Noticia][conteudo]', {toolbar : [
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