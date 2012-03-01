<script type="text/javascript">

$(document).ready(function(){

	$(".avisoDetalhe").click(function(){
		alert("Ola");
	});	
	
	
});
//
</script>

<?php if ($avisos) : ?>
<div>
	<?php foreach ($avisos as $aviso) :?> 									
		<a href="/avisos/aviso_detalhe?id=<?php echo  $aviso['Aviso']['id'] ; ?>" rel="prettyPopin">
			<?php
				 $data = explode(" ", $aviso['Aviso']['data_criacao'] ) ; 
				 $data_dia = explode("-", $data[0]);				 
			?>
			<span><?php echo $data_dia[2]."/".$data_dia[1]."/".$data_dia[0]." - ".$data[1] ; ?> - <?php echo $aviso['Usuario']['nome'] ; ?> | <?php echo $aviso['Departamento']['nome'] ;?></span>
			<span class="title"><?php echo $aviso['Aviso']['assunto'] ; ?></span>	 
		</a>
	<?php endforeach ;?>    
</div>
<?php endif; ?>
