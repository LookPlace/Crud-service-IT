<?php
if(isset($_POST['id'])){
	$id = $_POST['id'];
	
	require_once 'crud/Pedido.php';
		
	$pedido = new Pedido();
	$pedido->__set("id", $id);
	$delete = $pedido->deletePedido();
	if($delete > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>