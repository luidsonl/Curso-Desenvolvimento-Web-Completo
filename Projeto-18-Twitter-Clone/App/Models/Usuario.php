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
		$stmt->bindValue(':password', md5($this->__get('password')));
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
	// Autenciar email e senha
	public function autenticar (){
		$query = "select id , username, email from users where email = :email and password = :password";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		$user = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!empty($user['id'])&&(!empty($user['username']))) {

			$this->__set('id',$user['id']);
			$this->__set('username',$user['username']);
		}

		return $this;
	}

	public function getAll(){
		$query = "
			select 
				u.id, 
				u.username, 
				u.email, 
				(
					select
						count(*)
					from
						connections as c
					where
						c.user_id = :user_id and followed_id = u.id
				)as following
			from 
				users as u
			where username like :username and id != :user_id
			";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':username', '%'.$this->__get('username').'%');
		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function seguirUsuario($followed_id){
		$query = "
			insert into connections(user_id, followed_id)
			values(:user_id, :followed_id)
			";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->bindValue(':followed_id', $followed_id);

		$stmt->execute();
		return true;
	}

	public function deixarSeguirUsuario($followed_id){
		$query = "
			delete from connections where user_id = :user_id and followed_id = :followed_id
			";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->bindValue(':followed_id', $followed_id);

		$stmt->execute();
		return true;
	}
	//informações do usuário
	public function getInfoUsuario(){
		$query = "select username from users where id = :user_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	//total de tweets
	public function getTotalTweets(){
		$query = "select count(*) as total_tweets from tweets where user_id = :user_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	// total de usuarios seguindo
	public function getTotalSeguindo(){
		$query = "select count(*) as total_seguindo from connections where user_id = :user_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	// total de seguidores
	public function getTotalSeguidores(){
		$query = "select count(*) as total_seguidores from connections where followed_id = :user_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
}

?>