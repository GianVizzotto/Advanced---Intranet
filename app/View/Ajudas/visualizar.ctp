<?php
	$this->Paginator->options(array('url' => array('controller' => 'ajudas', 'action' => 'visualizar', '?' => array('tipos_ajuda_id' => $this->params['url'][tipos_ajuda_id]) ) , 'paramType' => 'querystring'));
?>
<style type="text/css">

.funcionario_do_mes 		{ padding-top:20px;}
.funcionario_do_mes h2		{ margin-right:20px; margin-bottom:20px;}
.funcionario_do_mes img		{ float:right; margin-left:20px; margin-bottom:20px;}


</style>

<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaD">
    
    <h1>AJUDAS</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        	<div style="padding:20px;">
			<!-- INICIO BARRA EXIBIR -->
        	<div id="barra_exibir">
        
        	<strong> Últimas Ajudas</strong>
        
            
                <?php echo $this->Form->create('Ajudas' , array ( 'type' => 'get' , 'action' => 'visualizar' ) ) ;?>
                    Categoria:
                    
					<?php echo $this->Form->input('tipos_ajuda_id' , array ( 'options' => $Tipos_ajudas ,'selected' =>  $this->params['url'][tipos_ajuda_id], 'label' => false) ) ;?> 
                    
					<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>
			
            </div>
            <!-- FINAL BARRA EXIBIR -->
                    
 
                        
			<div class="clear">&nbsp;</div>
            
            <!-- INICIO LISTA LINKS -->
            <div class="lista_links">
            	
            	<?php foreach ($ultimos_ajudas as $ultimos_ajuda):?>
            		
            		<a href="modalbox/<?php echo $ultimos_ajuda['Ajuda']['id'].'?height=500&width=850';?>" class="thickbox">
                    	<span><?php echo $ultimos_ajuda['Ajuda']['nome'];?></span>
                    	<span class="title"><?php echo substr(strip_tags($ultimos_ajuda['Ajuda']['conteudo']), 0, 150)."...";?></span>	 
                	</a>
            		
            	<?php endforeach;?>
                            
     		</div>
            <!-- FINAL LISTA LINKS -->
        	<div class="paginacao" style="text-align:center;">
				<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
				<span><?php echo $this->Paginator->numbers(); ?></span>
				<span><?php echo $this->Paginator->last('Última');	?></span>
			</div>
			</div>
        </div>
        <!-- FINAL CONTEUDO -->
                
	</div>
    <!-- FINAL COLUNA E -->                
	<?php if($this->Session->read('Usuario')): ?>
		<!-- INICIO COLUNA B -->
	    <div id="colunaB" style="margin-right:0px;">
	    
			<h1>REPORTE SEU PROBLEMA AO TI</h1>
	                
	    	<!-- INICIO CONTEUDO -->
	        <div class="conteudo">
	                    
		    	<!-- INICIO FORM -->
		        <div class="formulario">
	 
				<?php echo $this->Form->create('Aviso', array ('url' => array('controller' => 'ajudas', 'action' => 'salvaAviso')));?>
				
					<?php echo $this->Form->input( 'status_aviso_id' , array( 'type' => 'hidden' , 'value' => 2 ) ) ;?>
					<?php echo $this->Form->input( 'AvisoDestinatario.departamento_id', array('type' => 'hidden', 'default' => '1') );?>
					<?php echo $this->Form->input( 'AvisoDestinatario.usuario_id' , array('type' => 'hidden' , 'default' => '1') ) ;?>
					<?php echo $this->Form->input( 'assunto' , array('type' => 'hidden' , 'default' => 'Aviso para TI') ) ;?>
		            
						<h2>Se estiver com algum problema em seu computador, utilize o espaço abaixo para enviar para o setor TI.</h2>
	                    
	                     <br /> <br />
	                    	
	                        Mensagem: <br />
	                    
	                   	<?php echo $this->Form->input( 'mensagem' , array('type' => 'textarea' , 'label' => false , 'div' => false , 'class' => 'campoTxt' ) ) ;?> 
	                    
	                    <?php echo $this->Form->submit('Enviar Aviso', array('class'=>'btForm'));?>
	                
	                <?php echo $this->Form->end();?>
	                                
				</div>
	            <!-- FINAL FORMULARIO -->    
	                    
		    </div>
		    <!-- FINAL CONTEUDO -->                   
	
	    </div>
	    <!-- FINAL COLUNA B -->                   
	<?php endif;?>
</div>
<!-- FINAL MEIO -->

