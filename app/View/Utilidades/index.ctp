<?php
	$this->Paginator->options(array('url' => array('controller' => 'utilidades', 'action' => 'index', '?' => array('nome' => $this->params['url'][nome], 'tipos_utilidade_id' => $this->params['url'][tipos_utilidade_id]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Utilidades' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
					<label for="Nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Tipo">
						Tipo:<br />
						<?php echo $this->Form->input('tipos_utilidade_id' , array ( 'options' => $Tipos_utilidades , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>	
			</div>  
		</div>
	</div><br />
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMAS UTILIDADES CADASTRADAS<a style="float: right; text-decoration: none; color: white;" href="/utilidades/add">CRIAR UTILIDADE</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="60%">Nome</th>
					<th width="30%">Tipo</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_utilidades as $ultimos_utilidade):?>
				<tr>
					<td align="center"><?php echo $ultimos_utilidade['Utilidade']['nome'];?></td>  
					<td align="center"><?php echo $ultimos_utilidade['Tipos_utilidades']['nome'];?></td>
					<td align="center"><a href="/utilidades/add/<?php echo $ultimos_utilidade['Utilidade']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/utilidades/remove/<?php echo $ultimos_utilidade['Utilidade']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
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