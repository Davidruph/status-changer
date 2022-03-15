<?php
//db connection included
require 'functions/dbconn.php';

$errors = array();
$success = array();

if (isset ($_POST['btnupdate'])){
  $name = $_POST['name'];
  $id = $_POST['edit_id'];
  $status = $_POST['status'];
  $mobile_no = $_POST['mobile_no'];
  $reg_date = date("Y-m-d H:i:s", time());
  $sql = 'UPDATE users SET names=:name, status=:status, mobile_no=:mobile_no, registered_on=:reg_date WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':status' => $status, ':mobile_no' => $mobile_no, ':reg_date' => $reg_date, ':id' => $id])) {
    $success['data'] = "user details has been updated successfully <a href='manage-users.php'>Go Back</a>";
  }else{
    $errors['data'] = 'Ooops, an error occured';
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
        <h1 class="mt-4">user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit user Page</li>
        </ol>
          <!-- if there is an error, echo all of them -->
            <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger alert-dismissible fade show" status="alert">
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
                <div class="alert alert-success alert-dismissible fade show" status="alert">
                <?php foreach($success as $succes): ?> 
                <li style="color: green"><?php echo $succes; ?></li>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                  
                <?php endforeach; ?>
              </div>
              <?php endif; ?>

              <?php

                //fetch status
                $sql = 'SELECT * FROM status';
                $statement = $connection->prepare($sql);
                $statement->execute();
                $status = $statement->fetchAll(PDO::FETCH_ASSOC);
              ?>

      <div class="col-md-12">
           <div class="card-body">
                <?php
                //if button btn_edit is clicked, save the id of the item and echo it here with a match
                if(isset($_POST['btn_edit'])) {
                  $id = $_POST['edit_id'];
                   
                  $sql = 'SELECT * FROM users WHERE id=:id';
                  $statement = $connection->prepare($sql);
                  $statement->execute([':id' => $id ]);
                  $users = $statement->fetchAll(PDO::FETCH_OBJ);

                  
                  foreach ($users as $user) {
                    ?>
            
                   <form action="edit-user.php" method="post">
                    <input type="hidden" name="edit_id" value="<?= $user->id; ?>">
                   <div class="form-group">
                      <label class="col-md-2 control-label">Full Name</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" value="<?= $user->names; ?>" name="name" required>
                      </div>
                  </div>

                     <div class="form-group">
                        <label class="col-md-2 control-label">status</label>
                        <div class="col-md-10">
                            <input name="status" id="" class="form-control" value="<?= $user->status; ?>">                         
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-2 control-label">Mobile number</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="mobile_no" required value="<?= $user->mobile_no; ?>">
                        </div>
                    </div>
                   
                    
                    <a href="manage-users.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btnupdate" class="btn btn-primary">Update</button>
                    
                   </form>
                   <?php
			    }
				}
				?>

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

