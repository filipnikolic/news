<?php 

    class Comment{

        private $conn;
        private $table_name = "comments";

        public $id;
        public $username;
        public $created;
        public $comment;
        public $articleid;

        public function __construct($db){
			$this->conn = $db;
        }
        
        public function setComment(){

            $query = "INSERT INTO " . $this->table_name . " SET username=:username, created=:created, comment=:comment, articleid=:articleid";
 
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':comment', $this->comment);
            $stmt->bindParam(':articleid', $this->articleid);

			$this->created = date('Y-m-h H-i-s');
			$stmt->bindParam(':created', $this->created);
	
            $stmt->execute();
            
        }

        public function readComment(){

            $query = "SELECT id, username, created, comment, articleid FROM " . $this->table_name . " WHERE articleid=" . $this->articleid;

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->created);
            
            $stmt->execute();

            return $stmt;
            
        }

        public function deleteComment(){

            $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(1, $this->id);
                
            $stmt->execute();
    
        }
    }