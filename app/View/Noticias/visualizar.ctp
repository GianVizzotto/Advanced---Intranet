<?php
	$this->Paginator->options(array('url' => array('controller' => 'noticias', 'action' => 'visualizar', '?' => array('tipos_conteudo_id' => $this->params['url'][tipos_conteudo_id]) ) , 'paramType' => 'querystring'));
?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaE">
    
    <h1>NOTÍCIAS</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        
			<!-- INICIO BARRA EXIBIR -->
        	<div id="barra_exibir">
        
        	Exibindo:<strong> Últimas Notícias</strong>
        
            
                <?php echo $this->Form->create('Noticias' , array ( 'type' => 'get' , 'action' => 'visualizar' ) ) ;?>
                    Categoria:
                    
					<?php echo $this->Form->input('tipos_conteudo_id' , array ( 'options' => $Tipos_conteudos , 'label' => false) ) ;?> 
                    
					<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>
			
            </div>
            <!-- FINAL BARRA EXIBIR -->
                    
 
                        
			<div class="clear">&nbsp;</div>
            
            <!-- INICIO LISTA LINKS -->
            <div class="lista_links">
            	
            	<?php foreach ($ultimos_noticias as $ultimos_noticia):?>
            		
            		<a href="modalbox/<?php echo $ultimos_noticia['Noticia']['id'];?>" rel="prettyPopin">
                    	<span><?php echo $ultimos_noticia['Noticia']['data_criacao'];?> - <?php echo $ultimos_noticia['Noticia']['nome'];?></span>
                    	<span class="title"><?php echo substr(strip_tags($ultimos_noticia['Noticia']['conteudo']), 0, 150)."...";?></span>	 
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
			
        <a href="/eventos/modalbox/<?php echo $evento_direita['Evento']['id'];?>" rel="prettyPopin" class="box">
        	<b><?php echo $evento_direita['Evento']['data_criacao'];?></b>
        	<strong><?php echo $evento_direita['Evento']['nome'];?></strong>
        	<span><?php echo substr(strip_tags($evento_direita['Evento']['conteudo']), 0, 100)."...";?></span>                       	 
        </a>			
			
		<?php endforeach;?>
 
		<a href="/eventos/visualizar" class="bt_padrao">+ EVENTOS</a> 
                    
    </div>
    <!-- FINAL COLUNA A -->                   

</div>
<!-- FINAL MEIO -->