<?php echo $this->Html->script('avisos');?>
<?php echo $this->Html->script('advanced');?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA D -->
    <div id="colunaD">
    
    <h1>ANIVERSARIANTES</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
                        
			<p style="margin-left:20px; margin-top:10px;">Clique no aniversariante para mandar um recado para ele!</p>
			
			<?php foreach ($ultimos_usuarios as $ultimos_usuario):?>
	            <a href="/aniversariantes<?php echo '?dpto_aviso='.$ultimos_usuario['Departamentos']['id'].'&func_aviso='.$ultimos_usuario['Usuario']['id'] ?>">
	                <span><?php echo $this->Time->format('d/m/Y', $ultimos_usuario['Usuario']['data_nascimento']);?> - <?php echo $ultimos_usuario['Usuario']['nome'];?> </span>
	                <SPAN><?php echo $ultimos_usuario['Cargos']['nome'];?> - <?php echo $ultimos_usuario['Departamentos']['nome'];?></SPAN>
	            </a>
            <?php endforeach;?>
			<div class="clear">&nbsp;</div>
	    	<div class="paginacao" style="text-align:center;">
				<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
				<span><?php echo $this->Paginator->numbers(); ?></span>
				<span><?php echo $this->Paginator->last('Última');	?></span>
			</div>
		</div>
        <!-- FINAL CONTEUDO -->
	</div>
    <!-- FINAL COLUNA D -->                
    
	<?php if($this->Session->read('Usuario')): ?>
		<!-- INICIO COLUNA B -->
		<div id="colunaB" style="margin-right:0px;">
	                
				<h1>NOVO AVISO</h1>
				<div class="conteudo">
			                    
					<!-- INICIO FORM -->
					<div class="formulario">
				 
						<?php echo $this->Form->create('Aviso', array ('enctype' => 'multipart/form-data', 'action' => 'index'));?>
					  	  <?php echo $this->Form->input( 'status_aviso_id' , array( 'type' => 'hidden' , 'value' => 2 ) ) ;?>
					                                
							<label for="">
					        	Departamento do destinatário: <br />
					            <?php echo $this->Form->input( 'AvisoDestinatario.departamento_id', array('options' => $select_departamento_aviso , 'selected' => $dpto_aviso, 'label' => false , 'div' => false , 'onchange' => "mostraUsuarios(this.value,'usuario','ramais','usuarios')" ) ) ;?>    
							</label>                                   
					                                
							<label for="usuarios">
								<span class="usuario">
									<?php
										if (!empty ($func_aviso)){
											echo "Usuários <br/>";
											echo $this->Form->input('AvisoDestinatario.usuario_id' , array ( 'options' => $usuarios, 'selected' => $func_aviso , 'div' => false , 'label' => false ) ) ;
										}else{
											echo $usuarios ;
										} 
										 
									?>
								</span>                                       
							</label>    
					                                    
							<label for="">
								Anexo: <br />
								<input type="file" name="data[File][anexo]" id="FileImage" />
								<?php //echo $this->Form->input( 'anexo' , array('type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
							</label>
					                                    
							<label for="">
								Assunto: <br />
								<?php echo $this->Form->input( 'assunto' , array('type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
							</label>
					                                    
							<label for="">
								Mensagem: <br />
								<?php echo $this->Form->input( 'mensagem' , array('type' => 'textarea' , 'label' => false , 'div' => false , 'class' => 'campoTxt' ) ) ;?>
							</label> 
					                                    
							<?php echo $this->Form->submit('Enviar' , array('class' => 'btForm') ) ;?>               
						<?php echo $this->Form->end();?>
				                                
					</div>
					<!-- FINAL FORMULARIO -->
				</div>
			</div>
	    <!-- FINAL COLUNA B -->
	<?php endif;?>                    
</div>
<!-- FINAL MEIO -->