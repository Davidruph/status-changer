<?php
    ob_start();
    session_start();
$conn = mysqli_connect("localhost", "root", "", "marti");
    $errors = array();
    $success = array();

if(isset($_POST['register'])){
    
    $full_name = $_POST['full_name'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $code = $_POST['password'];
    $confirm = $_POST['confirmpassword'];
    $mobile_code = $_POST['mobile_code'];
    
    //trim input tags
    
    $full_name = trim($full_name);
    $country = trim($country);
    $email = trim($email);
    $password = trim($code);
    $confirm = trim($confirm);
    $mobile = trim($mobile);
    $role = "user";
    $reg_date = date("Y-m-d H:i:s", time());
    $mobile = '+'.$mobile_code.$mobile;
    

    if( $full_name === "" || $country === "" || $country === "" || $email === "" || $password === "" || $confirm === "") {
         $errors['fields'] = "All fields are Required";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = "Email is invalid";
    }
    elseif(strlen($password) < 8) {
        $errors['password'] = "Password too short";
    }
    elseif($password != $confirm) {
        $errors['passwordf'] = "Passwords don't match";
    }

    else {
        $query = mysqli_query($conn, "SELECT email FROM admin WHERE email='$email'");
        if(mysqli_num_rows($query) > 0){
           $errors['pass'] = "Email Exists";
        }
        else{
            $password = password_hash($code, PASSWORD_DEFAULT);
             $query = mysqli_query($conn, "INSERT INTO admin (names, country, mobile_no, email, role, password, registered_on) VALUES('$full_name','$country','$mobile','$email','$role','$password','$reg_date')");
            if($query){
                $success['confirm'] = "You are now registered <a href='signin.php'>Login Here</a>";
            }else {
              $errors['pass'] = "Error Registering";
            }
        }
    }

}
?>