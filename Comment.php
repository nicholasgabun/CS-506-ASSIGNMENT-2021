<?php
    require_once("DB.php");

    class Comment{
        public $connection;

    function addComment($post_id,$user_id, $comment_msg)
    {
        try {
            $sql = "INSERT INTO comments(post_id,user_id, comment_body) VALUES(:post_id,:user_id,:msg)";
            $this->connection = new Connection();
            $con = $this->connection->doConnection();
            $statement = $con->prepare($sql);
            $added = $statement->execute([":post_id"=>$post_id,":user_id" => $user_id,":msg" => $comment_msg]);
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

    //Get Comment by id
    function getPostComments($post_id){
        $this->connection = new Connection();
        $con = $this->connection->doConnection();
        $query =  "SELECT c.*, u.name, u.photo FROM comments c inner join users u on c.user_id = u.id where c.post_id = :id";

        try{
            $stmt = $con->prepare($query);

            $stmt->bindValue(":id", $post_id);
            
            $stmt->execute();
            $user = $stmt->fetchAll();

            if(count($user)>0){
            return $user;
            }

        }
        catch(Exception $ex){
            // $_SESSION['error'] = $ex->getMessage();
            echo $ex->getMessage();
            // redirect('index.html');
        }
    }
    //Get Comment by id
    function getAllComments(){
        $this->connection = new Connection();
        $con = $this->connection->doConnection();
        $query =  "SELECT c.*, p.*, u.name, u.photo FROM comments u inner join posts p on c.post_id = p.post_id inner join users u on p.user_id = u.id";

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