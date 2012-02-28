            <!-- INICIO MEIO -->
            <div id="meio">
            
            	<!-- INICIO COLUNA A -->
                <div id="colunaA">
                
                <h1>ANIVERSARIANTES DO MÊS</h1>

                    <a class="box" href="aniversariantes.php">

                        <img width="75" src="/img/img_perfil.jpg"  />	
                        
                            <strong>JOÃO PEREIRA </strong>
                            <span>Comercial</span>
                            <span>18/08/2010</span>
                            <span class="bt">ENVIE UMA MENSAGEM</span>
                                                        
                    </a>

                    <a class="box" href="aniversariantes.php">

                        <img width="75" src="/img/img_perfil.jpg"  />	
                        
                            <strong>JOÃO PEREIRA </strong>
                            <span>Comercial</span>
                            <span>18/08/2010</span>
                            <span class="bt">ENVIE UMA MENSAGEM</span>
                            
                    </a>

                    <a class="box" href="aniversariantes.php">

                        <img width="75" src="/img/img_perfil.jpg"  />	
                        
                            <strong>JOÃO PEREIRA </strong>
                            <span>Comercial</span>
                            <span>18/08/2010</span>
                            <span class="bt">ENVIE UMA MENSAGEM</span>                            
                    </a>                                        

                <a href="#" class="bt_padrao">+ ANIVERSÁRIOS</a>                               
                
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

            </div>
            <!-- FINAL MEIO -->

