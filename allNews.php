<?php 
    include_once "config/database.php";
    include_once "class/News.class.php";
    include_once "includes/header.php";
   
    error_reporting(E_ALL);
 
    $database = new Database();
    $db = $database->getConnection();
    $news = new News($db);
?>

    <div class="container">
      <div class="page-header">
        <h1>Vesti</h1>
      </div> 
<?php
    echo "<div class='table-responsive'>";
        echo "<table class='table table-hover table-bordered'>";

            echo "<tr>";
              echo "<th>ID</th>";
              echo "<th>Naslov</th>";
              echo "<th>Datum</th>";
              echo "<th>Akcija</th>";
            echo "</tr>";

            $stmt = $news->readAll();
            $num = $stmt->rowCount();

			if($num > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

              extract($row);
                
              echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$created}</td>";
                echo "<td>";
                
                // delete
                echo "<form action='allNews.php?id=$id' method='POST'>";
                echo "<button type='submit' name='delete' class='btn btn-danger'>Obrisi</button>";
                echo "</form>";  
                echo "</td>";
              echo "</tr>";
            }
          echo "</table>";
        echo "</div>";
    }
    
    if(isset($_POST['delete'])){
        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: missing ID');  
        $news->id = $id;    
        $news->deleteNews();
    }
?>
    </div>
  </body>
</html>