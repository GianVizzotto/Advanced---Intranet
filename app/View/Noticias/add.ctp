<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<?php if($id):?>
			<h1>EDI&Ccedil;&Atilde;O DE NOTÍCIA</h1>
		<?php else:?>
			<h1>NOVA NOTÍCIA</h1>
		<?php endif; ?> 
		<div class="conteudo" style=" width: 910px;">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Noticia' ); ?>
 						
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
						<?php echo $this->Form->input('conteudo' , array ( 'type' => 'textarea' , 'label' => false) ) ;?> 
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