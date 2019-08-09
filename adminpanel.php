<?php 

    include_once "config/database.php";
    include_once "class/News.class.php";
    include_once "includes/header.php";
   
    error_reporting(E_ALL);
 
    $database = new Database();
    $db = $database->getConnection();
    $news = new News($db);

    if(isset($_POST['create'])){

        $news->title = $_POST['title'];
        $news->content = $_POST['content'];
        $news->category = $_POST['category'];

        $news->createNews();

    }

    if(isset($_POST['read-all'])){
      header("Location: http://localhost/vesti-final/allNews.php");

  }
?>



    
    <div class="container">
      <div class="page-header">
        <h1>Dodaj vest</h1>
      </div> 

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <tr>
                <td>Naslov</td>
                <td><input type="text" name="title" class="form-control"></td>
              </tr>
              <tr>
                <td>Sadrzaj</td>
                <td><textarea name="content" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td>Kategorija</td>
                <td>
                <select class="form-control" name="category">
                    <option value="Politika">Politika</option>
                    <option value="Kultura">Kultura</option>
                    <option value="Sport">Sport</option>
                </select>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="submit" name="create" value="Dodaj vest" class="btn btn-primary">
                  <input type="submit" name="read-all" value="Sve vesti" class="btn btn-danger">
                </td>
                <td></td>
              </tr>
            </table>
          </div>
        </form>  
    </div>

    
  </body>
</html>