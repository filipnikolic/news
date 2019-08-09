<?php 

    class News{

        private $conn;
        private $table_name = "news";

        public $id;
        public $title;
        public $content;
        public $category;
        public $created;

        function __construct($db){
            $this->conn = $db;
        }

        function readNews(){

            $query = "SELECT id, title, content, created FROM " . $this->table_name . " ORDER BY id DESC";

            $stmt = $this->conn->prepare($query);

            
            $stmt->execute();

            return $stmt;
            
        }

        function readOne(){

            $query = "SELECT title, content, category, created FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
            
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->category = $row['category'];
            $this->created = $row['created'];

        }

        function createNews(){
			
			$query = "INSERT INTO " . $this->table_name . " SET title=:title, content=:content, category=:category, created=:created";
 
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':category', $this->category);

			$this->created = date('Y-m-d H-i-s');
			$stmt->bindParam(':created', $this->created);
	
			$stmt->execute();
        }
        
        function categoryPolitika(){

            $query = "SELECT id, title, content, created FROM " . $this->table_name . " WHERE category='Politika'";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
            
        }

        function categoryKultura(){

            $query = "SELECT id, title, content, created FROM " . $this->table_name . " WHERE category='Kultura'";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
            
        }

        function categorySport(){

            $query = "SELECT id, title, content, created FROM " . $this->table_name . " WHERE category='Sport'";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }

        function readAll(){

            $query = "SELECT id, title, content, created FROM " . $this->table_name . " ORDER BY id DESC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }

        function deleteNews(){

            $query = "DELETE FROM " . $this->table_name . " WHERE id=?";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
            
            $stmt->execute();

        }
        
    }