<?php 
session_start();
require_once("functions.php");
if(!isset($_SESSION['user_id'])){
    redirect("index.html");

}
else{
    require_once("includes/header.php");
    require_once("Post.php");
    require_once("User.php");
    require_once("Comment.php");
    $post_obj = new Post();
    $posts = $post_obj->getAllPosts();
    // var_dump($posts);
?>
<!-- posts -->
<div class ="row" style = "margin-top:20px;"></div>
    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Posts</h2>
                        <span>Welcome to our post section, feel free to post any relevant information relating to our products. You can also make comments to already made posts but make sure you do not criticize or insult anyone, else you will be banned from the group. Thank you and once again welcome to C-Shop your home of Computers and computer accessories.</span>
                    </div>
                </div>
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
    <div class="row mt-20">
        <div class="col-md-3"></div>
        <div class="col-md-6 jumbotron">
            <h2>Make post</h2>
            <form action="post_handler.php" method="post">
                <div class="form-group">
                    <label for="post">Message:</label>
                    <textarea name="post_message" class="form-control" placeholder="Type your message here..."></textarea>
                </div>
                <div class="form-group">
                    <input type="reset" name="reset" class="btn btn-secondary">
                    <button name = "submit_post" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2>Users Posts</h2>
            <?php
            $comment_obj = new Comment();
            foreach($posts as $post){
                $post_id = $post['post_id'];
                $post_message = $post['post_message'];
                $posted_on = $post['posted_on'];
                $user_id = $post['user_id'];
                $username = $post['name'];
                $user_photo = $post['photo'];

                $comments = $comment_obj->getPostComments($post_id);
            ?>
            <div class="row">
                <div class="col-md-2">
                <img class = "img-reponsive thumbnail_images" src = "<?php echo $user_photo; ?>"/>
                </div>
                <div class="col-md-4">
                <h3> <?php echo $username;?></h3>
                    <p> <?php echo date("F j, Y, g:i a",strtotime($posted_on));?> </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
            <p><?php echo $post_message; ?></p>
            </div>
            <!-- Comments Section -->
            <h2>Comments</h2>
            <div class="row mt-20">
                <?php
                    if($comments ==  0){
                        echo "There are no comments for this post yet";
                    }
                    else{
                       foreach($comments as $user_comment){
                           $comment_body = $user_comment['comment_body'];
                           $comment_date = $user_comment['commented_on'];
                           $commenter = $user_comment['name'];
                           $commenter_photo = $user_comment['photo'];
                           ?>
                           <div class="col-md-1"></div>
                           <div class="col-md-1">
                               <img class = "img-responsive" src="<?php echo $commenter_photo?>"/>
                           </div>
                           <div class="col-md-8">
                               <strong><?php echo $commenter;?> </strong> <span style = "margin-left: 60%;"><?php echo  date("F j, g:i a", strtotime($comment_date));?></span>
                               <p style = "margin-left: -10px;"><?php echo $comment_body;?></p>
                           </div>

                           <?php
                       }
                    }
                ?>
            </div>
            <div class="row mt-20">
                <?php
                $user_obj = new User();
                $current_user = $user_obj->getUserById($_SESSION['user_id']);
                foreach($current_user as $logged_in_user){
                    $this_user_photo = $logged_in_user['photo'];
                ?>
                <div class="col-md-1">
                    <img src = "<?php echo $this_user_photo; ?>" class=" thumbnail_images img-responsive"/>
                </div>
                <div class="col-md-8">
                <form action="comment_handler.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name = "post_id" value="<?php echo $post_id;?>">
                        <input type="text" class="form-control" name = "comment_message" placeholder="Add your comment...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class = "btn btn-sm btn-default" value="Submit" name="submit_comment">
                    </div>

                </form>
                </div>
                <?php
                } 
                ?>
            </div>

            <?php
                }
            ?>
        </div>
    </div>

<?php
}
?>
<div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2021 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>