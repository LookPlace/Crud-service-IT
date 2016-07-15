<?php
if(isset($_POST['id_cliente']) && isset($_POST['id_produto'])){
	$id_cliente = $_POST['id_cliente'];
	$id_produto = $_POST['id_produto'];
	
	require_once 'crud/Pedido.php';
		
	$pedido = new Pedido();
	$pedido->__set("id_cliente", $id_cliente);
	$pedido->__set("id_produto", $id_produto);
	$registro = $pedido->insertPedido();
	if($registro > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>