<?php
	$this->Paginator->options(array('url' => array('controller' => 'TiposUtilidades', 'action' => 'index', '?' => array('nome' => $this->params['url'][nome]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Tipos_utilidade' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
					<label for="Nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>	
			</div>  
		</div>
	</div><br />
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMAS CATEGORIAS DE UTILIDADES CADASTRADAS<a style="float: right; text-decoration: none; color: white;" href="/tipos_utilidades/add">CRIAR CATEGORIA <img src="/img/add_3.png" width="20px" align="Absmiddle" /></a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="100%">Nome</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_tipos as $ultimos_tipo):?>
				<tr>
					<td align="center"><?php echo $ultimos_tipo['Tipos_utilidade']['nome'];?></td>  
					<td align="center"><a href="/tipos_utilidades/add/<?php echo $ultimos_tipo['Tipos_utilidade']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/tipos_utilidades/remove/<?php echo $ultimos_tipo['Tipos_utilidade']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
				</tr>
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