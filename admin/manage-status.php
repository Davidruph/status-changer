<?php

//db connection
require 'functions/dbconn.php';
$errors = array();
$success = array();
//fetch status
$sql = 'SELECT * FROM status';
$statement = $connection->prepare($sql);
$statement->execute();
$status = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
//delete statuor

if (isset($_POST['delete_btn'])) {
  $id = $_POST['delete_id'];
  $sql = 'DELETE FROM status WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':id' => $id])) {
   
    $success['confirm'] = "One record has been deleted!";
    header("Location: manage-status.php");
   
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
        <h1 class="mt-4">Manage Status</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Manage status Page</li>
        </ol>
     
        <div class="col-md-12">
            <div class="demo-box m-t-20">
                <div class="m-b-30">
                    <a href="create-status.php">
                    <button id="addToTable" class="btn btn-success waves-effect waves-light">Create Status &nbsp; <i class="fa fa-plus" ></i></button>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                     <?php foreach($status as $statu): ?>
            
					<tr>
						<td><?php echo $statu['id']; ?></td>
                        <td><?php echo $statu['status']; ?></td>
                        
            			<td style="display: inline-flex;">
                          <form action="edit-status.php" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $statu["id"]; ?>">
                              <button type="submit" name="btn_edit" class="btn" style="color: blue;"><i class="far fa-edit"></i></button>
                          </form>
                          
                          <form action="manage-status.php" method="post">
                            <input type="hidden" name="delete_id" value="<?php echo $statu["id"]; ?>">
                              <button type="submit" name="delete_btn" class="btn" onclick="return confirm('Are you sure you want to delete this status?');" style="margin-left: 10px;color: red;"><i class="fas fa-trash-alt"></i></button>
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
    
