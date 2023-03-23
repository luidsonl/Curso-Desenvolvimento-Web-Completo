<?php

namespace App;

class Connection{
	private static $host = 'localhost:3306';
	private static $dbname = 'twitter_clone';
	private static $user = 'root';
	private static $pass = '';

	public static function getDb(){
		try{
			$conn = new \PDO(
				'mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8',
				self::$user,
				self::$pass
			);
			return $conn;
		} catch (\PDOException $e){

		}
	}

}


?>