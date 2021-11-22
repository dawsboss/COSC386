<!DOCTYPE html>
<?php 
session_start();
include('BackUp.php');
?>

<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="utf-8".>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Signin Template for Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
        <style>
        img {
          border-radius: 17%;
        }
        </style>
  </head>
  <body>
  <?php include 'navbar.php'?>
    <div class="container">
    <div class="row" style="width:auto; height:50px;"></div>
    <div class="row" style="width: auto;height: 150px;">
            <div class="col-4"></div>
              <div class="col-3">
        <div class="text-center">
        <form class="form-signin" method="post" action="../BackEnd.php">
          <div class="imageRound">
            <img class="mb-4" src="https://s3-us-west-2.amazonaws.com/webresources-savingforcollege/images/school_logos/salisbury-university.png" alt="" width="128" height="128">
          </div>
          <h1 class="h3 mb-3 font-weight-normal">Sign Into Undergraduate Research Database</h1>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="username" id="inputEmail" name='username'class="form-control" placeholder="Username" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
          <div class="checkbox mb-3">
            <!--<label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>-->
            <input class="btn btn-lg btn-primary btn-block" type="submit" placeholder="Sign in">
            <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>




  </body>
</html>
