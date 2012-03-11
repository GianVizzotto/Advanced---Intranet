<?php
	$this->Paginator->options(array('url' => array('controller' => 'ajudas', 'action' => 'index', '?' => array('nome' => $this->params['url'][nome], 'tipos_ajuda_id' => $this->params['url'][tipos_ajuda_id]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Ajudas' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
					<label for="Nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Tipo">
						Tipo:<br />
						<?php echo $this->Form->input('tipos_ajuda_id' , array ( 'options' => $Tipos_ajudas , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>	
			</div>  
		</div>
	</div><br />
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMAS AJUDAS CADASTRADAS<a style="float: right; text-decoration: none; color: white;" href="/ajudas/add">CRIAR AJUDA <img src="/img/add_3.png" width="20px" align="Absmiddle" /></a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="60%">Nome</th>
					<th width="30%">Tipo</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_ajudas as $ultimos_ajuda):?>
				<tr>
					<td align="center"><?php echo $ultimos_ajuda['Ajuda']['nome'];?></td>  
					<td align="center"><?php echo $ultimos_ajuda['Tipos_ajudas']['nome'];?></td>
					<td align="center"><a href="/ajudas/add/<?php echo $ultimos_ajuda['Ajuda']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/ajudas/remove/<?php echo $ultimos_ajuda['Ajuda']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
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