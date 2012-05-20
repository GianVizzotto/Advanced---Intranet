<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
<?php echo $this->Html->css('estilo');?>
<?php echo $this->Html->css('jquery.fancybox-1.3.4');?>
<?php echo $this->Html->css('thick_box');?>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<?php echo $this->Html->script('jquery-1.4.2.min');?>
<?php echo $this->Html->script('jquery.maskedinput-1.2.2.min');?>
<?php echo $this->Html->script('thick_box');?>
<?php echo $this->Html->script('jquery.jcarousel.min');?>
<?php echo $this->Html->script('accordion');?>
<?php //echo $this->Html->script('jquery.prettyPopin');?>
<?php echo $this->Html->script('jquery.pngFix');?>
<?php echo $this->Html->script('jquery.fancybox-1.3.4');?>
<?php echo $this->Html->script('jquery.globals');?>
<?php echo $this->Html->script('thick_box');?>
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
							<a href="http://casapaulista.socciweb.com.br" target="_self"><img src="/img/logo_amarelo.png" /></a>
						</div>
						<!-- FINAL LOGO 1 -->
						                    
						<!-- INICIO LOGO 2 -->
						<div id="logo2">
							<a href="http://security.socciweb.com.br" target="_self"><img src="/img//logo_verde.png" /></a>
						</div>
						<!-- FINAL LOGO 2 -->
						
						<!-- INICIO LOGO 3 -->
						<div id="logo3">
							<a href="http://cambio.socciweb.com.br" target="_self"><img src="/img/logo_vermelho.png" /></a>
						</div>
						<!-- FINAL LOGO 3 -->    
						                    
						<!-- INICIO USUARIO -->
						<div id="usuario">
						
						<?php $usuario = $this->Session->read('Usuario');?>
						<?php if($usuario):?>
							Bem-vindo <strong> <?php echo $usuario['Usuario']['nome'];?> </strong><br />
							Setor: <strong><?php echo $usuario['Departamento']['nome'];?></strong><br />
							<strong><a href="/login/logoff">Sair</a></strong>
						<?php else : ?>
							<a href="/login"><b>Fazer login</b></a>
						<?php endif;?>		
						</div>
						<!-- FINAL USUARIO -->  
						                    
						<!-- INICIO MENU -->
						<?php //$menu = $this->Session->read('Menu');?>
						<div id="menu">
						    <ul>                    
							    <li><a href="/dashboard">HOME</a></li>
							    <?php foreach ($menudinamico as $lista_menu): ?>
							    <li><a href="/departamentos/visualizar/<?php echo $lista_menu['Departamento']['id']; ?>"><?php echo strtoupper($lista_menu['Departamento']['nome']); ?></a></li>
							    <?php endforeach; ?>
							    <li><a href="/interacao">INTERAÇÃO</a></li>
							</ul>               
						</div>
						<!-- FINAL MENU -->
						
					</div>
					<!-- FINAL TOPO_DIR -->
						                
						                
						                <!--INICIO BOTOES -->
					<div id="botoes">
						<a href="/dashboard"><img src="/img/bt_inicio.png" /></a>
						<a href="/usuarios/perfil"><img src="/img/bt_perfil.png" /></a>
						<a href="/avisos"><img src="/img/bt_avisos.png" /></a>
						<a href="/eventos/visualizar"><img src="/img/bt_eventos.png" /></a>
						<a href="/aniversariantes"><img src="/img/bt_aniversariantes.png" /></a>
						<a href="/ramais"><img src="/img/bt_ramais.png" /></a>
						<a href="/ajudas/visualizar"><img src="/img/bt_ajuda.png" /></a>
						<a href="/noticias/visualizar"><img src="/img/bt_noticias.png" /></a>
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
           
            
           
                 
