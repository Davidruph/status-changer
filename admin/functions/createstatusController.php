<?php
//db connection included
require 'dbconn.php';
$conn = mysqli_connect("localhost", "root", "", "marti");

$errors = array();
$success = array();

//if submit button is clicked and inputs are not empty
if (isset ($_POST['submit']) && (isset ($_POST['status']))){

  $status = $_POST['status'];
  $created_on = date("Y-m-d H:i:s", time());

    if(empty($status)) {
         $errors['fields'] = "Pls status field is required";
    }else{
             $query = mysqli_query($conn, "SELECT status FROM status WHERE status='$status'");
              if(mysqli_num_rows($query) > 0){
                 $errors['status'] = "Status already Exists";
              }else{
                 $sql = 'INSERT INTO status(status, created_on) VALUES(:status, :created_on)';
                $statement = $connection->prepare($sql);

                if ($statement->execute([':status' => $status, ':created_on' => $created_on])) {
                $success['data'] = 'Status saved successfully';
              
                }else{
                    $errors['data'] = 'Ooops, an error occured';
                }
              }

            }

           }

?>