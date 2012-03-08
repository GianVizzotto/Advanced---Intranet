<?php
	$this->Paginator->options(array('url' => array('controller' => 'cargos', 'action' => 'index', '?' => array('nome' => $this->params['url'][nome], 'departamento_id' => $this->params['url'][departamento_id]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Cargos' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
					<label for="Nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Departamento">
						Departamento:<br />
						<?php echo $this->Form->input('departamento_id' , array ( 'options' => $departamentos , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>
			</div>  
		</div>
	</div><br />
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMOS CARGOS CADASTRADOS<a style="float: right; text-decoration: none; color: white;" href="/cargos/add">CRIAR CARGO</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="60%">Nome</th>
					<th width="30%">Departamento</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($cargos as $cargo):?>
				<tr>
					<td align="center"><?php echo $cargo['Cargo']['nome'];?></td>  
					<td align="center"><?php echo $cargo['Departamento']['nome'];?></td>
					<td align="center"><a href="/cargos/add/<?php echo $cargo['Cargo']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/cargos/remove/<?php echo $cargo['Cargo']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
			<?php endforeach;?>
			</table>
			<div class="paginacao" style="text-align:center;">
				<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
				<span><?php echo $this->Paginator->numbers(); ?></span>
				<span><?php echo $this->Paginator->last('Última');	?></span>
			</div>
		</div>
	</div>
</div>