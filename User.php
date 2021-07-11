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

function save_photo($user_id,$photo){
   $photo_name = uniqid();
 
    $updated = false;
    try {
        $path = "uploads/profile_pics";
        $ext_type = array('jpg', 'jpe', 'jpeg', 'png', 'bmp');
        $ext = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
        if (in_array($ext, $ext_type)) {
            $user_photo =  basename($photo_name . "." . $ext);
           // create the file part if not exit
            if (!is_dir($path) && !mkdir($path, 0755, true)) {
                die("Error creating folder $path");
            }
            if (move_uploaded_file($_FILES['photo']['tmp_name'], "$path/$user_photo")) {
                // Move succeed.
                $photo_url = $path . "/" . $user_photo; //Path to be saved to DB
                $updated = $this->updateProfilePic($user_id,$photo_url);
            }
        }
    } catch (Exception $e) {
        $_SESSION["error"] =  $e->getMessage();
        return $updated;
    }
    return $updated;
}

function updateProfilePic($userId,$photo_url){
    $this->connection = new Connection();
    $con = $this->connection->doConnection();
  $query =  "UPDATE users SET photo = :photo_url where id = :id";
    $flag = false;
  try{
    $stmt = $con->prepare($query);

    $stmt->bindValue(":id", $userId);
    $stmt->bindValue(":photo_url", $photo_url);
    
    $updated = $stmt->execute();

    if($updated){
      $flag = true;
    }

  }
  catch(Exception $ex){
    $_SESSION['error'] = $ex->getMessage();
    return $flag;
  }
  return $flag;
 }
}
?>