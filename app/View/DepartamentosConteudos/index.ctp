<?php
	$this->Paginator->options(array('url' => array('controller' => 'DepartamentosConteudos', 'action' => 'index', '?' => array('titulo' => $this->params['url'][titulo], 'departamentos_id' => $this->params['url'][departamentos_id]) ) , 'paramType' => 'querystring'));
?>
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Departamentos_conteudo' , array ( 'type' => 'get' , 'action' => 'index' ) ) ;?>
					<label for="Nome">
						Título:<br />
						<?php echo $this->Form->input('titulo' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Departamento">
						Departamento:<br />
						<?php echo $this->Form->input('departamentos_id' , array ( 'options' => $departamentos , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>	
			</div>  
		</div>
	</div><br />
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMOS CONTEÚDOS DE DPTOS. CADASTRADOS<a style="float: right; text-decoration: none; color: white;" href="/departamentos_conteudos/add">CRIAR CONTEÚDO</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="100%">Título</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_dptos as $ultimos_dpto):?>
				<tr>
					<td align="center"><?php echo $ultimos_dpto['Departamentos_conteudo']['titulo'];?></td>  
					<td align="center"><a href="/departamentos_conteudos/add/<?php echo $ultimos_dpto['Departamentos_conteudo']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/departamentos_conteudos/remove/<?php echo $ultimos_dpto['Departamentos_conteudo']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
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