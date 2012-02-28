<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe Evento</title>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href="../../assets/css/modal.css" type="text/css" rel="stylesheet"  />

<script src="../../assets/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/accordion.js"></script>




</head>

<body>

<div id="detalhe">

<h2>Título do Evento:</h2>
<h1><?php echo $evento_unico['Evento']['nome'];?></h1>
 

<h2>Enviado em:</h2>
<p> <?php echo $evento_unico['Evento']['data_criacao'];?></p>



<h2>Detalhe:</h2>
<?php if ($evento_unico['Evento']['imagem'] != ""): ?>
<img src="/<?php echo $evento_unico['Evento']['imagem']; ?>" style="margin-left: 10px; margin-right: 10px; float: left;" />
<?php endif;?>

<?php echo $evento_unico['Evento']['conteudo'];?>

    <div style="height:30px;">
<!--    
        <div class="barra_de_botoes">
            <a href="#"><img src="assets/images/bt_avisos_arquivar.png" alt="" align="absmiddle" title="" /> Arquivar </a>
 
 
 
        
        </div>
-->    
 

</div>

</body>
</html>