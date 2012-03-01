<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA D -->
    <div id="colunaD">
    
    <h1>ANIVERSARIANTES</h1>
    
    	<!-- INICIO CONTEUDO -->
        <div class="conteudo">
                        
			<p style="margin-left:20px; margin-top:10px;">Clique no aniversariante para mandar um recado para ele!</p>
			
			<?php foreach ($ultimos_usuarios as $ultimos_usuario):?>
	            <a href="#">
	                <span><?php echo $ultimos_usuario['Usuario']['data_nascimento'];?> - <?php echo $ultimos_usuario['Usuario']['nome'];?> </span>
	                <SPAN><?php echo $ultimos_usuario['Cargos']['nome'];?> - <?php echo $ultimos_usuario['Departamentos']['nome'];?></SPAN>
	            </a>
            <?php endforeach;?>

		</div>
        <!-- FINAL CONTEUDO -->
	</div>
    <!-- FINAL COLUNA D -->                
		<div class="clear">&nbsp;</div>
    	<div class="paginacao" style="text-align:left;">
			<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
			<span><?php echo $this->Paginator->numbers(); ?></span>
			<span><?php echo $this->Paginator->last('Última');	?></span>
		</div>

	<!-- INICIO COLUNA B -->
	<?php //include "lib/includes/novo_aviso.php"; ?>	
    <!-- FINAL COLUNA B -->                    

</div>
<!-- FINAL MEIO -->