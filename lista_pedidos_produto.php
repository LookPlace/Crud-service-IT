<?php
if(isset($_POST['id_produto'])){
	$id_produto = $_POST['id_produto'];
	
	require_once 'crud/Pedido.php';
		
	$pedido = new Pedido();
	$pedido->__set("id_produto", $id_produto);
	if($id_produto != ''){
		$pedidos = $pedido->selectPedidosProduto();
	}else{
		$pedidos = $pedido->selectPedidos();
	}
	if($pedidos != null){
		$content = '';
		foreach($pedidos as $index=>$pedido){
			$content .= '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingPedido'.$index.'">
								<h4 class="panel-title">';
								if($index == 0){
									$content .= '<a role="button" data-toggle="collapse" data-parent="#accordion_pedido" href="#collapsePedido'.$index.'" aria-expanded="true" aria-controls="collapsePedido'.$index.'">';
								}else{
									$content .= '<a role="button" data-toggle="collapse" data-parent="#accordion_pedido" href="#collapsePedido'.$index.'" aria-expanded="false" aria-controls="collapsePedido'.$index.'">';
								}
							$content .= 'Pedido '.$index.'
						</a>
					</h4>
				</div>';
			if($index == 0){
				$content .= '<div id="collapsePedido'.$index.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingPedido'.$index.'">';
			}else{
				$content .= '<div id="collapsePedido'.$index.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPedido'.$index.'">';
			}
				$content .=	'<div class="panel-body">
								<p>'.$pedido->nome_cliente.' - '.$pedido->email.'</p>
								<p>'.$pedido->nome_produto.'</p>
								<p>'.$pedido->descricao.'</p>
								<button type="button" class="btn btn-warning btn-alterar-pedido" data-id="'.$pedido->id_pedido.'" data-id-cliente="'.$pedido->id_cliente.'" data-id-produto="'.$pedido->id_produto.'">Alterar</button>
								<button type="button" class="btn btn-danger btn-excluir-pedido" data-id="'.$pedido->id_pedido.'">Excluir</button>
							</div>
				</div>
			</div>';
		}
	}else{
		$content = '<div class="alert alert-warning" role="alert">Nenhum pedido cadastrado!</div>';
	}
	echo $content;
}else{
	header("location: index.php");
}
?>