
<?php include('database1.php');

if(isset($_POST['AddCustomer']))
 {
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $ACCNo=$_POST['ACCNo'];
   $Amount=$_POST['Amount'];

   if($Name=='' || empty($Name))
   {
    header('location:index.php?message=Name Field Should be filled');
   }
   else{

        $query="INSERT INTO `spark` (Name, Email, ACCNo, Amount) VALUES ('$Name','$Email','$ACCNo','$Amount')";
        $res=mysqli_query($conn,$query);
        if(!$res)
        {
        die("Query failed".mysqli_error());
        }
        else{
        header('location:index.php?insert_msg=Customer Added Successfully');
        }
   }
   
 } 

?>