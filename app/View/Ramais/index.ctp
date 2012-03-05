<?php echo $this->Html->script('avisos');?>
<?php echo $this->Html->script('advanced');?>
<?php
	$this->Paginator->options(array('url' => array('controller' => 'ramais', 'action' => 'index', '?' => array('departamento' => $this->params['url'][departamento], 'func' => $this->params['url'][func]) ) , 'paramType' => 'querystring'));
?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA D -->
	<div id="colunaD">
        
        <h1>RAMAIS</h1>
        
        	<!-- INICIO CONTEUDO -->
            <div class="conteudo">

                <!-- INICIO BARRA EXIBIR -->
            	<div id="barra_exibir">
                
                    <?php echo $this->Form->create('Ramais' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
                        Departamento: <br />
                        
                        <?php echo $this->Form->input('departamento' , array('options' => $select_departamento , 'label' => false , 'onchange' => 'mostraNomes(this.value, "ramais", "nomes")') ) ;?>
                        
                         <br /> <br />
                        <div class="exibir_nomes">
						<?php echo $select_nomes ;?>                           
                        </div>
						<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
  						<br /> <br />
					<?php echo $this->Form->end();?>
				
                </div>
                <!-- FINAL BARRA EXIBIR -->                
                
                <div class="clear">&nbsp;</div>
                <?php foreach ($ultimos_usuarios as $ultimos_usuario):?>
	                <p style="margin-left:20px;">
	                <?php echo $ultimos_usuario['Usuario']['nome'];?> - <?php echo $ultimos_usuario['Departamentos']['nome'];?> <br />
	                Ramal: <strong style="font-size:16px;"><?php echo $ultimos_usuario['Usuario']['ramal'];?></strong> <br />
	                Email: <strong style="font-size:12px;"><?php echo $ultimos_usuario['Usuario']['email'];?></strong></p>
	                <a href="/ramais<?php echo '?dpto_aviso='.$ultimos_usuario['Departamentos']['id'].'&func_aviso='.$ultimos_usuario['Usuario']['id'] ?>">Envie um aviso para <?php echo $ultimos_usuario['Usuario']['nome'];?>.</a>
				<?php endforeach; ?>

            </div>
            <!-- FINAL CONTEUDO -->

  		</div>
        <!-- FINAL COLUNA D -->                

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
        <div class="clear">&nbsp;</div>
    	<div class="paginacao" style="text-align:left;">
			<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
			<span><?php echo $this->Paginator->numbers(); ?></span>
			<span><?php echo $this->Paginator->last('Última');	?></span>
		</div>
</div>
<!-- FINAL MEIO -->
<script language="JavaScript">
	function mostraNomes(departamento_id, controller, action){
		
		$.ajax({
			url:'/'+controller+'/'+action+'/'+departamento_id,
			type:'GET',
			dataType:'html',
			beforeSend: function(){
				$('.exibir_nomes').html('Carregando...');
			},
			success: function(result){
				$('.exibir_nomes').html(result);
			}	
		});
		
	}
</script>