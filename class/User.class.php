<?php

	class User{

		private $conn;
		private $table_name = "users";

		public $id;
		public $username;
		public $email;
		public $password;
		public $hashpassword;
		public $created;

		public function __construct($db){
			$this->conn = $db;
		}

		function createUser(){
			
			$query = "INSERT INTO " . $this->table_name . " SET username=:username, email=:email, hashpassword=:hashpassword, created=:created";
 
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':username', $this->username);
			$stmt->bindParam(':email', $this->email);

			$this->hashpassword = password_hash($this->password, PASSWORD_DEFAULT);
			$stmt->bindParam(':hashpassword', $this->hashpassword);

			$this->created = date('Y-m-h H-i-s');
			$stmt->bindParam(':created', $this->created);
	
			$stmt->execute();
		}

		function login(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE username=?";

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->username);
            
            $stmt->execute();
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->hashpassword = $row['hashpassword'];
			$this->username = $row['username'];

		}

	}