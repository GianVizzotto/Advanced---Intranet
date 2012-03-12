<?php echo $this->Html->script('advanced');?>
<?php echo $this->Html->script('avisos');?>

<?php
	echo $this->Session->flash();

	$this->Paginator->options(array('url' => array('controller' => 'avisos', 'action' => 'index', '?' => array('status_aviso_id' => $this->params['url']['status_aviso_id'], 'departamento_id' => $this->params['url']['departamento_id']) , 'usuario_id' => $this->params['url']['usuario_id'] ) , 'paramType' => 'querystring'));
?>

<!-- INICIO COLUNA D -->
<div id="colunaD">
 	<h1>AVISOS</h1>
	<!-- INICIO CONTEUDO -->
	<div class="conteudo">
		<!-- INICIO BARRA EXIBIR -->
		<div id="barra_exibir">
			Exibindo:<strong><span id="exibir"><?php echo isset($this->params['url']['status_aviso_id'])&&!empty($this->params['url']['status_aviso_id'])?" ".$status_avisos[$this->params['url']['status_aviso_id']]:' Todos';?> </span></strong>
			<?php echo $this->Form->create('FiltroAviso', array('type'=>'get')) ;?>
				Exibir:
                <?php echo $this->Form->input('status_aviso_id' , array ( 'options' => $status_avisos, 'div' => false, 'selected' => $this->params['url']['status_aviso_id'], 'label' => false ) ) ;?>
                <?php echo $this->Form->input('departamento_id' , array ( 'type' => 'hidden', 'value' => $usuario_dados['Usuario']['departamento_id'] ) ) ;?>
                <?php echo $this->Form->input('usuario_id' , array ( 'type' => 'hidden', 'value' => $usuario_dados['Usuario']['id'] ) ) ;?>                
			<?php echo $this->Form->end('OK') ;?>
		</div>
		<!-- FINAL BARRA EXIBIR -->
                        
		<div class="clear">&nbsp;</div>
		<div id="grid">
			<?php if ($avisos) : ?>
				<div>
					<?php foreach ($avisos as $aviso) :?>
						<a href="/avisos/aviso_detalhe?id=<?php echo  $aviso['Aviso']['id'] ; ?>&height=500&width=850" class="thickbox">
							<span><?php echo $this->Time->format('d/m/Y H:i', $aviso['Aviso']['data_criacao']); ?> - <?php echo $aviso['Usuario']['nome'] ; ?> >>
							<?php if(!$aviso['AvisoDestinatario']['usuario_id'] && !$aviso['Departamento']['nome']):?>
								<?php echo 'Todos';?>
							<?php else:?> 
								<?php echo !empty($aviso['AvisoDestinatario']['usuario_id'])?$aviso['Destinatario']['nome']:$aviso['Departamento']['nome'];?></span>
							<?php endif;?>
							<span class="title"><?php echo $aviso['Aviso']['assunto'] ; ?></span>	 
						</a>
					<?php endforeach ;?>
				</div>
				<?php else : ?>
					<div align="center"><strong>Nenhum aviso encontrado</strong></div>
			<?php endif; ?>
		</div>
		<div class="clear">&nbsp;</div>
			<div class="paginacao" style="text-align:center;display:inline">
				<ul class="pag">
					<li><?php echo $this->Paginator->first('Primeira', array('class'=>false)); ?></li>	
					<li><?php echo $this->Paginator->numbers(array('class'=>false)); ?></li>
					<li><?php echo $this->Paginator->last('Última',array('class'=>false));	?></li>
				</ul>	
			</div>
	</div>
</div>
<!-- FINAL COLUNA D -->
<div id="colunaB" style="margin-right:0px;">
                
	<h1>NOVO AVISO</h1>
	<div class="conteudo">
                    
		<!-- INICIO FORM -->
		<div class="formulario">
	 
			<?php echo $this->Form->create('Aviso', array ('enctype' => 'multipart/form-data'));?>
		  	  <?php echo $this->Form->input( 'status_aviso_id' , array( 'type' => 'hidden' , 'value' => 2 ) ) ;?>
		  		
				<label for="">
		        	Departamentos: <br />
		            <?php echo $this->Form->input( 'AvisoDestinatario.departamento_id', array('options' => $departamentos , 'label' => false , 'div' => false , 'onchange' => "mostraUsuarios(this.value,'usuario','avisos','usuarios')" ) ) ;?>    
				</label>                                   
		                                
				<label for="usuarios">
					<span class="usuario">
						<?php echo $usuarios ; ?>
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