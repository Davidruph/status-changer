
<?php
//db connection included
$conn = mysqli_connect("localhost", "root", "", "marti");

if (isset($_POST['id'])){
  $id = $_POST['id'];
  $decision = $_POST['decision'];
  $query = mysqli_query($conn, "UPDATE users SET status='$decision' WHERE mobile_no=$id");
}

?>