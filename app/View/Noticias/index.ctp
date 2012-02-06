<div id="meio">
	<div id="colunaE" style=" width: 950px;">
		<h1>ÚLTIMAS NOTÍCIAS CADASTRADAS<a style="float: right; text-decoration: none; color: white;" href="/noticias/add">CRIAR NOTÍCIA</a></h1> 
			
		<div class="conteudo" style=" width: 910px;">
			<table bordercolor="#B8B5B5" border="1">
				<tr>
					<th width="60%">Nome</th>
					<th width="30%">Tipo</th>
					<th width="20%">Editar</th>
					<th width="20%">Excluir</th>
				</tr>			
			<?php foreach ($ultimos_noticias as $ultimos_noticia):?>
				<tr>
					<td align="center"><?php echo $ultimos_noticia['Noticia']['nome'];?></td>  
					<td align="center"><?php echo $ultimos_noticia['Tipos_conteudos']['nome'];?></td>
					<td align="center"><a href="/noticias/add/<?php echo $ultimos_noticia['Noticia']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
					<td align="center"><a href="/noticias/remove/<?php echo $ultimos_noticia['Noticia']['id'];?>"><img src="/img/delete_icon.png" /></a></td>
			<?php endforeach;?>
			</table>	
		</div>
	</div>
</div>