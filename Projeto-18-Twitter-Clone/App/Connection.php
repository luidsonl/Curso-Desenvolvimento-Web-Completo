<?php

namespace App;

class Connection{

	
	
	public static function getDb(){
		try{
			$conn = new \PDO(
				"mysql:host=localhost:3306;dbname=mvc;charset=utf8",
				"root",
				""
			);
			return $conn;
		} catch (\PDOException $e){

		}
	}

}


?>