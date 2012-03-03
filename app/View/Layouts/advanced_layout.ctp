<html>

<head>
<link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
<?php echo $this->Html->css('estilo');?>
<?php echo $this->Html->css('jquery.fancybox-1.3.4/jquery.fancybox-1.3.4.css'); ?>
<?php echo $this->Html->css('prettyPopin');?>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<?php echo $this->Html->script('jquery-1.4.2.min');?>
<?php echo $this->Html->script('jquery.maskedinput-1.2.2.min');?>
<?php echo $this->Html->script('jquery.jcarousel.min');?>
<?php echo $this->Html->script('accordion');?>
<?php echo $this->Html->script('jquery.prettyPopin');?>
<?php echo $this->Html->script('jquery.pngFix');?>
<?php echo $this->Html->script('jquery.fancybox-1.3.4');?>
<?php echo $this->Html->script('jquery.globals');?>
<title>Sistema - Advanced</title>
</head>

<body class="bege">
	<!--INICIO GERAL -->
	<div id="geral">
		<!-- INICIO CORPO -->
		<div id="corpo">

        	<!-- INICIO CENTRALIZAR -->
        	<div class="centralizar">   
				<div id="topo">
				
					<!-- INICIO LOGO -->
					<div id="logo">
						<img src="/img/logo_bege.png" title="Advanced Group" />
					</div>
					<!-- FINAL LOGO -->
					                
					<!-- INICIO TOPO_DIR -->
					<div id="topo_dir">
					                
						<!-- INICIO LOGO 1 -->
						<div id="logo1">
							<img src="/img/logo_amarelo.png" />
						</div>
						<!-- FINAL LOGO 1 -->
						                    
						<!-- INICIO LOGO 2 -->
						<div id="logo2">
							<img src="/img//logo_verde.png" />
						</div>
						<!-- FINAL LOGO 2 -->
						
						<!-- INICIO LOGO 3 -->
						<div id="logo3">
							<img src="/img/logo_vermelho.png" />
						</div>
						<!-- FINAL LOGO 3 -->    
						                    
						<!-- INICIO USUARIO -->
						<div id="usuario">
						
						<?php $usuario = $this->Session->read('Usuario');?>
							Bem-vindo <strong> <?php echo $usuario['Usuario']['nome'];?> </strong><br />
							Setor: <strong><?php echo $usuario['Departamento']['nome'];?></strong><br />
							<strong><a href="/login/logoff">Sair</a></strong>
						</div>
						<!-- FINAL USUARIO -->  
						                    
						<!-- INICIO MENU -->
						<div id="menu">
						    <ul>                    
							    <li><a href="#">HOME</a></li>
							    <li><a href="#">LINKS</a></li>
							    <li><a href="#">DIRETORIA</a></li>
							    <li><a href="#">ADM/RH</a></li>
							    <li><a href="#">TI</a></li>
							    <li><a href="#">INTERAÇÃO</a></li>
							</ul>               
						</div>
						<!-- FINAL MENU -->
						
					</div>
					<!-- FINAL TOPO_DIR -->
						                
						                
						                <!--INICIO BOTOES -->
					<div id="botoes">
						<a href="/dashboard"><img src="/img/bt_inicio.jpg" /></a>
						<a href="/usuarios/perfil"><img src="/img/bt_perfil.jpg" /></a>
						<a href="/avisos"><img src="/img/bt_avisos.jpg" /></a>
						<a href="/eventos/visualizar"><img src="/img/bt_eventos.jpg" /></a>
						<a href="/aniversariantes"><img src="/img/bt_aniversariantes.jpg" /></a>
						<a href="/ramais"><img src="/img/bt_ramais.jpg" /></a>
						<a href="#"><img src="/img/bt_ajuda.jpg" /></a>
						<a href="/noticias/visualizar"><img src="/img/bt_noticias.jpg" /></a>
					</div>
					<!-- FINAL BOTOES -->
				
				</div>
		<?php
			echo $this->Session->flash();
		?>
<?php echo $content_for_layout ;?>

        	</div>
      		<!-- FINAL CENTRALIZAR -->

<?php include 'rodape_layout.ctp';?>
	    </div>
	    <!-- FINAL CORPO --> 
    
	</div>
	<!--FINAL GERAL -->
</body>
</html>	            
           
            
           
                 