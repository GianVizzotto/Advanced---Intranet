<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe Utilidade</title>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<?php echo $this->Html->css('modal');?>

<?php echo $this->Html->script('jquery-1.4.2.min');?>

<?php echo $this->Html->script('accordion');?>




</head>

<body>

<div id="detalhe">

<h2>Título da Utilidade:</h2>
<h1><?php echo $utilidade_unico['Utilidade']['nome'];?></h1>

<h2>Detalhe:</h2>
<?php if ($utilidade_unico['Utilidade']['imagem'] != ""): ?>
<img src="/<?php echo $utilidade_unico['Utilidade']['imagem']; ?>" style="margin-left: 5px; margin-right: 5px; float: left; z-index: -1" />
<?php endif;?>
<?php echo $utilidade_unico['Utilidade']['conteudo'];?>

    <div style="height:30px;">
<!--    
        <div class="barra_de_botoes">
            <a href="#"><img src="assets/images/bt_avisos_arquivar.png" alt="" align="absmiddle" title="" /> Arquivar </a>
 
 
 
        
        </div>
-->    
 

</div>

</body>
</html>