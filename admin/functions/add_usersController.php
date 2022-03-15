<?php
//db connection included
require 'dbconn.php';
//$conn = mysqli_connect("localhost", "root", "", "marti");

$errors = array();
$success = array();

//if submit button is clicked and inputs are not empty
if (isset ($_POST['submit']) && (isset ($_POST['name']))){

  $name = $_POST['name'];
  $status = $_POST['status'];
  $country = $_POST['country'];
  $mobile_code = $_POST['mobile_code'];
  $mobile = $_POST['mobile'];
  $reg_date = date("Y-m-d H:i:s", time());
  $mobile_no = '+'.$mobile_code.$mobile;

    if(empty($name) || empty($mobile_no)) {
         $errors['fields'] = "Pls all fields are required";
    }else{
      
             $sql = 'INSERT INTO users(names, status, country, mobile_no, registered_on) VALUES(:name, :status, :country, :mobile_no, :reg_date)';
            $statement = $connection->prepare($sql);

            if ($statement->execute([':name' => $name, ':status' => $status, ':country' => $country, ':mobile_no' => $mobile_no, ':reg_date' => $reg_date])) {
            $success['data'] = 'name registered successfully';
          
            }else{
                $errors['data'] = 'Ooops, an error occured';
            }
    }

    }

?>