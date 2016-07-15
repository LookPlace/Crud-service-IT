<?php
if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco'])){
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$preco = $_POST['preco'];
	
	require_once 'crud/Produto.php';
		
	$produto = new Produto();
	$produto->__set("nome", $nome);
	$produto->__set("descricao", $descricao);
	$produto->__set("preco", $preco);
	$response = $produto->verificaRegistro();
	if($response->registros == 0){
		$registro = $produto->insertProduto();
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