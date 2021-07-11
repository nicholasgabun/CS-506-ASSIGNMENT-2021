<?php 
session_start();
require_once("functions.php");
if(!isset($_SESSION['user_id'])){
    redirect("index.html");
}

?>