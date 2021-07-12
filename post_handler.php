<?php
session_start();
    require_once("functions.php");
    require_once("Post.php");
    if(isset($_POST['submit_post'])){
        $post_message = $_POST['post_message'];
        $user_id = $_SESSION['user_id'];

        if($post_message == ""){
            redirect("posts.php");
        }
        else{
            $post_obj = new Post();
           $addPost =  $post_obj->addPost($user_id,$post_message);
            if($addPost){
                $_SESSION['success'] = "Post successfully added";
                redirect("posts.php");
            }
            else{
                $_SESSION["error"] = "Sorry unable to add post due to error";
                redirect("posts.php");
            }
        }
    }

?>