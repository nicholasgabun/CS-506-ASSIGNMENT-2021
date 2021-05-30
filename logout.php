<?php
session_start();
require_once("functions.php");
// if(isset($_SESSION['user_id']))
    if(session_destroy())
    echo "Loging out.....";
        redirect("index.html");

?>