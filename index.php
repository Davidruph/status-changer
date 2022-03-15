<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "marti");
 if(isset($_SESSION['email'])) {
    $id = $_SESSION['user'];
    $fullname = $_SESSION['fullname'];
    $mobile = $_SESSION['mobile'];
    $country = $_SESSION['country'];
    $role = $_SESSION['role'];
}else{
    $mobile = '';
}

?>

<?php
require 'admin/functions/dbconn.php';

//fetch users
$sql = 'SELECT * FROM users';
$statement = $connection->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="admin/assets/js/all.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">Fluid UI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php
  if(!isset($_SESSION['email'])) {
   ?>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="signin.php">Login</a>
      </li>
    </ul>
  </div>
  <?php
   }
   ?>

  <?php
  if(isset($_SESSION['email'])) {
   ?>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
  <?php
   }
   ?>
</nav>


<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-lg-6">
      
        <div class="card mb-4 shadow border-0">
            <input type="hidden" id="mobile" value="<?= $mobile ?? '' ?>">
              <div class="card-header border-0">
                  <i class="fas fa-table mr-1"></i>
                  Team List
              </div>               
              <div class="card-body">

                  <div class="table-responsive">
                      <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                          <tbody>
                            <?php foreach($users as $user): ?>
                              <tr>
                                <td><?php echo $user['names']; ?></td>
                                <td>
                                  <select name="status" id="" class="form-control status" readonly>
                                    <option value="KP"  <?php if ($user['status'] == 'KP') { ?> selected <?php }  ?>>KP</option>
                                    <option value="Hotel"  <?php if ($user['status'] == 'Hotel') { ?> selected <?php }  ?>>Hotel</option>
                                    <option value="Feld"  <?php if ($user['status'] == 'Feld') { ?> selected <?php }  ?>>Feld</option>
                                    <option value="Urlaub"  <?php if ($user['status'] == 'Urlaub') { ?> selected <?php }  ?>>Urlaub</option>
                                    <option value="Meetings"  <?php if ($user['status'] == 'Meetings') { ?> selected <?php }  ?>>Meetings</option>
                                  </select>
                                </td>
                                <td>
                                     <a href="tel:<?php echo $user['mobile_no']; ?>" class="ml-4"><i class="fa fa-phone-alt"></i></a>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
              </div>
          </div>
    </div>
  </div>
</div>



<script src="admin/assets/js/jquery.js" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 -->
 <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
 <script src="admin/assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Call the 
$(document).ready(function() {
  $('.status').on('change',function () {
   var decision = $(this).val();
    var id = $('#mobile').val();
    //alert(decision);
    // alert(id);
      if(id === ''){
            Swal.fire(
                'Ooops Sorry!',
                'You need to login first!',
                'error'
              );
        }else{
           $.ajax({
                url: 'saveStatus.php',
                type: 'POST',
                data: {decision: decision, id: id },
            })
            .done(function(data) {
                Swal.fire(
                'Good job!',
                'Your status has changed!',
                'success'
              );
            })
            .fail(function(xhr) {
                console.log(xhr.status);
                console.log(xhr.responseText);
            })
            .always(function() {
                console.log("complete");
                
            });
        }
});
});
</script>
</body>
</html>