<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<?php if($id):?>
			<h1>EDI&Ccedil;&Atilde;O DE CATEGORIAS</h1>
		<?php else:?>
			<h1>NOVA CATEGORIA</h1>
		<?php endif; ?> 
		<div class="conteudo" style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Tipos_conteudo', array ('enctype' => 'multipart/form-data') ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
                                
					<label for="Nome">
						Nome: <br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					<br />   
				                    
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
                                
			</div>  
		</div>
	</div>
</div>