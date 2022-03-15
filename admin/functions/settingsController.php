<?php
//db connection included
require 'dbconn.php';
$conn = mysqli_connect("localhost", "root", "", "marti");

$errors = array();
$success = array();
$id = $_SESSION['user'];

//if submit button is clicked and inputs are not empty
if (isset ($_POST['submit']) && (isset ($_POST['name']))){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $reg_date = date("Y-m-d H:i:s", time());
  $mobile = $_POST['mobile'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = "Email is invalid";
    }
    else{
        
            $sql = 'UPDATE admin SET names=:name, email=:email, mobile_no=:mobile, registered_on=:reg_date WHERE id=:id';
          $statement = $connection->prepare($sql);
          if ($statement->execute([':name' => $name, ':email' => $email, ':mobile' => $mobile, ':reg_date' => $reg_date, ':id' => $id])) {
            $success['data'] = "your details has been updated successfully";
          }else{
            $errors['data'] = 'Ooops, an error occured';
          }

    }

  }

    //password change
    
    if (isset($_POST['password_change'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $id = $_SESSION['user'];

        $query = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_array($query);
            $id = $row['id'];
            $old_pwd = $row['password'];

             if(password_verify($old_password, $old_pwd)){
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = mysqli_query($conn, "UPDATE users SET password = '$new_password' WHERE id = '$id'");
                if ($sql) {
                    session_destroy();
                    header('location: ../signin.php');
                }
             }else{
                $errors['password'] = "Incorrect password or user does not exist";
             }
         }
    }

?>