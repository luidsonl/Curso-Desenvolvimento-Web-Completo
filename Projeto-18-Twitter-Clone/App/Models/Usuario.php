<?php
namespace App\Models;
use MF\Model\Model;

class Usuario extends Model{
	private $id;
	private $username;
	private $email;
	private $password;

	public function __get($atr){
		return $this->$atr;
	}

	public function __set ($atr, $value){
		$this->$atr = $value;
	}
	// Salvar
	public function salvar(){
		$query = "insert into users(username, email, password)value(:username, :email, :password)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':username', $this->__get('username'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		return $this;
	}
	// Validar se um cadastro pode ser feito
	public function validarCadastro(){
		$valido = true;

		if (strlen($this->__get('username')) < 3){
			$valido = false;
		}
		if (strlen($this->__get('email')) < 3){
			$valido = false;
		}
		if (strlen($this->__get('password')) < 3){
			$valido = false;
		}

		return $valido;
	}

	// recuperar um usuário por email
	public function getUsuarioPorEmail(){
		$query = "select username, email from users where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


}

?>