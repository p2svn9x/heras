<?php
session_start();
include("include/config.php");
include("include/lang.php");
include("include/function.php");
if(isset($_POST['submit'])){
$user = $_POST['user'];
$pass = md5($_POST['pass']);
$query = $bdd->prepare("select * from user where user=? and pass=?");
$query-> execute(array($user,$pass));
if ($query->rowCount()){
$fetch = $query->fetch(PDO::FETCH_ASSOC);
$_SESSION['user']=$user;
header("Location: $home_path");} else {echo error("sai pass");}
}


if (isset($_SESSION['user'])){ header("Location: $home_path");} ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Heras Admin Panel">
  <meta name="author" content="Heras">
  <meta name="keyword" content=",">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Heras Panel</title>

  <!-- Icons -->
  <link href="vendors/css/flag-icon.min.css" rel="stylesheet">
  <link href="vendors/css/font-awesome.min.css" rel="stylesheet">
  <link href="vendors/css/simple-line-icons.min.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
<form action="" method="post" class="form-horizontal">
                    <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In</p>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-user"></i></span>
                </div>
                <input type="text" name="user" class="form-control" placeholder="Username">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" name="pass" class="form-control" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Login</button>
                </div>
                
              </div>
            </div>
          <button type="submit" name="submit" value="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Login</button>
                  </form>

              </div>
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="vendors/js/jquery.min.js"></script>
  <script src="vendors/js/popper.min.js"></script>
  <script src="vendors/js/bootstrap.min.js"></script>

</body>
</html>


