<?php
namespace App\Models;
use MF\Model\Model;

class Tweet extends Model{
	private $id;
	private $user_id;
	private $tweet;
	private $tweet_date;

	public function __get($atr){
		return $this->$atr;
	}

	public function __set($atr, $value){
		$this->$atr = $value;
	}

	// Salvar
	public function salvar(){
		$query = "insert into tweets(user_id, tweet)value(:user_id, :tweet)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('user_id'));
		$stmt->bindValue(':tweet', $this->__get('tweet'));
		$stmt->execute();

		return $this;
	}
	// Excluir
	public function deleteTweet(){
		$query = "delete from tweets where id = :tweet_id and user_id = :id";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':tweet_id', $this->__get('id'));
		$stmt->bindValue(':id', $_SESSION['id']);

		$stmt->execute();
		return true;
	}

	//Recuperar
	public function getAll(){
		$query = "
			select 
				t.id, 
				t.user_id,
				u.username, 
				t.tweet, 
				DATE_FORMAT(t.tweet_date, '%d/%m/%Y %H:%i') as tweet_date
			from 
				tweets as t
				left join users as u on (t.user_id = u.id)
			where 
				user_id = :user_id
				or t.user_id in (select followed_id from connections where user_id = :user_id)
			order by
				t.tweet_date desc";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('user_id'));
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function getPorPagina($limit, $offset){
		$query = "
			select 
				t.id, 
				t.user_id,
				u.username, 
				t.tweet, 
				DATE_FORMAT(t.tweet_date, '%d/%m/%Y %H:%i') as tweet_date
			from 
				tweets as t
				left join users as u on (t.user_id = u.id)
			where 
				user_id = :user_id
				or t.user_id in (select followed_id from connections where user_id = :user_id)
			order by
				t.tweet_date desc
			limit
				$limit
			offset
				$offset
				";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':user_id', $this->__get('user_id'));
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}