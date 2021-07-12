<?php
session_start();
    require_once("functions.php");
    require_once("Comment.php");
    if(isset($_POST['submit_comment'])){
        
        $comment_message = $_POST['comment_message'];
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];

        if($comment_message == ""){
            redirect("posts.php");
        }
        else{
            $comment_obj = new Comment();
           $addComment =  $comment_obj->addComment($post_id,$user_id,$comment_message);
            if($addComment){
                $_SESSION['success'] = "Comment successfully added";
                redirect("posts.php");
            }
            else{
                $_SESSION["error"] = "Sorry unable to add comment due to error";
                redirect("posts.php");
            }
        }
    }

?>