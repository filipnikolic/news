<?php

	class Database{

		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "vesti";
		public $conn;

		public function getConnection(){

			$this->conn = null;

			try{
				$this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
			}catch(PDOException $exception){
				echo "Error: " . $exception->getMessage();
			}

			return $this->conn;

		}

	}