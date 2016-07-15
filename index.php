<?php
require_once 'crud/Cliente.php';
$cliente = new Cliente();
$clientes = $cliente->selectClientes();

require_once 'crud/Produto.php';
$produto = new Produto();
$produtos = $produto->selectProdutos();

require_once 'crud/Pedido.php';
$pedido = new Pedido();
$pedidos = $pedido->selectPedidos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Service IT</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<section class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">
						CRUD Service IT
					</a>
				</div>
			</div>
		</nav>

		<ul class="nav nav-tabs">
			<li class="active"><a  href="#1" data-toggle="tab">Clientes</a></li>
			<li><a href="#2" data-toggle="tab">Produtos</a></li>
			<li><a href="#3" data-toggle="tab">Pedidos</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="1">
				<button type="button" class="btn btn-primary pull-right margin-bottom btn-cadastrar" data-toggle="modal" data-target=".bs-modal-cadastro-cliente">Cadastrar cliente</button>
				<div class="clear"></div>
				<div class="alert alert-success hidden" role="alert"></div>
				<div class="alert alert-danger hidden" role="alert"></div>
				<div class="panel-group" id="accordion_cliente" role="tablist" aria-multiselectable="true">
			<?php
				if($clientes != null){
					foreach($clientes as $index=>$cliente){
			?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="<?php echo 'headingCliente'.$index;?>">
							<h4 class="panel-title">
							<?php if($index == 0){
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_cliente" href="#collapseCliente'.$index.'" aria-expanded="true" aria-controls="collapseCliente'.$index.'">';
							}else{
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_cliente" href="#collapseCliente'.$index.'" aria-expanded="false" aria-controls="collapseCliente'.$index.'">';
							}
									echo $cliente->nome; 
							?>
								</a>
							</h4>
						</div>
					<?php if($index == 0){
						echo '<div id="collapseCliente'.$index.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingCliente'.$index.'">';
					}else{
						echo '<div id="collapseCliente'.$index.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCliente'.$index.'">';
					}?>	
							<div class="panel-body">
								<p><b>Email:</b> <?php echo $cliente->email; ?></p>
								<p><b>Telefone:</b> <?php echo $cliente->telefone; ?></p>
								<button type="button" class="btn btn-warning btn-alterar-cliente" data-id="<?php echo $cliente->id; ?>" data-nome="<?php echo $cliente->nome; ?>" data-email="<?php echo $cliente->email; ?>" data-telefone="<?php echo $cliente->telefone; ?>">Alterar</button>
								<button type="button" class="btn btn-danger btn-excluir-cliente" data-id="<?php echo $cliente->id; ?>">Excluir</button>
							</div>
						</div>
					</div>
			<?php
					}
				}else{
					echo '<div class="alert alert-warning" role="alert">Nenhum cliente cadastrado!</div>';
				}
			?>
				</div>
				<div class="modal fade bs-modal-cadastro-cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-cadastro-cliente">
									<div class="form-group">
										<label for="clienteCadastrarNome">Nome</label>
										<input type="text" name="nome" class="form-control" id="clienteCadastrarNome" placeholder="Nome" required>
									</div>
									<div class="form-group">
										<label for="clienteCadastrarEmail">Email</label>
										<input type="email" name="email" class="form-control" id="clienteCadastrarEmail" placeholder="Email" required>
									</div>
									<div class="form-group">
										<label for="clienteCadastrarTelefone">Telefone</label>
										<input type="tel" name="telefone" class="form-control" id="clienteCadastrarTelefone" placeholder="Telefone" required>
									</div>
									<button type="submit" class="btn btn-info btn-cadastrar-cliente">Cadastrar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-alterar-cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-alterar-cliente">
									<div class="form-group">
										<label for="clienteAlterarNome">Nome</label>
										<input type="text" name="nome" class="form-control" id="clienteAlterarNome" placeholder="Nome" required>
									</div>
									<div class="form-group">
										<label for="clienteAlterarEmail">Email</label>
										<input type="email" name="email" class="form-control" id="clienteAlterarEmail" placeholder="Email" required>
									</div>
									<div class="form-group">
										<label for="clienteAlterarTelefone">Telefone</label>
										<input type="tel" name="telefone" class="form-control" id="clienteAlterarTelefone" placeholder="Telefone" required>
									</div>
									<input type="hidden" name="id" id="clienteAlterarId">
									<button type="submit" class="btn btn-info">Alterar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-excluir-cliente" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Confirme</h4>
							</div>
							<div class="modal-body">
								<p>Deseja realmente excluir este cadastro?</p>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-info btn-modal-excluir-cliente pull-left">Excluir</button>
								<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="2">
				<button type="button" class="btn btn-primary pull-right margin-bottom btn-cadastrar" data-toggle="modal" data-target=".bs-modal-cadastro-produto">Cadastrar produto</button>
				<div class="clear"></div>
				<div class="alert alert-success hidden" role="alert"></div>
				<div class="alert alert-danger hidden" role="alert"></div>
				<div class="panel-group" id="accordion_produto" role="tablist" aria-multiselectable="true">
			<?php
				if($produtos != null){
					foreach($produtos as $index=>$produto){
			?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="<?php echo 'headingProduto'.$index;?>">
							<h4 class="panel-title">
							<?php if($index == 0){
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_produto" href="#collapseProduto'.$index.'" aria-expanded="true" aria-controls="collapseProduto'.$index.'">';
							}else{
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_produto" href="#collapseProduto'.$index.'" aria-expanded="false" aria-controls="collapseProduto'.$index.'">';
							}
									echo $produto->nome; 
							?>
								</a>
							</h4>
						</div>
					<?php if($index == 0){
						echo '<div id="collapseProduto'.$index.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingProduto'.$index.'">';
					}else{
						echo '<div id="collapseProduto'.$index.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingProduto'.$index.'">';
					}?>	
							<div class="panel-body">
								<p><?php echo $produto->descricao; ?></p>
								<p><b>Preço:</b> <?php echo $produto->preco; ?></p>
								<button type="button" class="btn btn-warning btn-alterar-produto" data-id="<?php echo $produto->id; ?>" data-nome="<?php echo $produto->nome; ?>" data-descricao="<?php echo $produto->descricao; ?>" data-preco="<?php echo $produto->preco; ?>">Alterar</button>
								<button type="button" class="btn btn-danger btn-excluir-produto" data-id="<?php echo $produto->id; ?>">Excluir</button>
							</div>
						</div>
					</div>
			<?php
					}
				}else{
					echo '<div class="alert alert-warning" role="alert">Nenhum produto cadastrado!</div>';
				}
			?>
				</div>
				<div class="modal fade bs-modal-cadastro-produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-cadastro-produto">
									<div class="form-group">
										<label for="produtoCadastrarNome">Nome</label>
										<input type="text" name="nome" class="form-control" id="produtoCadastrarNome" placeholder="Nome" required>
									</div>
									<div class="form-group">
										<label for="produtoCadastrarDescricao">Descrição</label>
										<textarea class="form-control" rows="3" name="descricao" id="produtoCadastrarDescricao" placeholder="Descrição" required></textarea>
									</div>
									<div class="form-group">
										<label for="produtoCadastrarPreco">Preço</label>
										<input type="number" name="preco" class="form-control" id="produtoCadastrarPreco" placeholder="Preço" required>
									</div>
									<button type="submit" class="btn btn-info">Cadastrar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-alterar-produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-alterar-produto">
									<div class="form-group">
										<label for="produtoAlterarNome">Nome</label>
										<input type="text" name="nome" class="form-control" id="produtoAlterarNome" placeholder="Nome" required>
									</div>
									<div class="form-group">
										<label for="produtoAlterarDescricao">Descrição</label>
										<textarea class="form-control" rows="3" name="descricao" id="produtoAlterarDescricao" placeholder="Descrição" required></textarea>
									</div>
									<div class="form-group">
										<label for="produtoAlterarpreco">Preço</label>
										<input type="tel" name="preco" class="form-control" id="produtoAlterarPreco" placeholder="Preço" required>
									</div>
									<input type="hidden" name="id" id="produtoAlterarId">
									<button type="submit" class="btn btn-info">Alterar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-excluir-produto" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Confirme</h4>
							</div>
							<div class="modal-body">
								<p>Deseja realmente excluir este produto?</p>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-info pull-left btn-modal-excluir-produto">Excluir</button>
								<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="3">
				<button type="button" class="btn btn-primary pull-right margin-bottom btn-cadastrar" data-toggle="modal" data-target=".bs-modal-cadastro-pedido">Cadastrar pedido</button>
				<div class="clear"></div>
				<div class="alert alert-success hidden" role="alert"></div>
				<div class="alert alert-danger hidden" role="alert"></div>
				<h3>Pelo o que deseja consultar os pedidos?</h3>
				<p>escolha realizar a listagem de pedidos por cliente ou por produto, marcando seu respectivo radio box.</p>
				<div class="row">
					<div class="col-lg-6">
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="busca" class="search" checked>
							</span>
							<select class="form-control form-search cliente">
								<option value="">Todos os clientes</option>
						<?php
							if($clientes != null){
								foreach($clientes as $cliente){
									echo '<option value="'.$cliente->id.'">'.$cliente->nome.'</option>';
								}
							}
						?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="busca" class="search">
							</span>
							<select class="form-control form-search produto" disabled>
								<option value="">Todos os produtos</option>
						<?php
							if($produtos != null){
								foreach($produtos as $produto){
									echo '<option value="'.$produto->id.'">'.$produto->nome.'</option>';
								}
							}
						?>
							</select>
						</div>
					</div>
				</div>
				<div class="content-pedidos">
					<div class="panel-group" id="accordion_pedido" role="tablist" aria-multiselectable="true">
			<?php
				if($pedidos != null){
					foreach($pedidos as $index=>$pedido){
			?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="<?php echo 'headingPedido'.$index;?>">
							<h4 class="panel-title">
							<?php if($index == 0){
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_pedido" href="#collapsePedido'.$index.'" aria-expanded="true" aria-controls="collapsePedido'.$index.'">';
							}else{
								echo '<a role="button" data-toggle="collapse" data-parent="#accordion_pedido" href="#collapsePedido'.$index.'" aria-expanded="false" aria-controls="collapsePedido'.$index.'">';
							}
									echo 'Pedido '.$index; 
							?>
								</a>
							</h4>
						</div>
					<?php if($index == 0){
						echo '<div id="collapsePedido'.$index.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingPedido'.$index.'">';
					}else{
						echo '<div id="collapsePedido'.$index.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPedido'.$index.'">';
					}?>	
							<div class="panel-body">
								<p><?php echo $pedido->nome_cliente.' - '.$pedido->email; ?></p>
								<p><?php echo $pedido->nome_produto; ?></p>
								<p><?php echo $pedido->descricao; ?></p>
								<button type="button" class="btn btn-warning btn-alterar-pedido" data-id="<?php echo $pedido->id_pedido; ?>" data-id-cliente="<?php echo $pedido->id_cliente; ?>" data-id-produto="<?php echo $pedido->id_produto; ?>">Alterar</button>
								<button type="button" class="btn btn-danger btn-excluir-pedido" data-id="<?php echo $pedido->id_pedido; ?>">Excluir</button>
							</div>
						</div>
					</div>
			<?php
					}
				}else{
					echo '<div class="alert alert-warning" role="alert">Nenhum pedido cadastrado!</div>';
				}
			?>
				</div>
				<div class="modal fade bs-modal-cadastro-pedido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-cadastro-pedido">
									<label>Cliente</label>
									<select class="form-control" name="id_cliente" required>
										<option value="">Escolha o cliente</option>
								<?php
									if($clientes != null){
										foreach($clientes as $cliente){
											echo '<option value="'.$cliente->id.'">'.$cliente->nome.'</option>';
										}
									}
								?>
									</select>
									<label>Produto</label>
									<select class="form-control" name="id_produto" required>
										<option value="">Escolha o produto</option>
								<?php
									if($produtos != null){
										foreach($produtos as $produto){
											echo '<option value="'.$produto->id.'">'.$produto->nome.'</option>';
										}
									}
								?>
									</select>
									<button type="submit" class="btn btn-info btn-cadastrar-pedido">Cadastrar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-alterar-pedido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="well">
								<form method="post" action="" id="form-alterar-pedido">
									<label>Cliente</label>
									<select name="id_cliente" class="form-control cliente" required>
										<option value="">Escolha o cliente</option>
								<?php
									if($clientes != null){
										foreach($clientes as $cliente){
											echo '<option value="'.$cliente->id.'">'.$cliente->nome.'</option>';
										}
									}
								?>
									</select>
									<label>Produto</label>
									<select name="id_produto" class="form-control produto" required>
										<option value="">Escolha o produto</option>
								<?php
									if($produtos != null){
										foreach($produtos as $produto){
											echo '<option value="'.$produto->id.'">'.$produto->nome.'</option>';
										}
									}
								?>
									</select>
									<input type="hidden" name="id" id="pedidoAlterarId">
									<button type="submit" class="btn btn-info">Alterar</button>
									<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
									<div class="clear"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade bs-modal-excluir-pedido" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Confirme</h4>
							</div>
							<div class="modal-body">
								<p>Deseja realmente excluir este pedido?</p>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-info btn-modal-excluir-pedido pull-left">Excluir</button>
								<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.maskedinput.js"></script>
	<script src="js/script_cliente.js"></script>
	<script src="js/script_produto.js"></script>
	<script src="js/script_pedido.js"></script>
</body>
</html>