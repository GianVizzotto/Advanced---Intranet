<?php
echo $this->Html->script('cadastro');

$this->Paginator->options(array('url' => array('controller' => 'usuarios', 'action' => 'listar', '?' => array('nome' => $this->params['url'][nome] , 'email' => $this->params['url']['email'] , 'departamento_id' => $this->params['url']['departamento_id'] , 'status_usuario_id' => $this->params['url']['status_usuario_id']) ) , 'paramType' => 'querystring'));

?>
	
<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>Filtros</h1> 
		<div class="conteudo" style=" width: 910px;margin-bottom:20px;">
			<div class="formulario">
				<?php echo $this->Form->create('Usuarios' , array ( 'type' => 'get' , 'action' => 'listar' ) ) ;?>
					<label for="Nome">
						Nome:<br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Email">
						E-mail:<br />
						<?php echo $this->Form->input('email' , array ( 'type' => 'text' , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Departamento">
						Departamento:<br />
						<?php echo $this->Form->input('departamento_id' , array ( 'options' => $departamentos , 'label' => false , 'div' => false ) ) ;?>
					</label>
					<label for="Status">
						Status:<br />
						<?php echo $this->Form->input('status_usuario_id' , array ( 'options'=>$status , 'label' => false , 'div' => false ) ) ;?>
					</label><br />
					<?php echo $this->Form->submit('Pesquisar' , array ( 'class' => 'btForm' ) ) ;?>
				<?php echo $this->Form->end();?>	
			</div>  
		</div>
	</div><br />
	
	<div id="colunaE" style=" width: 950px;">
		<h1>LISTAGEM DE USUÁRIOS<a style="float: right; text-decoration: none; color: white;" href="/usuarios/cadastro">CRIAR USUÁRIO</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<?php if(!empty($usuarios)):?>	
				<table width="100%">
					<tr>
						<th width="35%" style="text-align:left;">Nome</th>
						<th width="30%" style="text-align:left;">Email</th>
						<th width="15%" style="text-align:left;">Dpto.</th>
						<th width="10%" style="text-align:left;">Status</th>
						<th width="10%">Editar</th>
						<th width="10%">Excluir</th>
					</tr>		
					
				<?php foreach ($usuarios as $usuario):?>
					<tr>
						<td><?php echo $usuario['Usuario']['nome'];?></td>
						<td><?php echo $usuario['Usuario']['email'];?></td>  
						<td><?php echo $usuario['Departamento']['nome'];?></td>
						<td><?php echo $usuario['Status']['nome'];?></td>
						<td align="center"><a href="/usuarios/cadastro/<?php echo $usuario['Usuario']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
						<td align="center"><a href="/usuarios/excluir/<?php echo $usuario['Usuario']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
				<?php endforeach;?>
				</table><br />
				<div class="paginacao" style="text-align:center;">
					<span><?php echo $this->Paginator->first('Primeira'); ?></span>	
					<span><?php echo $this->Paginator->numbers(); ?></span>
					<span><?php echo $this->Paginator->last('Última');	?></span>
				</div>
			<?php else:?>
				<div>Sua pesquisa não retornou nenhum registro.</div>
			<?php endif;?>
		</div>
	</div>
</div>