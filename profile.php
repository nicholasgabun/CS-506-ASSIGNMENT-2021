<?php 
session_start();
require_once("functions.php");
if(!isset($_SESSION['user_id'])){
    redirect("index.html");
}
else{
    require_once("User.php");
    $user_id = $_SESSION['user_id'];
    $userObj = new User();
    $user = $userObj->getUserById($user_id);
    foreach($user as $theUser){
        $name = $theUser['name'];
        $phone = $theUser['phone'];
        $address = $theUser['address'];
        $email = $theUser['email'];
        // $photo = $thUser['photo']
    }
}
if(isset($_POST["updateProfile"])){
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $userObj = new User();
    $updated = $userObj->updateUser($user_id,$name,$email,$phone,$address);
    if($updated){
        $_SESSION['success'] = "User Updated Successfully";
    }
    // else{
    //     $_SESSION['error'] = "Unable to update the user";
    // }
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>C-SHOP</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="head_top">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="index.html">
                                            <h1>C-Shop</h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link top_btns" href="index.html"> Home  </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link top_btns" href="#about">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link top_btns" href="#contact">Contact us</a>
                                        </li>
                                    </ul>
                                    <div class="sign_btn"><a href="signin.php">Sign in</a></div>
                                    <div class="sign_btn"><a href="logout.php">Logout</a></div>
                                    <?php if(isset($_SESSION['user_id'])){ ?>
                                    <div class="sign_btn"><a href="profile.php">My Profile</a></div>
                                    <?php
                                    }?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- profile -->
    <div class="request">
         <div class="container">
            <div class="row">
               <div class="col-md-12" style = "margin-top: 20px">
                  <div class="titlepage">
                     <h2>Profile of <?php echo $name; ?></h2>
                  </div>
               </div>
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
            <div class="row">
               <div class="col-sm-12">
                  <div class="black_bg">
                     <div class="row">
                        <div class="col-md-7 ">
                           <form class="main_form" action = "" method="post">
                              <div class="row">
                                 <div class="col-md-12 ">
                                 <label class = "white-label">Name:</label>
                                    <input class="contactus" name="name" type="text" name="name" value="<?php echo $name;?>">
                                 </div>
                                 <div class="col-md-12">
                                 <label class = "white-label">Phone Number:</label>
                                    <input class="contactus" name="phone" type="text" name="phone" value="<?php echo $phone;?>" >
                                 </div>
                                 <div class="col-md-12">
                                 <label class = "white-label">Email:</label>
                                    <input class="contactus" name="email" type="email" name="email" value="<?php echo $email;?>">
                                 </div>
                                 <div class="col-md-12">
                                 <label class = "white-label">Address:</label>
                                 <input class="contactus" name="address" type="text" name="address" value="<?php echo $address;?>">
                                 </div>
                                 <div class=" row col-md-12">
                                 
                                 <div class="col-md-6">
                                    <button class="send_btn" name = "updateProfile">Update Profile</button>
                                 </div>
                                 </div>
                                 
                              </div>
                           </form>
                        </div>
                        <div class="col-md-5">
                           <div class="mane_img">
                              <figure><img src="images/top_img.png" alt="Profile pic"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end profile -->
    <!-- about -->
    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>About Us</h2>
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur culpa officiis possimus adipisci numquam corporis obcaecati, corrupti recusandae eligendi ipsam eum pariatur unde aliquid a amet asperiores facere ea deserunt.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container" id="contact">
                <div class="row">
                    <div class="col-md-6">
                        <div class="cont">
                            <h3> <strong class="multi"> Contact Us</strong><br> @Modibbo Adama University (MAUTECH) Yola.
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cont_call">
                            <h3> <strong class="multi"> Call Now</strong><br> (+234) XXXXXXXXX
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2021 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>