<?php

require_once 'Database.php';

class Pedido{
	
	protected $table = 'Pedido';
	private $id;
	private $id_produto;
	private $id_cliente;
	
	public function __construct(){
			
	}
	
	public function __get($propriedade){
		switch ($propriedade){
			case "id":
				return ($this->id);
				break;
			case "id_cliente":
				return ($this->id_cliente);
				break;
			case "id_produto":
				return ($this->id_produto);
				break;
		}
	}
	
	public function __set($propriedade, $valor){
		switch($propriedade){
			case "id":
				$this->id = $valor;
				break;
			case "id_cliente":
				$this->id_cliente = $valor;
				break;
			case "id_produto":
				$this->id_produto = $valor;
				break;
		}
	}

	public function insertPedido(){
		$sql  = "INSERT INTO $this->table (id_cliente, id_produto) VALUES (:id_cliente, :id_produto)";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':id_produto', $this->id_produto);
		return $stmt->execute(); 
	}
	
	public function selectPedido(){
		$sql  = "SELECT Pedido.id as id_pedido, Cliente.id as id_cliente, Cliente.nome as nome_cliente, Cliente.email, Produto.id as id_produto, Produto.nome as nome_produto, Produto.descricao, Produto.preco FROM $this->table as Pedido INNER JOIN Cliente ON Pedido.id_cliente = Cliente.id INNER JOIN Produto ON Pedido.id_produto = Produto.id WHERE Pedido.id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(); 
	}
	
	public function selectPedidos(){
		$sql  = "SELECT pe.id as id_pedido, cli.id as id_cliente, cli.nome as nome_cliente, cli.email, prod.id as id_produto, prod.nome as nome_produto, prod.descricao, prod.preco FROM $this->table as pe INNER JOIN Cliente as cli ON (pe.id_cliente = cli.id) INNER JOIN Produto as prod ON (pe.id_produto = prod.id)";
		$stmt = Database::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}
	
	public function selectPedidosCliente(){
		$sql  = "SELECT pe.id as id_pedido, cli.id as id_cliente, cli.nome as nome_cliente, cli.email, prod.id as id_produto, prod.nome as nome_produto, prod.descricao, prod.preco FROM $this->table as pe INNER JOIN Cliente as cli ON (pe.id_cliente = cli.id) INNER JOIN Produto as prod ON (pe.id_produto = prod.id) WHERE id_cliente = :id_cliente";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}
	
	public function selectPedidosProduto(){
		$sql  = "SELECT pe.id as id_pedido, cli.id as id_cliente, cli.nome as nome_cliente, cli.email, prod.id as id_produto, prod.nome as nome_produto, prod.descricao, prod.preco FROM $this->table as pe INNER JOIN Cliente as cli ON (pe.id_cliente = cli.id) INNER JOIN Produto as prod ON (pe.id_produto = prod.id) WHERE id_produto = :id_produto";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id_produto', $this->id_produto, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}
	
	public function updatePedido(){
		$sql  = "UPDATE $this->table SET id_cliente = :id_cliente, id_produto = :id_produto WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':id_produto', $this->id_produto);
		return $stmt->execute();
	}
	
	public function deletePedido(){
		$sql  = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		return $stmt->execute(); 
	}
}