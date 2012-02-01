<?php echo $this->Html->script('cadastro');?>
<div id="meio">
	<div id="colunaB">
		<h1>Filtros</h1> 
		<div class="conteudo">
			<div class="formulario">
				<?php echo $this->Form->create('Filtros' , array ( 'options' => array ( 'action' => 'listar' , 'controller' => 'usuarios' , 'method' => 'get' ) ) ) ;?>
					<label for="nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
				<?php echo $this->Form->end('Pesquisar');?>	
			</div>  
		</div>
	</div><br />
	
	<div id="colunaB">
			
		<div class="conteudo">
			
		</div>
	</div>
</div>