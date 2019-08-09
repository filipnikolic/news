<?php

    include_once "config/database.php";
    include_once "class/News.class.php";
    include_once "class/Comment.class.php";
    include_once "class/User.class.php";
    include_once "includes/header.php";
    
    error_reporting(E_ALL);

    $database = new Database();
    $db = $database->getConnection();

    $news = new News($db);
    $user = new User($db);

    $id = isset($_GET['id']) ? $_GET['id'] : die('Error: missing ID');
    $news->id = $id;
    $news->readOne();

    $comment = new Comment($db);
    $comment->articleid = $news->id;
  
    if(isset($_POST['add-comment'])){
      $comment->username = $_SESSION['username'];
      $comment->comment = $_POST['comment'];
      $comment->setComment();
    } 

    if(isset($_POST['delete'])){
      $comid = isset($_GET['comid']) ? $_GET['comid'] : die('Error: missing ID');  
      $comment->id = $comid;    
      $comment->deleteComment();
  }
  
?>

  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      
	</div>
<!-- News -->
	<div class="col-sm-7 text-left">
    <h4><small>Vesti</small></h4>
      <hr>
      <h2><?php echo $news->title; ?></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Posted <?php echo $news->created; ?></h5>
      <h5><span class="label label-danger"><?php echo $news->category; ?></span> </h5><br>
      <p><?php echo $news->content; ?></p>
      <br><br>
      
      
      <hr>
     
      <h4>Leave a Comment:</h4>
      <form role="form" method="post" action="article.php?id=<?php echo $id; ?>">
        <div class="form-group">
          <textarea class="form-control" name="comment" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success" name="add-comment">Submit</button>
      </form>
      <br><br>
      
      <p> Comments:</p><br>
<?php
    if(isset($_POST['add-comment']) && !isset($_SESSION['username'])){
        
      echo "<div style='margin-top:10px;'class='alert alert-danger' role='alert'>";
          echo "Morate biti ulogovani";
      echo "</div>";

       
    }

  $stmt = $comment->readComment();

    
  $num = $stmt->rowCount();

      
      if($num > 0){

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                
                echo "<div class=''>";
                echo "<h3>{$username}</h3>";
                echo "<p>{$comment}</p>";
                echo "<p><span class='glyphicon glyphicon-time' aria-hidden='true'></span> {$created}</p>";
                  
                if(!isset($_SESSION['username'])){
                  
              }
                  elseif($username == $_SESSION['username']){
                    echo "<form action='article.php?id={$news->id}&comid={$id}' method='POST'>";
                      echo "<button type='submit' name='delete' class='btn btn-danger'>Obrisi</button>";
                    echo "</form>";
                  }elseif($_SESSION['username'] == "admin"){
                    echo "<form action='article.php?id={$news->id}&comid={$id}' method='POST'>";
                      echo "<button type='submit' name='delete' class='btn btn-danger'>Obrisi</button>";
                    echo "</form>";
                  }
                
                echo "</div>";
                echo "<hr>";
                }     
      }   
     
?>
</div>
	</div>
<!-- End -->
    

<!-- Footer -->
<?php 
  include_once "includes/footer.php";
?>
<!-- End -->
