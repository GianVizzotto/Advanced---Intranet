<?php
	$this->Paginator->options(array('url' => array('controller' => 'ramais', 'action' => 'index', '?' => array('departamento' => $this->params['url'][departamento], 'func' => $this->params['url'][func]) ) , 'paramType' => 'querystring'));
?>
<!-- INICIO MEIO -->
<div id="meio">

	<!-- INICIO COLUNA D -->
	<div id="colunaD">
        
        <h1>RAMAIS</h1>
        
        	<!-- INICIO CONTEUDO -->
            <div class="conteudo">

                <!-- INICIO BARRA EXIBIR -->
            	<div id="barra_exibir">
                
                    <?php echo $this->Form->create('Ramais' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
                        Departamento: <br />
                        
                        <?php echo $this->Form->input('departamento' , array('options' => $select_departamento , 'label' => false , 'onchange' => 'mostraNomes(this.value, "ramais", "nomes")') ) ;?>
                        
                         <br /> <br />
                        Nome do Funcionário: <br />
                        <div class="exibir_nomes">
						<?php echo $select_nomes ;?>                           
                        </div>
						<?php echo $this->Form->submit('OK' , array ( 'class' => 'btForm' ) ) ;?>
  						<br /> <br />
					<?php echo $this->Form->end();?>
				
                </div>
                <!-- FINAL BARRA EXIBIR -->                
                
                <div class="clear">&nbsp;</div>
                <?php foreach ($ultimos_usuarios as $ultimos_usuario):?>
	                <p style="margin-left:20px;">
	                <?php echo $ultimos_usuario['Usuario']['nome'];?> - <?php echo $ultimos_usuario['Departamentos']['nome'];?> <br />
	                Ramal: <strong style="font-size:16px;"><?php echo $ultimos_usuario['Usuario']['ramal'];?></strong> <br />
	                Email: <strong style="font-size:12px;"><?php echo $ultimos_usuario['Usuario']['email'];?></strong></p>
	                <a href="#">Envie um aviso para <?php echo $ultimos_usuario['Usuario']['nome'];?>.</a>
				<?php endforeach; ?>

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
<script language="JavaScript">
	function mostraNomes(departamento_id, controller, action){
		
		$.ajax({
			url:'/'+controller+'/'+action+'/'+departamento_id,
			type:'GET',
			dataType:'html',
			beforeSend: function(){
				$('.exibir_nomes').html('Carregando...');
			},
			success: function(result){
				$('.exibir_nomes').html(result);
			}	
		});
		
	}
</script>