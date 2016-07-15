<?php
if(isset($_POST['id'])){
	$id = $_POST['id'];
	
	require_once 'crud/Cliente.php';
		
	$cliente = new Cliente();
	$cliente->__set("id", $id);
	$delete = $cliente->deleteCliente();
	if($delete > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>