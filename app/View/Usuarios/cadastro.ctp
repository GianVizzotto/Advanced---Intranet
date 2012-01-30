<?php echo $this->Html->script('cadastro');?>
<div id="meio">
	<div id="colunaB">
		<h1>Novo Usuário</h1> 
		<div class="conteudo">
			<div class="formulario">
			
 				<?php echo $this->Form->create('Usuario' ); ?>
 						
 					<?php if($id):?>
 						<?php echo $this->Form->input('id' , array ( 'type' => 'hidden' , 'value' => $id ) ) ;?>
 					<?php endif;?>		
                                
					<label for="Nome">
						Nome: <br />
						<?php echo $this->Form->input('nome' , array ( 'type' => 'text' , 'label' => false) ) ;?>
					</label>
					
					<label for="Email">
						E-mail: <br />                                           
						<?php echo $this->Form->input('email' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Senha">
						Senha: <br />                                           
						<?php echo $this->Form->input('senha' , array ( 'type' => 'password' , 'label' => false) ) ;?> 
					</label>
						
 						
					<label for="Departamento">
						Departamento: <br />                                           
						<?php echo $this->Form->input('departamento_id' , array ( 'options' => $departamentos , 'label' => false) ) ;?> 
					</label>    
				                    
					<label for="Ramal">
						Ramal: <br />                                           
						<?php echo $this->Form->input('ramal' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Data_Nascimento">
						Data de Nascimento: <br />                                           
						<?php echo $this->Form->input('data_nascimento' , array ( 'type' => 'text' , 'maxLenght' => '10' , 'label' => false) ) ;?> 
					</label>
					
					<label for="Perfil">
						Perfil: <br />                                           
						<?php echo $this->Form->input('perfil_id' , array ( 'options' => $perfis , 'label' => false) ) ;?> 
					</label>
					
					<label for="Foto">
						Foto: <br />                                           
						<?php echo $this->Form->input('foto_url' , array ( 'type' => 'text' , 'label' => false) ) ;?> 
					</label>
					                                                             
					<?php echo $this->Form->submit('Enviar' , array ( 'class' => 'btForm' ) ) ;?>
				
				<?php echo $this->Form->end();?>
                                
			</div>  
		</div>
	</div>
	
	<div id="colunaB">
		<h1>Últimos Usuários Cadastrados</h1> 
			
		<div class="conteudo">
			<table>
				<tr>
					<th>Nome</th>
					<th width="30%">Departamento</th>
					<th width="20%">Editar</th>
				</tr>			
			<?php foreach ($ultimos_cadastrados as $ultimo_cadastrado):?>
				<tr>
					<td><?php echo $ultimo_cadastrado['Usuario']['nome'];?></td>  
					<td align="center"><?php echo $ultimo_cadastrado['Departamento']['nome'];?></td>
					<td align="center"><a href="/usuarios/cadastro/<?php echo $ultimo_cadastrado['Usuario']['id'];?>"><img src="/img/edit_icon.png" /></a></td>
			<?php endforeach;?>
			</table>	
		</div>
	</div>
</div>