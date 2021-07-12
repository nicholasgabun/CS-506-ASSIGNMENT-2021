<?php
    require_once("DB.php");

    class Post{
        public $connection;

    function addPost($user_id, $post_msg)
    {
        try {
            $sql = "INSERT INTO posts(user_id, post_message) VALUES(:user_id,:msg)";
            $this->connection = new Connection();
            $con = $this->connection->doConnection();
            $statement = $con->prepare($sql);
            $added = $statement->execute([":user_id" => $user_id,":msg" => $post_msg]);
            if ($added) {
                $this->msg = true;
            } else {
                $this->msg = false;
            }
        } catch (Exception $ex) {
            $this->msg = false;
            $this->msg = $ex->getMessage();
        }
        return $this->msg;
    }

    //Get Post by id
    function getPostbybId($id){
        $this->connection = new Connection();
        $con = $this->connection->doConnection();
        $query =  "SELECT * FROM posts where post_id = :id";

        try{
            $stmt = $con->prepare($query);

            $stmt->bindValue(":id", $id);
            
            $stmt->execute();
            $user = $stmt->fetchAll();

            if(count($user)>0){
            return $user;
            }

        }
        catch(Exception $ex){
            $_SESSION['error'] = $ex->getMessage();
            // redirect('index.html');
        }
    }
    //Get Post by id
    function getAllPosts(){
        $this->connection = new Connection();
        $con = $this->connection->doConnection();
        $query =  "SELECT p.*, u.name, u.photo FROM posts p inner join users u on p.user_id = u.id";

        try{
            $stmt = $con->prepare($query);

            $stmt->execute();
            $user = $stmt->fetchAll();

            if(count($user)>0){
            return $user;
            }

        }
        catch(Exception $ex){
            $_SESSION['error'] = $ex->getMessage();
            // redirect('index.html');
        }
    }

    }
?>