<?php
session_start();
require_once("User.php");

if(isset($_POST['registerUser'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    if(!$password == $confirm_pass){
        $_SESSION['error'] = "Password and confirm password fields do not match";
    }
    else if(!empty($name) AND !empty($email) AND !empty($phone) AND !empty($address) AND !empty($password)) {
        
        $user = new User();
       $result = $user->registerUser($name,$email,$phone,$address,$password);
       if($result==true)
         $_SESSION["success"] = "User registered successfully <a href='signin.php' class='btn btn-primary'>Login here</a>";
        else
        $_SESSION['error'] = "Error registering user";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Register</title>
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
                    <img src = "reg_key.jpg" width="100" height="80">
                    <!-- <i class="fa fa-key" aria-hidden="true"></i> -->
                </div>
                <div class="col-lg-12 login-title">
                   Register
                </div>

                <div class="row">
                <!-- Error and success check and alert -->
                <?php
                if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                ?>
                    <div class="col-lg-2"></div>
                    <div id="successDiv" class="col-lg-8 col-lg-offset-4 alert alert-success">
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
                                <label class="form-control-label">name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">password</label>
                                <input type="text" class="form-control" name = "password">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">confirm password</label>
                                <input type="text" class="form-control" name="confirm_pass">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" name = "registerUser">Save</button>
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
    




