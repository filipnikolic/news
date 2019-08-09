<?php
    include_once "config/database.php";
    include_once "class/User.class.php";
    include_once "includes/header.php";

    error_reporting(E_ALL);

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
?>


<!-- Left -->
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      
    </div>

<!-- End -->

<!-- SignUp -->
    <div style="margin-top:10px;" class="col-sm-7 text-left"> 
    <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<span class="glyphicon glyphicon-plus"></span> Registracija
                </h3>
            </div>
        
        <?php 
        
            if(isset($_POST['signup'])){
                $user->username = htmlspecialchars(strip_tags($_POST['uid']));
                $user->email = htmlspecialchars(strip_tags($_POST['email']));
                $user->password = htmlspecialchars(strip_tags($_POST['pwd']));
                $user->repeatpassword = htmlspecialchars(strip_tags($_POST['repeatpwd']));
                
                if(empty($user->username) || empty($user->email) || empty($user->password) || empty($user->repeatpassword)){
                    echo "<div style='margin-top:10px;'class='alert alert-danger' role='alert'>";
                        echo "Unesite vase podatke";
                    echo "</div>";
                }elseif(!filter_var($user->email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $user->username)){
                    echo "<div style='margin-top:10px;'class='alert alert-danger' role='alert'>";
                        echo "Unesite vase podatke";
                    echo "</div>";
                }elseif($user->password !== $user->repeatpassword){
                    echo "<div style='margin-top:10px;'class='alert alert-danger' role='alert'>";
                        echo "Sifre se ne podudaraju";
                    echo "</div>";
                }
                else{
                    echo $user->createUser(); 
                    echo "<div style='margin:10px 5px;'class='alert alert-success' role='alert'>";
                        echo "Uspesno ste se registrovali";
                    echo "</div>";
                }
            } 

            
        ?>

			<div class="panel-body"><form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="form-group">
						<input type="text" class="form-control" name="uid" placeholder="Korisničko ime">
                    </div>
                    <div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="pwd" placeholder="Šifra">
                    </div>
                    <div class="form-group">
						<input type="password" class="form-control" name="repeatpwd" placeholder="Ponovite šifru">
					</div>
					<button type="submit" name="signup" class="btn btn-default">Kreiraj korisnika</button>
				</form></div>
		</div>
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
				<form method="post" action="index.php">
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
