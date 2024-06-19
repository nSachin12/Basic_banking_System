<?php include('header.php'); ?>
<?php include('database1.php');
 
 $id = $_GET['UpId'];

 $sql=" select *from spark where Id=$id";
 $res=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($res);
 $Name=$row['Name'];
 $Email=$row['Email'];
 $ACCNo=$row['ACCNo'];
 $Amount=$row['Amount'];

if(isset($_POST['UpdateCustomer']))
{
  $Name=$_POST['Name'];
  $Email=$_POST['Email'];
  $ACCNo=$_POST['ACCNo'];
  $Amount=$_POST['Amount'];
    
  
       $query="update spark set Id=$id,Name='$Name',Email='$Email',ACCNo='$ACCNo',Amount='$Amount' where Id=$id " ;
       $res=mysqli_query($conn,$query);
       if(!$res)
       {
       die("Query failed".mysqli_error());
       }
       else{
        header('location:index.php?Update=Customer data updated successfully');
    }
    
  }
  
  ?>

      <form action="" method="post">
           <div class="form-group">
                <label for="Name">Enter Name</label>
                <input type="text" name="Name" class="form-control" value="<?php echo $Name; ?>">
            </div>
            <div class="form-group">
                <label for="Email">Enter Email</label>
                <input type="Email" name="Email" class="form-control" value="<?php echo $Email; ?>">
            </div>
            <div class="form-group">
                <label for="ACCNo">Enter Account Number</label>
                <input type="text" name="ACCNo" class="form-control" value="<?php echo $ACCNo; ?>">
            </div>
            <div class="form-group">
                <label for="Amount">Enter Amount</label>
                <input type="number" name="Amount" class="form-control" value="<?php echo $Amount; ?>">
            </div>
            <input type="submit" class="btn btn-success my-5" name="UpdateCustomer" value="Update">

        </form>

<?php include('footer.php'); ?>