<?php
	include_once "config/database.php";
	include_once "class/News.class.php";
	include_once "class/User.class.php";
	include_once "includes/header.php";
 
  	error_reporting(E_ALL);

  	$database = new Database();
	$db = $database->getConnection();
	$news = new News($db);
	$user = new User($db);

	if(isset($_POST['login'])){
			
		$user->username = htmlspecialchars(strip_tags($_POST['username']));
		$user->password = htmlspecialchars(strip_tags($_POST['password']));

		if(empty($user->username) || empty($user->password)){
			echo "<div class='alert alert-danger' role='alert' style='margin-top:7px;'>";
				 echo "Sva polja su obavezna";
			echo "</div>";
		}else{
			$stmt = $user->login();
			$pwdcheck = password_verify($user->password, $user->hashpassword);
			if($pwdcheck == false){
				echo "<div class='alert alert-danger' role='alert' style='margin-top:7px;'>";
					 echo "Pogrešna šifra";
				echo "</div>";
			}elseif($pwdcheck == true){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['hashpassword'] = $user->hashpassword;
				$_SESSION['loged-in'] = true;
				header("Location: index.php");
				die();	
			}
		}
	}
	
?>

<!-- Left container -->
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
	<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> Kategorija</h1>
			</div>
			<div class="list-group">
				<a href="index.php?category=Politika" class="list-group-item">Politika</a>
				<a href="index.php?category=Kultura" class="list-group-item">Kultura</a>
				<a href="index.php?category=Sport" class="list-group-item">Sport</a>
			</div>
		</div>
	</div>
<!--  End -->

<!-- News -->
	<div class="col-sm-7 text-left">
		<?php

			$category = isset($_GET['category']) ? $_GET['category'] : null;

			if($category == 'Politika'){
				$stmt = $news->categoryPolitika();
			}elseif($category == 'Kultura'){
				$stmt = $news->categoryKultura();
			}elseif($category == 'Sport'){
				$stmt = $news->categorySport();
			}else{
				$stmt = $news->readNews();
			}
			$num = $stmt->rowCount();

			if($num > 0){

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                
                echo "<div class=''>";
                echo "<h1><a href='article.php?id={$id}'>{$title}</a></h1>";
                echo "<p>{$content}</p>";
                echo "<p><span class='glyphicon glyphicon-time' aria-hidden='true'></span> {$created}</p>";
                echo "</div>";
				echo "<hr>";
				}
			}
		
		?>
	</div>
<!-- End -->

<!-- Login -->
<?php 
if(isset($_SESSION['loged-in']) == false){
?>
  <div class="col-sm-3 sidenav">
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-log-in"></span>Uloguj se</h3>
		</div>
			<div class="panel-body">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Korisničko ime">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Šifra">
					</div>
					<button type="submit" class="btn btn-default" name="login">Login</button>
				</form>
			</div>
		</div><div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<span class="glyphicon glyphicon-user"></span>
					Nemate korisnički nalog?
				</h3>
			</div>
			<div class="panel-body">
				<a href="register.php"><button class="btn btn-default">Registracija</button></a>
			</div>
		</div>	
  </div>
</div>
<?php 
}else{
?>
 <div class="col-sm-3 sidenav">
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Korisnik</h3>
		</div>
			<div class="panel-body">
			<p><span class="glyphicon glyphicon-user" style="float:left;" aria-hidden="true"></span><?php echo "Korisnicko ime: " . $_SESSION['username']; ?></p>
			</div>
		</div>
  </div>
</div>
<?php 
}
?>
<!-- End -->

<!-- Footer -->
<?php 
  include_once "includes/footer.php";
?>
<!-- End -->


