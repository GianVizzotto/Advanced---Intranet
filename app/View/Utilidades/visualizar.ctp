<?php
	$this->Paginator->options(array('url' => array('controller' => 'utilidades', 'action' => 'visualizar', '?' => array('tipos_utilidade_id' => $this->params['url'][tipos_utilidade_id]) ) , 'paramType' => 'querystring'));
?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaE">
    
    <h1>UTILIDADES</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        
			<!-- INICIO BARRA EXIBIR -->
        	<div id="barra_exibir">
        
        	Exibindo:<strong> Últimas Utilidades</strong>
        
            
                <?php echo $this->Form->create('Utilidades' , array ( 'type' => 'get' , 'action' => 'visualizar' ) ) ;?>
                    Categoria:
                    
					<?php echo $this->Form->input('tipos_utilidade_id' , array ( 'options' => $Tipos_utilidades ,'selected' =>  $this->params['url'][tipos_utilidade_id], 'label' => false) ) ;?> 
                    
					<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>
			
            </div>
            <!-- FINAL BARRA EXIBIR -->
                    
 
                        
			<div class="clear">&nbsp;</div>
            
            <!-- INICIO LISTA LINKS -->
            <div class="lista_links">
            	
            	<?php foreach ($ultimos_utilidades as $ultimos_utilidade):?>
            		
            		<a href="modalbox/<?php echo $ultimos_utilidade['Utilidade']['id'].'?height=500&width=850';?>" class="thickbox">
                    	<span><?php echo $ultimos_utilidade['Utilidade']['nome'];?></span>
                    	<span class="title"><?php echo substr(strip_tags($ultimos_utilidade['Utilidade']['conteudo']), 0, 150)."...";?></span>	 
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
        <!-- FINAL CONTEUDO -->
                
	</div>
    <!-- FINAL COLUNA E -->                

	<!-- INICIO COLUNA A -->
    <div id="colunaA">
    
    <h1>ÚLTIMOS EVENTOS</h1>
    
		<?php foreach ($eventos_direita as $evento_direita):?>
			
        <a href="/eventos/modalbox/<?php echo $evento_direita['Evento']['id'].'?height=500&width=850';?>" class="box thickbox">
        	<b><?php echo $this->Time->format( 'd/m/Y - H:i',$evento_direita['Evento']['data_criacao']);?></b>
        	<strong><?php echo $evento_direita['Evento']['nome'];?></strong>
        	<span><?php echo substr(strip_tags($evento_direita['Evento']['conteudo']), 0, 100)."...";?></span>                       	 
        </a>			
			
		<?php endforeach;?>
 
		<a href="/eventos/visualizar" class="bt_padrao">+ EVENTOS</a> 
                    
    </div>
    <!-- FINAL COLUNA A -->                   

</div>
<!-- FINAL MEIO -->