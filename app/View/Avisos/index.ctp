<?php echo $this->Html->script('advanced');?>
<?php echo $this->Session->flash();?>
<!-- INICIO COLUNA D -->
<div id="colunaD">
                
	<h1>AVISOS</h1>
                
	<!-- INICIO CONTEUDO -->
	<div class="conteudo">
                    
		<!-- INICIO BARRA EXIBIR -->
		<div id="barra_exibir">
                    
			Exibindo:<strong> Últimos Avisos</strong>
                        
			<?php echo $this->Form->create('FiltroAviso') ;?>
				Exibir:
                <?php echo $this->Form->input('status_aviso_id' , array ( 'options' => $status_avisos , 'div' => false , 'label' => false ) ) ;?>                
     			<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
			<?php echo $this->Form->end() ;?>
     
		</div>
                        <!-- FINAL BARRA EXIBIR -->
                        
		<div class="clear">&nbsp;</div>
			<?php foreach ($avisos as $aviso) :?> 									
				<a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin">
					<span><?php echo $aviso['Aviso']['data_criacao'] ; ?> - <?php echo $aviso['Usuario']['nome'] ; ?> | <?php echo $aviso['Departamento']['nome'] ;?></span>
					<span class="title"><?php echo $aviso['Aviso']['assunto'] ; ?></span>	 
				</a>
			<?php endforeach ;?>    
		</div>
		<!-- FINAL CONTEUDO -->
 
 
                
           </div>
                <!-- FINAL COLUNA D -->         
                
                                <div id="colunaB" style="margin-right:0px;">
                
                <h1>NOVO AVISO</h1>
                
                	<!-- INICIO CONTEUDO -->
                    <div class="conteudo">
                    
                    	<!-- INICIO FORM -->
                        <div class="formulario">
 
                                <?php echo $this->Form->create('Aviso');?>
                                
                                	<?php echo $this->Form->input( 'status_aviso_id' , array( 'type' => 'hidden' , 'value' => 1 ) ) ;?>
                                
                                    <label for="">
                                        Departamento do destinatário: <br />
                                        <?php echo $this->Form->input( 'departamento_id' , array('options' => $departamentos , 'label' => false , 'div' => false , 'onchange' => "mostraUsuarios(this.value,'usuario','avisos','usuarios')" ) ) ;?>    
                                    </label>                                   
                                
                                    <label for="usuarios">
 										<span class="usuario">
 											<?php echo $usuarios ; ?>
 										</span>                                       
                                    </label>    
                                    
                                    <label for="">
                                        Anexo: <br />
										<?php echo $this->Form->input( 'anexo' , array('type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
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
                    <!-- FINAL CONTEUDO -->
                
           		</div>