<?php
//db connection included
require 'functions/dbconn.php';

$errors = array();
$success = array();

if (isset ($_POST['btnupdate'])){
  $id = $_POST['edit_id'];
  $status = $_POST['status'];
  $created_on = date("Y-m-d H:i:s", time());
  $sql = 'UPDATE status SET status=:status, created_on=:created_on WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':status' => $status, ':created_on' => $created_on, ':id' => $id])) {
    $success['data'] = "Status has been updated successfully <a href='manage-status.php'>Go Back</a>";
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
        <h1 class="mt-4">Status</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit status Page</li>
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

      <div class="col-md-12">
           <div class="card-body">
                <?php
                //if button btn_edit is clicked, save the id of the status and echo it here with a match
                if(isset($_POST['btn_edit'])) {
                  $id = $_POST['edit_id'];
                   
                  $sql = 'SELECT * FROM status WHERE id=:id';
                  $statement = $connection->prepare($sql);
                  $statement->execute([':id' => $id ]);
                  $status = $statement->fetchAll(PDO::FETCH_OBJ);

                  
                  foreach ($status as $statu) {
                    ?>
            
                   <form action="edit-status.php" method="post">
                    <input type="hidden" name="edit_id" value="<?= $statu->id; ?>">
                   <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" value="<?= $statu->status; ?>" name="status" required>
                      </div>
                  </div>

                    <a href="manage-status.php" class="btn btn-danger">Cancel</a>
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

