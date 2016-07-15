<?php

require_once 'Database.php';

class Produto{
	
	protected $table = 'Produto';
	private $id;
	private $nome;
	private $descricao;
	private $preco;
	
	public function __construct(){
			
	}
	
	public function __get($propriedade){
		switch ($propriedade){
			case "id":
				return ($this->id);
				break;
			case "nome":
				return ($this->nome);
				break;
			case "descricao":
				return ($this->descricao);
				break;
			case "preco":
				return ($this->preco);
				break;
		}
	}
	
	public function __set($propriedade, $valor){
		switch($propriedade){
			case "id":
				$this->id = $valor;
				break;
			case "nome":
				$this->nome = ucfirst($valor);
				break;
			case "descricao":
				$this->descricao = $valor;
				break;
			case "preco":
				$this->preco = $valor;
				break;	
		}
	}

	public function insertProduto(){
		$sql  = "INSERT INTO $this->table (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':preco', $this->preco);
		return $stmt->execute(); 
	}
	
	public function selectProduto(){
		$sql  = "SELECT produto.* FROM $this->table as produto WHERE produto.id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(); 
	}
	
	public function selectProdutos(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = Database::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}
	
	public function updateProduto(){
		$sql  = "UPDATE $this->table SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':preco', $this->preco);
		return $stmt->execute();
	}
	
	public function deleteProduto(){
		$sql  = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		return $stmt->execute(); 
	}
	
	public function verificaRegistro(){
		$sql  = "SELECT COUNT(*) as registros FROM $this->table as produto WHERE produto.nome = :nome";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
}