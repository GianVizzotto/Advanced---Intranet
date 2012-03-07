<?php
	$this->Paginator->options(array('url' => array('controller' => 'eventos', 'action' => 'visualizar' ) , 'paramType' => 'querystring'));
?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaE">
    
    <h1>EVENTOS</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        
			<!-- INICIO BARRA EXIBIR -->
        	<div id="barra_exibir">
        
        	Exibindo:<strong> Últimos Eventos</strong>
			
            </div>
            <!-- FINAL BARRA EXIBIR -->
                    
 
                        
			<div class="clear">&nbsp;</div>
            
            <!-- INICIO LISTA LINKS -->
            <div class="lista_links">
            	
            	<?php foreach ($ultimos_eventos as $ultimos_evento):?>
            		
            		<a href="modalbox/<?php echo $ultimos_evento['Evento']['id'].'?height=500&width=850';?>" class="thickbox">
                    	<span><?php echo $this->Time->format( 'd/m/Y - H:i', $ultimos_evento['Evento']['data_criacao']);?> - <?php echo $ultimos_evento['Evento']['nome'];?></span>
                    	<span class="title"><?php echo substr(strip_tags($ultimos_evento['Evento']['conteudo']), 0, 150)."...";?></span>	 
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
    
    	<h1>ÚLTIMAS NOTÍCIAS</h1>
    
		<?php foreach ($noticias_direita as $noticia_direita):?>
			
        <a href="/noticias/modalbox/<?php echo $noticia_direita['Noticia']['id'].'?height=500&width=850';?>" class="box thickbox">
        	<b><?php echo $this->Time->format( 'd/m/Y - H:i', $noticia_direita['Noticia']['data_criacao']);?></b>
        	<strong><?php echo $noticia_direita['Noticia']['nome'];?></strong>
        	<span><?php echo substr(strip_tags($noticia_direita['Noticia']['conteudo']), 0, 100)."...";?></span>                       	 
        </a>			
			
		<?php endforeach;?>
		
	    <a href="/noticias/visualizar" class="bt_padrao">+ NOTÍCIAS</a> 
                    
    </div>
    <!-- FINAL COLUNA A -->                   

</div>
<!-- FINAL MEIO -->