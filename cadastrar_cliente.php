<?php
if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	
	require_once 'crud/Cliente.php';
		
	$cliente = new Cliente();
	$cliente->__set("nome", $nome);
	$cliente->__set("email", $email);
	$cliente->__set("telefone", $telefone);
	$response = $cliente->verificaRegistro();
	if($response->registros == 0){
		$registro = $cliente->insertCliente();
		if($registro > 0){
			echo 'true';
		}
	}else{
		echo 'false';
	}
}else{
	header("location: index.php");
}
?>