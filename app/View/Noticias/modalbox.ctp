<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe Notícia</title>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href="../../assets/css/modal.css" type="text/css" rel="stylesheet"  />

<script src="../../assets/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/accordion.js"></script>




</head>

<body>

<div id="detalhe">

<h2>Título da Notícia:</h2>
<h1><?php echo $noticia_unico['Noticia']['nome'];?></h1>

<h2>Fonte:</h2>
<p><a href="<?php echo $noticia_unico['Noticia']['fonte'];?>" target="_blank"><?php echo $noticia_unico['Noticia']['fonte'];?></a></p>

<h2>Enviado em:</h2>
<p> <?php echo $noticia_unico['Noticia']['data_criacao'];?></p>



<h2>Detalhe:</h2>
<?php if ($noticia_unico['Noticia']['imagem'] != ""): ?>
<img src="/<?php echo $noticia_unico['Noticia']['imagem']; ?>" style="margin-left: 5px; margin-right: 5px; float: left; z-index: -1" />
<?php endif;?>
<?php echo $noticia_unico['Noticia']['conteudo'];?>

    <div style="height:30px;">
<!--    
        <div class="barra_de_botoes">
            <a href="#"><img src="assets/images/bt_avisos_arquivar.png" alt="" align="absmiddle" title="" /> Arquivar </a>
 
 
 
        
        </div>
-->    
 

</div>

</body>
</html>