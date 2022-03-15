<?php

//db connection
require 'functions/dbconn.php';
$errors = array();
$success = array();
//fetch users
$sql = 'SELECT * FROM users';
$statement = $connection->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
//delete useror

if (isset($_POST['delete_btn'])) {
  $id = $_POST['delete_id'];
  $sql = 'DELETE FROM users WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':id' => $id])) {
   
    $success['confirm'] = "One record has been deleted!";
    header("Location: manage-users.php");
   
  }
}

?>

<?php
    //All header tag to be included
    include('include/header.php');
?>

<?php
    //sidebar tag to be included
    include('include/sidebar.php');
?>
        
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Manage User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Manage Users Page</li>
        </ol>
     
        <div class="col-md-12">
            <div class="demo-box m-t-20">
                <div class="m-b-30">
                    <a href="add-users.php">
                    <button id="addToTable" class="btn btn-success waves-effect waves-light">Add User &nbsp; <i class="fa fa-plus" ></i></button>
                    </a>
                </div>
                 <!-- if there is an error, echo all of them -->
            <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach($errors as $error): ?> 
                <li style="color: red"><?php echo $error; ?></li>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                  
                <?php endforeach; ?>
              </div>
              <?php endif; ?>

        <!-- if there is success, echo all of them -->
       <?php if (count($success) > 0): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php foreach($success as $succes): ?> 
                <li style="color: green"><?php echo $succes; ?></li>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                  
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
                <br>
                <br>

            <div class="table-responsive">
                <table class="table m-0 table-colored-bordered table-bordered-primary" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                     <?php foreach($users as $user): ?>
            
					<tr>
						<td><?php echo $user['id']; ?></td>
            <td><?php echo $user['names']; ?></td>
            <td><?php echo $user['status']; ?></td>
            <td><?php echo $user['mobile_no']; ?></td>
            
			<td style="display: inline-flex;">
              <form action="edit-user.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $user["id"]; ?>">
                  <button type="submit" name="btn_edit" class="btn" style="color: blue;"><i class="far fa-edit"></i></button>
              </form>
              
              <form action="manage-users.php" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $user["id"]; ?>">
                  <button type="submit" name="delete_btn" class="btn" onclick="return confirm('Are you sure you want to delete this record?');" style="margin-left: 10px;color: red;"><i class="fas fa-trash-alt"></i></button>
              </form>
              
            </td>
					</tr>
					
          <?php endforeach; ?>
                        
                    </tbody>
                                                  
                </table>
                </div>
            </div>

        </div>

        
    </div>
</main>
            
<?php
    //footer tag to be included
    include('include/footer.php');
?>

<?php
    //javascripts files to be included
    include('include/scripts.php');
?>
    
