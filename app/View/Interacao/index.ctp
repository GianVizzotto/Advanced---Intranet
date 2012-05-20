<style type="text/css">

.funcionario_do_mes 		{ padding-top:20px;}
.funcionario_do_mes h2		{ margin-right:20px; margin-bottom:20px;}
.funcionario_do_mes img		{ float:right; margin-left:20px; margin-bottom:20px;}


</style>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA D -->
    <div id="colunaD">
    
    <h1>INTERAÇÃO</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
 
        	<div style="padding:20px;">

				<h2> Manuais e documentos em PDF: </h2>
 
				<ul>
					<?php foreach ($manuais as $manual): ?>
				    	<?php echo '<li><a href="/'.$manual['Manuai']['arquivo'].'" target="_blank">'.$manual['Manuai']['nome'].'</a></li>'; ?>
				    <?php endforeach; ?>
				</ul>

				<br />
    
				<p style="border-bottom:1px solid #ccc; clear:both;"></p>

				<div class="funcionario_do_mes">
				
					<h2>Funcionário do mês</h2>
					<?php if ( $mes[0]['Usuarios']['foto_url'] != ""): ?>
						<img src="/<?php echo $mes[0]['Usuarios']['foto_url'] ?>"  />
				    <?php else: ?>
				    	<img src="/img/img_perfil.jpg" />	
				    <?php endif; ?>
				    <h2><?php echo $mes[0]['Usuarios']['nome']; ?></h2>
				    <p>
					<?php echo $mes[0]['Usuarios_me']['conteudo']; ?>
				    </p>
					<a class="bt_padrao" href="<?php echo '/ramais?dpto_aviso='.$mes[0]['Departamentos']['id'].'&func_aviso='.$mes[0]['Usuarios']['id'] ?>">Envie uma Mensagem</a>
				
				</div>

				<?php foreach($merito as $meritos): ?>

				<p style="border-bottom:1px solid #ccc; clear:both;"></p> 

				<div class="funcionario_do_mes">
				
					<h2>Mérito do funcionário</h2>
					<?php if ( $meritos['Usuarios']['foto_url'] != ""): ?>
						<img src="/<?php echo $meritos['Usuarios']['foto_url'] ?>"  />
				    <?php else: ?>
				    	<img src="/img/img_perfil.jpg" />	
				    <?php endif; ?>
				    <h2><?php echo $meritos['Usuarios']['nome']; ?></h2>
				    <p>
					<?php echo $meritos['Usuarios_merito']['conteudo']; ?>
				    </p>
				    	
				       <a class="bt_padrao" href="<?php echo '/ramais?dpto_aviso='.$meritos['Departamentos']['id'].'&func_aviso='.$meritos['Usuarios']['id'] ?>">Envie uma Mensagem</a>
				
				</div>

				<p style="border-bottom:1px solid #ccc; clear:both;"></p>
				<?php endforeach; ?>
			</div>
            
        </div>
        <!-- FINAL CONTEUDO -->
                
	</div>
    <!-- FINAL COLUNA D -->                

	<!-- INICIO COLUNA B -->
	<div id="colunaB" style="margin-right:0px;">
                
		<h1>REPORTE SEU PROBLEMA AO TI</h1>
                
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
                    
	    	<!-- INICIO FORM -->
	        <div class="formulario">
 
			<?php echo $this->Form->create('Aviso', array ('url' => array('controller' => 'interacao', 'action' => 'salvaAviso')));?>
			
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
                
        <h1 style="margin-top:20px;">UTILIDADES</h1>
		<!-- INICIO CONTEUDO -->
                    
		<style type="text/css">
		.utilidades		{ margin-right:30px;}
		.utilidades li a	{    color: #4D4D4F;
		    display: block;
		    margin: 5px 10px;
		    padding: 10px;}
		.utilidades li a:hover	{ background:#eee;}	
		
		</style>                    
                    
        <div class="conteudo">
            <ul class="utilidades">                    
					<?php foreach ($utilidades as $utilidades): ?>
				    	<?php echo '<li><a href="/utilidades/visualizar?tipos_utilidade_id='.$utilidades['Tipos_utilidade']['id'].'">'.$utilidades['Tipos_utilidade']['nome'].'</a></li>'; ?>
				    <?php endforeach; ?>     
            </ul>
        </div>
        <!-- FINAL CONTEUDO -->
                
	</div>
    <!-- FINAL COLUNA B -->                    

</div>
<!-- FINAL MEIO -->