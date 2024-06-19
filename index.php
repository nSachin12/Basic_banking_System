    <?php include('header.php'); ?>
    <?php include('database1.php'); ?>

    <div class="box1">
    <h4>All Customers Are Here</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
     ADD CUSTOMER
    </button>
     <a href="indexWeb.php" class="btn btn-primary" >Transfer Money</a>
    </div>

    <table class="table table-hover table-borderd table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>ACC NO</th>
            <th>Amount</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
         <?php
            $sql = 'select*from spark ';
            $res= mysqli_query( $conn,$sql);
            if(!$res){
                echo "Sorry, database creation failed".mysqli_error($conn);
            }
            else {
                while($row=mysqli_fetch_assoc($res)){
                    ?>
                     
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['ACCNo']; ?></td>
                            <td><?php echo $row['Amount']; ?></td>
                            <td><a href="Update.php?UpId=<?php echo $row['Id']; ?>" class="btn btn-success">Update</a></td>
                            <td><a href="Delete.php?DelId=<?php echo $row['Id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
                }
            }
         ?>
        
        </tbody>
    </table>

    <?php 
     if(isset($_GET['message']))
     {
        echo "<h6>".$_GET['message']."</h6>";
     }
    ?>
     <?php 
     if(isset($_GET['insert_msg']))
     {
        echo "<h5>".$_GET['insert_msg']."</h5>";
     }
    ?>
     <?php 
     if(isset($_GET['Delete']))
     {
        echo "<h5>".$_GET['Delete']."</h5>";
     }
    ?>
     <?php 
     if(isset($_GET['Update']))
     {
        echo "<h5>".$_GET['Update']."</h5>";
     }
    ?>
    

<!-- Modal -->
<form action="insertData.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
            <div class="form-group">
                <label for="Name">Enter Name</label>
                <input type="text" name="Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="Email">Enter Email</label>
                <input type="Email" name="Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="ACCNo">Enter Account Number</label>
                <input type="text" name="ACCNo" class="form-control">
            </div>
            <div class="form-group">
                <label for="Amount">Enter Amount</label>
                <input type="number" name="Amount" class="form-control">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="AddCustomer" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>
    <?php include('footer.php'); ?>