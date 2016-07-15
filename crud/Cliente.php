<?php

require_once 'Database.php';

class Cliente{
	
	protected $table = 'Cliente';
	private $id;
	private $nome;
	private $email;
	private $telefone;
	
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
			case "email":
				return ($this->email);
				break;
			case "telefone":
				return ($this->telefone);
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
			case "email":
				$this->email = strtolower($valor);
				break;
			case "telefone":
				$this->telefone = $valor;
				break;	
		}
	}

	public function insertCliente(){
		$sql  = "INSERT INTO $this->table (nome, email, telefone) VALUES (:nome, :email, :telefone)";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telefone', $this->telefone);
		return $stmt->execute(); 
	}
	
	public function selectCliente(){
		$sql  = "SELECT cliente.* FROM $this->table as cliente WHERE cliente.email = :email";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(); 
	}
	
	public function selectClientes(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = Database::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}
	
	public function updateCliente(){
		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telefone', $this->telefone);
		return $stmt->execute();
	}
	
	public function deleteCliente(){
		$sql  = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':id', $this->id);
		return $stmt->execute(); 
	}
	
	public function verificaRegistro(){
		$sql  = "SELECT COUNT(*) as registros FROM $this->table as cliente WHERE cliente.email = :email";
		$stmt = Database::prepare($sql);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
}