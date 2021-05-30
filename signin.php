<?php
session_start();

    require_once("User.php");
    require_once("functions.php");

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) AND !empty($password)){
            $user = New User();
            $login = $user->loginUser($email,$password);
            
            if($login == true){
                $_SESSION['success'] = "Welcome ". $_SESSION['username'];
                redirect("profile.php");
            }
            else{
                $_SESSION["error"] = "Invalid login credentials";
            }
        }
        else{
            $_SESSION["error"] = "Please ensure you enter a valid email and password";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link href="css/login_css.css" rel="stylesheet"> 
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- <script src="" async defer></script> -->
        <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <img src = "key.jpg" width="80" height="70">
                    <!-- <i class="fa fa-key" aria-hidden="true"></i> -->
                </div>
                <div class="col-lg-12 login-title">
                   User Login
                </div>
                <!-- Error and success check and alert -->
                <div class="row">
                <?php
                if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                ?>
                    <div class="col-lg-2"></div>
                    <div id="successDiv" class="col-lg-8 col-lg-offset-6 alert alert-success">
                        <?php
                        echo $_SESSION['success'];
                        $_SESSION['success'] = "";
                        ?>
                    </div>
                <?php
                } elseif (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                ?>
                    <div class="col-lg-2"></div>
                    <div id="errorDiv" class="col-lg-8 col-lg-offset-4 alert alert-danger">
                        <?php
                        echo $_SESSION['error'];
                        $_SESSION['error'] = "";
                        ?>
                    </div>
                <?php
                }
                ?>
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="form-control-label">email</label>
                                <input type="text" class="form-control" name = "email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <a href = "register.php" class="btn btn-outline-secondary">Register</a>
                                    <button type="submit" class="btn btn-outline-primary" name="login">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </body>
</html>
    




