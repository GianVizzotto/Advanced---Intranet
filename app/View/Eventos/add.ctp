<?php
	echo $this->Html->script('ckeditor/ckeditor.js');
	//echo $this->Html->script('ckfinder/ckfinder.js');
?> 
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<?php if($id):?>
			<h1>EDI&Ccedil;&Atilde;O DE EVENTO</h1>
		<?php else:?>
			<h1>NOVO EVENTO</h1>
		<?php endif; ?> 
		<div class="conteudo" style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Evento' ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
                                
					<label for="Nome">
						Nome: <br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					
					<label for="Conteudo">
						Conte&uacute;do: <br />                                           
						<?php echo $this->Form->input('conteudo' , array ( 'type' => 'textarea' , 'label' => false, 'class' => $ckeditorClass )) ;?> 
					</label>
					
					<label for="Imagem">
						Imagem de contexto: <br />                                           
						<?php echo $this->Form->input('imagem' , array ( 'type' => 'file' , 'label' => false )) ;?> 
					</label>
					
					<label for="Tipos">
						Tipo de Conte&uacute;do: <br />                                           
						<?php echo $this->Form->input('tipos_conteudo_id' , array ( 'options' => $Tipos_conteudos , 'label' => false) ) ;?> 
					</label> 
					<br />   
				                    
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
                                
			</div>  
		</div>
	</div>
</div>
<script type="text/javascript">
  var ck_newsContent = CKEDITOR.replace( 'data[Evento][conteudo]', {toolbar : [
			[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
			[ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ],
			['Link', 'Unlink', '-', 'Maximize'],
			'/',
			['FontSize', 'Bold', 'Italic','Underline','StrikeThrough','Subscript','Superscript','RemoveFormat'],
			[ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
			['TextColor', 'BGColor', '-','Table','HorizontalRule', '-', 'Smiley','SpecialChar']
		] });
</script>