<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA A -->
    <div id="colunaA">
    
    <h1>ANIVERSARIANTES DO MÊS</h1>
        <?php foreach ($usuarios_esquerda as $usuario_esquerda):?>
            <a class="box" href="/aniversariantes">
				
				<?php if ($usuario_esquerda['Usuario']['foto_url'] != ""): ?>
                	<img width="75" src="/<?php echo $usuario_esquerda['Usuario']['foto_url'];?>"  />
                <?php else: ?>
                	<img width="75" src="/img/img_perfil.jpg"  />
                <? endif; ?>	
                
                    <strong><?php echo $usuario_esquerda['Usuario']['nome'];?></strong>
                    <span><?php echo $usuario_esquerda['Departamentos']['nome'];?></span>
                    <span><?php echo $usuario_esquerda['Usuario']['data_nascimento'];?></span>
                    <span class="bt">ENVIE UMA MENSAGEM</span>
                                                
            </a>
        <?php endforeach;?>

    <a href="/aniversariantes" class="bt_padrao">+ ANIVERSÁRIOS</a>                               
    
    </div>
    <!-- FINAL COLUNA A -->

	<!-- INICIO COLUNA B -->
    <div id="colunaB">
    
    <h1>ÚLTIMOS AVISOS</h1>
 
                    <a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin" class="box">
            <span>28/06 14h50 - ANTÔNIO APARECIDO | GERENTE DE PROJETOS</span>
            <span class="title">NOVA ENTRADA PARA FUNCIONÁRIOS</span>	 
        </a>

        <a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin" class="box">
            <span>28/06 14h50 - ANTÔNIO APARECIDO | GERENTE DE PROJETOS</span>
            <span class="title">NOVA ENTRADA PARA FUNCIONÁRIOS</span>	 
        </a>

        <a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin" class="box">
            <span>28/06 14h50 - ANTÔNIO APARECIDO | GERENTE DE PROJETOS</span>
            <span class="title">NOVA ENTRADA PARA FUNCIONÁRIOS</span>	 
        </a>

        <a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin" class="box">
            <span>28/06 14h50 - ANTÔNIO APARECIDO | GERENTE DE PROJETOS</span>
            <span class="title">NOVA ENTRADA PARA FUNCIONÁRIOS</span>	 
        </a>

        <a href="lib/modalbox/detalhe_aviso.php" rel="prettyPopin" class="box">
            <span>28/06 14h50 - ANTÔNIO APARECIDO | GERENTE DE PROJETOS</span>
            <span class="title">NOVA ENTRADA PARA FUNCIONÁRIOS</span>	 
        </a>
 
                <a href="#" class="bt_padrao">+ AVISOS</a> 
    
    </div>
    <!-- FINAL COLUNA B -->                

	<!-- INICIO COLUNA C -->
    <div id="colunaA">
    
    <h1>ÚLTIMAS NOTÍCIAS</h1>
    
    
    	<?php foreach ($noticias_direita as $noticia_direita):?>

	        <a href="/noticias/modalbox/<?php echo $noticia_direita['Noticia']['id'];?>" rel="prettyPopin" class="box">
	        	<b><?php echo $noticia_direita['Noticia']['data_criacao'];?></b>
	        	<strong><?php echo $noticia_direita['Noticia']['nome'];?></strong>
	        	<span><?php echo substr(strip_tags($noticia_direita['Noticia']['conteudo']), 0, 100)."...";?></span>                       	 
	        </a>
			
		<?php endforeach;?>
		
    <a href="/noticias/visualizar" class="bt_padrao">+ NOTÍCIAS</a> 
                    
    </div>
    <!-- FINAL COLUNA C -->                
	<?php $usuario = $this->Session->read('Usuario');?>
	<?php
		if ($usuario['Usuario']['perfil_id'] == 1):
			echo '<div class="clear">&nbsp;</div>';
			echo '<h1><center>CADASTROS</center></h1>';
			echo '<a href="/usuarios" class="bt_padrao"><center>CADASTRO DE USUÁRIOS</center></a>';
			echo '<a href="/eventos" class="bt_padrao" style="margin: 0 90px;"><center>CADASTRO DE EVENTOS</center></a>';
			echo '<a href="/noticias" class="bt_padrao"><center>CADASTRO DE NOTÍCIAS</center></a>';
		endif;
	?>
</div>
<!-- FINAL MEIO -->

