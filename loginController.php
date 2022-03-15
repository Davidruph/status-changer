<?php

$conn = mysqli_connect("localhost", "root", "", "marti");
$errors = array();

if(isset($_POST['submit'])){
     $email = $_POST['email'];
     $password = $_POST['password'];
     $captcha = $_POST['g-recaptcha-response'];
     
     $email = trim($email);
     $password = trim($password);
   
    if($email === "") {
        $errors['email'] = "Email is required";
    }
    if($password === "") {
        $errors['password'] = "Password is required";
    }
    elseif(strlen($password) < 6) {
        $errors['password'] = "password too short";
    }
    else{
  
        $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_array($query);
            $id = $row['id'];
            $fullname = $row['names'];
            $mobile = $row['mobile_no'];
            $pwd = $row['password'];
            $email = $row['email'];
            $role = $row['role'];
            $country = $row['country'];
            
            if(password_verify($password, $pwd)){

                if($query && $role === "admin"){
                    $_SESSION['user'] = $id;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['mobile'] = $mobile;
                    $_SESSION['email'] = $email;
                    $_SESSION['country'] = $country;
                    $_SESSION['role'] = $role;
                    header('location:admin/index.php');
                     exit();
                }
                 elseif($query && $role === "user"){
                    $_SESSION['user'] = $id;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['mobile'] = $mobile;
                    $_SESSION['email'] = $email;
                    $_SESSION['country'] = $country;
                    $_SESSION['role'] = $role;
                    header('location:index.php');
                     exit();
                }
                
            }else {
                    $errors['username'] = "Incorrect Password";

            } 
        }else {
                    $errors['username'] = "User not found";

            }

    }

}
?>