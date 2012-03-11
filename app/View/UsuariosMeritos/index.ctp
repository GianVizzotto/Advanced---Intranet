<?php
	$this->Paginator->options(array('url' => array('controller' => 'UsuariosMeritos', 'action' => 'index', '?' => array('nome' => $this->params['url'][nome]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>MÉRITOS DO FUNCIONÁRIO</h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="100%">Nome</th>
					<th width="20%">Editar</th>
				</tr>			
			<?php foreach ($ultimos_usuarios as $ultimos_usuario):?>
				<tr>
					<td align="center"><?php echo $ultimos_usuario['Usuarios']['nome'];?></td>  
					<td align="center"><a href="/usuarios_meritos/add/<?php echo $ultimos_usuario['Usuarios_merito']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
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