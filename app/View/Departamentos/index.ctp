<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMOS DEPARTAMENTOS CADASTRADOS<a style="float: right; text-decoration: none; color: white;" href="/departamentos/add">CRIAR DEPARTAMENTO</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="60%">Nome</th>
					<th width="30%">Descrição</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_departamentos as $ultimos_departamento):?>
				<tr>
					<td align="center"><?php echo $ultimos_departamento['Departamento']['nome'];?></td>  
					<td align="center"><?php echo $ultimos_departamento['Departamento']['descricao'];?></td>
					<td align="center"><a href="/departamentos/add/<?php echo $ultimos_departamento['Departamento']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/departamentos/remove/<?php echo $ultimos_departamento['Departamento']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
			<?php endforeach;?>
			</table>	
		</div>
	</div>
</div>