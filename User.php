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
    //Get user by id
    function getUserById($id){
        $this->connection = new Connection();
        $con = $this->connection->doConnection();
    $query =  "SELECT * FROM users where id = :id";

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
    //Update User
 function updateUser($id,$name,$email,$phone,$address){
    $this->connection = new Connection();
    $con = $this->connection->doConnection();
  $query =  "UPDATE users SET name = :name, email = :email, phone = :phone, address = :address where id = :id";
    $flag = false;
  try{
    $stmt = $con->prepare($query);

    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":phone", $phone);
    $stmt->bindValue(":address", $address);
    // $stmt->bindValue(":id", $id);
    
    $updated = $stmt->execute();

    if($updated){
      $flag = true;
    }

  }
  catch(Exception $ex){
    $_SESSION['error'] = $ex->getMessage();
  }
  return $flag;
}
 }
?>