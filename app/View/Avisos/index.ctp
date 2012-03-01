<?php echo $this->Html->script('advanced');?>
<?php echo $this->Html->script('avisos');?>
<?php //echo $this->Html->script('jquery.fancybox-1.3.4');?>
<?php echo $this->Html->script('jquery.prettyPopin');?>

<?php echo $this->Session->flash();?>
<!-- INICIO COLUNA D -->
<div id="colunaD">
 	<h1>AVISOS</h1>
	<!-- INICIO CONTEUDO -->
	<div class="conteudo">
		<!-- INICIO BARRA EXIBIR -->
		<div id="barra_exibir">
			Exibindo:<strong><span id="exibir"> </span></strong>
			<?php echo $this->Form->create('FiltroAviso') ;?>
				Exibir:
                <?php echo $this->Form->input('status_aviso_id' , array ( 'options' => $status_avisos , 'div' => false , 'label' => false ) ) ;?>
                <?php echo $this->Form->input('departamento_id' , array ( 'type' => 'hidden' , 'value' => $usuario_dados['Usuario']['departamento_id'] ) ) ;?>
                <?php echo $this->Form->input('usuario_id' , array ( 'type' => 'hidden' , 'value' => $usuario_dados['Usuario']['id'] ) ) ;?>                
			<?php echo $this->Form->end() ;?>
		</div>
		<!-- FINAL BARRA EXIBIR -->
                        
		<div class="clear">&nbsp;</div>
		<div id="grid"></div>               
	</div>
</div>

<!-- FINAL COLUNA D -->         
<div id="colunaB" style="margin-right:0px;">
                
	<h1>NOVO AVISO</h1>
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
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("a[rel^='prettyPopin']").prettyPopin();
});
</script>