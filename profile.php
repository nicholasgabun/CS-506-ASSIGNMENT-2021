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
        $photo = $theUser['photo'];
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
    else{
        $_SESSION['error'] = "Unable to update the user";
    }
}

require_once("includes/header.php");

?>

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
                                    <a class="send_btn" href = "image_upload.php">Update Image</a>
                                 </div>                                 
                                 <div class="col-md-6">
                                    <button class="send_btn" name = "updateProfile">Update Profile</button>
                                 </div>
                                 </div>
                                 
                              </div>
                           </form>
                        </div>
                        <div class="col-md-5">
                           <div class="mane_img">
                           <?php
                            if(!empty($photo)){
                            ?>
                            
                            <img src="<?php echo $photo;?>" alt="Profile pic"/>
                            <?php
                            }
                            else{
                           ?>
                              <figure><img src="images/top_img.png" alt="Profile pic"/></figure>
                              <?php } ?>
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
    <?php
        require_once("includes/footer.php");
    ?>