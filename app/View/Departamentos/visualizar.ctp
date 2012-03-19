<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaE">
    
    <h1><?php echo strtoupper($departamento['Departamento']['nome']) ?></h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        
	        <h2 style="margin-bottom:20px;">Informações sobre o setor</h2>
	        
	        <?php echo $departamento['Departamento']['conteudo']; ?>
			
			<?php if ( !empty($conteudo_baixo) ): ?>
			<h2 style="clear:both;">Veja mais conteúdos sobre esse setor</h2>
			
			<style type="text/css">
			.lista		{ margin-right:30px;}
			.lista li a	{    color: #4D4D4F;
			    display: block;
			    margin: 5px 10px;
			    padding: 10px;}
			.lista li a:hover	{ background:#eee;}	
			
			</style>  
	        
	        <ul class="lista">
	        	<?php foreach ($conteudo_baixo as $conteudo_baix):?>
	        		<?php echo '<li><a href="/departamentos_conteudos/modalbox/'.$conteudo_baix['Departamentos_conteudo']['id'].'?height=500&width=850" class="thickbox">'.$conteudo_baix['Departamentos_conteudo']['titulo'].'</a></li>'; ?>
	        	<?php endforeach;?>
			</ul>                        
	                        
			<div class="clear">&nbsp;</div>
            <?php endif; ?>
            
            <?php if ( !empty($usuarios_baixo) ): ?>
			<h2 style="clear:both;">Veja os funcionários desse setor</h2>
			
			<style type="text/css">
			.lista		{ margin-right:30px;}
			.lista li a	{    color: #4D4D4F;
			    display: block;
			    margin: 5px 10px;
			    padding: 10px;}
			.lista li a:hover	{ background:#eee;}	
			
			</style>  
	        
	        <ul class="lista">
	        	<?php foreach ($usuarios_baixo as $usuario_baixo):?>
	        		<?php echo '<li><a href="/usuarios/perfil/'.$usuario_baixo['Usuario']['id'].'">'.$usuario_baixo['Usuario']['nome'].'</a></li>'; ?>
	        	<?php endforeach;?>
			</ul>                        
	                        
			<div class="clear">&nbsp;</div>
            <?php endif; ?>
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