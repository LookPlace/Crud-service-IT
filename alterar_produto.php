<?php
if(isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco'])){
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$preco = $_POST['preco'];
	
	require_once 'crud/Produto.php';
		
	$produto = new Produto();
	$produto->__set("id", $id);
	$produto->__set("nome", $nome);
	$produto->__set("descricao", $descricao);
	$produto->__set("preco", $preco);
	$update = $produto->updateProduto();
	if($update > 0){
		echo 'true';
	}
}else{
	header("location: index.php");
}
?>