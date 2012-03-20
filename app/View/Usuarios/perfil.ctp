<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA E -->
    <div id="colunaE">
    
    <h1>PERFIL</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
        
        	<!-- INICIO COL 1 -->
            <div id="col1">
        		
        		<?php if ($usuario_perfil['Usuario']['foto_url'] != ""): ?>
                	<img width="200" src="/<?php echo $usuario_perfil['Usuario']['foto_url'];?>"  />
                <?php else: ?>
                	<img width="200" src="/img/img_perfil.jpg"  />
                <? endif; ?>	
           		
           		<?php if ( $id_flag < 1 ): ?>
           		
				<p class="accordionButton bt_perfil">Alterar Foto</p>
                         
				<div class="accordionContent">Selecionar nova foto: <br />
					<form enctype="multipart/form-data" method="post" accept-charset="utf-8" id="FormFoto" action="/usuarios/alterafoto/<?php echo $usuario_perfil['Usuario']['id'] ?>"> 
						<input type="file" name="data[File][imagem]" id="FileImage" class="campoTxt" /> 
						<input type="submit" value="OK" class="btForm " />
					</form>
				</div>
                            
				<p class="accordionButton bt_perfil">Alterar Senha</p>
                         
				<div class="accordionContent">Nova Senha: <br />
					<form method="post" accept-charset="utf-8" id="FormPass" action="/usuarios/alterasenha/<?php echo $usuario_perfil['Usuario']['id'] ?>"> 
						<input type="password" name="password" class="campoTxt" /> 
						<input type="submit" value="OK" class="btForm "  />
					</form>
					<br />
					<p style="font-size: 10px; color: #CD0000;">A alteração entra em vigor no próximo login.</p>
					
				</div>    
        		
        		<?php endif; ?>
        	</div>
            <!-- FINAL COL 1 -->
            
            <!-- FINAL COL 2 -->
            <div id="col2">
            	<div style="float: left;">
	            	<h2>Nome:</h2>
	                <p><?php echo $usuario_perfil['Usuario']['nome'] ?></p>
	                
	                <h2>Cargo:</h2>
	                <p><?php echo $usuario_perfil['Cargo']['nome'] ?></p>
	                
	                <h2>Setor:</h2>
	                <p><?php echo $usuario_perfil['Departamento']['nome'] ?></p>
	                
	                <h2>E-mail:</h2>
					<p><?php echo $usuario_perfil['Usuario']['email'] ?></p>                        
	                
	                <h2>Data de Nascimento:</h2>
	                <p><?php echo $this->Time->format('d/m/Y', $usuario_perfil['Usuario']['data_nascimento']); ?></p>
	                
	                <h2>Ramal:</h2>
	                <p><?php echo $usuario_perfil['Usuario']['ramal'] ?></p>                            
	                
	                <h2>Telefone:</h2>
	                <p><?php echo $usuario_perfil['Usuario']['telefone'] ?></p>                            
	                
	                <h2>Celular:</h2>
	                <p><?php echo $usuario_perfil['Usuario']['celular'] ?></p>    
                </div>
                <div style="float: right; width: 250px;"><?php  if ($usuario_perfil['Usuario']['descricao'] != ""): echo '<h2>Qualificações Pessoais</h2><br />' ; echo $usuario_perfil['Usuario']['descricao']; endif; ?></div>
                
            </div>
            <!-- FINAL COL 2 -->
        
        </div>
        <!-- FINAL CONTEUDO -->

	</div>
    <!-- FINAL COLUNA E -->                

	<!-- INICIO COLUNA A -->
	    <div id="colunaA">
    
    <h1>ÚLTIMAS NOTÍCIAS</h1>
    
    
    	<?php foreach ($noticias_direita as $noticia_direita):?>

	        <a href="/noticias/modalbox/<?php echo $noticia_direita['Noticia']['id'].'?height=500&width=850';?>" class="box thickbox">
	        	<b><?php echo $this->Time->format( 'd/m/Y - H:i',$noticia_direita['Noticia']['data_criacao']);?></b>
	        	<strong><?php echo $noticia_direita['Noticia']['nome'];?></strong>
	        	<span><?php echo substr(strip_tags($noticia_direita['Noticia']['conteudo']), 0, 100)."...";?></span>                       	 
	        </a>
			
		<?php endforeach;?>
		
    <a href="/noticias/visualizar" class="bt_padrao">+ NOTÍCIAS</a> 
                    
    </div>
    <!-- FINAL COLUNA A -->                

</div>
<!-- FINAL MEIO -->