<?php
require_once("DB.php");
    class User{

    public $connection;
    public $msg;


    function registerUser($name, $email, $phone, $address,$password)
    {
        try {
            $sql = "INSERT INTO users(name, email, phone, address, password) VALUES(:username,:email,:phone, :address,:password)";
            $hasded_pass = password_hash($password,PASSWORD_DEFAULT);
            $this->connection = new Connection();
            $con = $this->connection->doConnection();
            $statement = $con->prepare($sql);
            $added = $statement->execute([":username" => $name,":email" => $email,":phone"=>$phone,":address"=>$address,":password"=>$hasded_pass]);
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


    function loginUser($email, $password){
        
        try{
            $this->connection = new Connection();
            $con = $this->connection->doConnection();
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $con->prepare($sql);
            $stmt->execute([":email"=>$email]);
            $user = $stmt->FetchAll(PDO::FETCH_ASSOC);

            foreach($user as $theUser){
                $db_pass = $theUser['password'];
                $user_id = $theUser['id'];    
                $username = $theUser['name'];    
            }
            if(password_verify($password,$db_pass)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $this->msg = true;    
            }
            else{
                $this->msg = false;
            }
        }
        catch(Exception $e){
            $this->msg = false;
            $this->msg = $e->getMessage();
        }
        return $this->msg;
}
 }
?>