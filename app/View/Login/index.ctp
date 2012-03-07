<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Advanced</title>
<link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
<?php echo $this->Html->css('estilo');?>
<?php echo $this->Html->css('thick_box');?>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<?php echo $this->Html->script('jquery-1.4.2.min');?>
<?php echo $this->Html->script('jquery.maskedinput-1.2.2.min');?>
<?php echo $this->Html->script('thick_box');?>
<?php echo $this->Html->script('jquery.jcarousel.min');?>
<?php echo $this->Html->script('accordion');?>
<?php //echo $this->Html->script('jquery.prettyPopin');?>
<?php echo $this->Html->script('jquery.pngFix');?>
<?php echo $this->Html->script('thick_box');?>
<title>Sistema - Advanced</title>
<style type="text/css">
#logo {
	float:left;
}
.login #colunaB {
	clear:both;
}
.login .centralizar {
	width:480px;
}
.login #corpo {
	padding-bottom:100px;
}
.login #geral {
	margin-top:50px;
}
.form_login {
	background:#fff;
	float:left;
	padding:20px;
	width:370px;
	margin-bottom:20px;
	font-size:14px;
}
input.campo_login {
	font-size:14px;
	font-weight:bold;
	color:#999;
	padding:5px;
	margin-bottom:10px;
	margin-left:20px;
}
</style>
</head>

<body class="login">

<!--INICIO GERAL -->
<div id="geral"> 
  
  <!-- INICIO CORPO -->
  <div id="corpo"> 
    
    <!-- INICIO CENTRALIZAR -->
    <div class="centralizar"> 
      
      <!-- INICIO MEIO -->
      <div id="meio">
        <div id="logo"> <img src="/img/logo_bege.png" /> </div>
        
        <!-- INICIO COLUNA B -->
        <div id="colunaB">
          <h1>ACESSO À INTRANET</h1>
          <div class="form_login">
          	<?php 
          		if (isset($mensagem_login)){echo $mensagem_login;}
          	?>
          	<?php
				echo $this->Form->create('Usuario');
				echo $this->Form->input('email', array('type'=>'text', 'class' => 'campo_login'));
				echo $this->Form->input('senha', array('type'=>'password', 'class' => 'campo_login'));
				
			?>
          </div>
          <?php 
          		echo $this->Form->submit('LOGIN', array('class' => 'bt_padrao', 'style' => 'width: 410px;')); 
          		echo $this->Form->end();
          ?>
          <!--<a href="#" class="bt_padrao">LOGIN</a>-->
		</div>
        <!-- FINAL COLUNA B --> 
        
      </div>
      <!-- FINAL MEIO --> 
      
    </div>
    <!-- FINAL CENTRALIZAR --> 
    
  </div>
  <!-- FINAL CORPO --> 
  
</div>
<!--FINAL GERAL -->
</body>
</html>

