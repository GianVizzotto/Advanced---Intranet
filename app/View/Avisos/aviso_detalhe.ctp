<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe Aviso</title>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<?php echo $this->Html->css('modal');?>
<?php echo $this->Html->script('jquery-1.4.2.min') ;?>
<?php //echo $this->Html->script('accordion') ;?>
<?php echo $this->Html->script('avisos') ;?>
</head>

<body>

<div id="detalhe">

<h2>Título da Mensagem:</h2>
<h1><?php echo $aviso[0]['Aviso']['assunto'] ; ?></h1>

<h2>Remetente:</h2>
<p><?php echo $aviso[0]['Usuario']['nome'] ; ?></p>

<h2>Cargo:</h2>
<p><?php echo $aviso[0]['Cargo']['nome'] ; ?></p>

<h2>Setor:</h2>
<p><?php echo $aviso[0]['Departamento']['nome'] ; ?></p>

<h2>Enviado em:</h2>
<p><?php echo $this->Time->format( 'd/m/Y - H:i', $aviso[0]['Aviso']['data_criacao']) ; ?></p>

<h2>Anexo:</h2>
<p> <a href="#"><?php echo $aviso[0]['Aviso']['anexo'] ; ?></a></p>

<h2>Destinatários:</h2>
<p>
<?php foreach ($destinatarios as $destinatario):?>
	<?php echo $destinatario['Usuario']['nome'];?>
<?php endforeach;?>	
</p>

<h2>Corpo da Mensagem:</h2>

<p><?php echo $aviso[0]['Aviso']['mensagem'];?></p>

<div style="height:240px;">
<div class="barra_de_botoes">
<a href="#"><img src="/img/bt_avisos_arquivar.png" alt="" align="absmiddle" title="" /> Arquivar </a>

<a href="#"><img src="/img/bt_avisos_excluir.png" alt="" align="absmiddle" title="" /> Excluir </a>

<a href="#" class="accordionButton"><img src="/img/bt_avisos_responder.png" alt="" align="absmiddle" title="" /> Responder </a>
<div class="accordionContent responder">

<h2 style="margin-top:0px;">Responder a mensagem</h2>

<?php 
	echo $this->Form->create('AvisoResposta', array( 'id'=>'Resposta', 'onsubmit'=>'return gravaResposta();'));
	echo $this->Form->input('resposta', array('type'=>'textarea', 'label'=>false, 'div'=>false));
	echo $this->Form->submit('Enviar' , array('class' => 'btForm') ) ;               
	echo $this->Form->end();
?>

</div>

</div>
</div>



</body>
</html>