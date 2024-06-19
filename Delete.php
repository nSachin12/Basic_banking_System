<?php include('database1.php');
if(isset($_GET['DelId']))
{
    $id=$_GET['DelId'];

$sql="delete from spark where Id= $id ";
$res=mysqli_query($conn,$sql);
if($res)
{
     header('location:index.php?Delete=Deleted Successfully');
}
else
{
    die(mysqli_error($res));
}
}
?>