<?php
if(isset($_POST['id'])){
	$id = $_POST['id'];
	
	require_once 'crud/Produto.php';
		
	$produto = new Produto();
	$produto->__set("id", $id);
	$delete = $produto->deleteProduto();
	if($delete > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>