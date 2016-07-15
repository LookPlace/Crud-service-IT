<?php
if(isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone'])){
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	
	require_once 'crud/Cliente.php';
		
	$cliente = new Cliente();
	$cliente->__set("id", $id);
	$cliente->__set("nome", $nome);
	$cliente->__set("email", $email);
	$cliente->__set("telefone", $telefone);
	$update = $cliente->updateCliente();
	if($update > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>