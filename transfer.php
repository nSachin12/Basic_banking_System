<?php
include('database1.php');
if(isset($_post['transfer'])) 
{
   
   $ACCNo=$_post['ACCNo'];
   $RECNo=$_post['RECNo']; 
   $Amount=$_post['Amount']; 

   if(empty($ACCNo) || empty($RECNo) || empty($Amount)){
 //javascript code to notify user not to leave field blank         
 echo "<script> alert('Empty Fields !!');
 window.location.href='indexWeb.php';
 </script>";  
 exit() ; 
  }
 if($Amount <=0){
    echo "<script> alert('Amount must be greater than zero !!');
    window.location.href='indexWeb.php';
    </script>";  
    exit() ;  
  }

    //CHECK IF PAYER ID EXISTS OR NOT
    $sqlcount = "SELECT COUNT(1) FROM spark where ACCNo='$ACCNo'";
    $r =  $conn->query($sqlcount);
    $d = $r->fetch_row();
    if($d[0]<1){
      echo "<script> alert('Payer ID does not exists !!');
      window.location.href='Transfer.php';
      </script>";  
      exit() ;      
    }

      //CHECK IF PAYEE ID EXISTS OR NOT
      $sqlcount = "SELECT COUNT(1) FROM spark where ACCNo='$RECNo'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Payee ID does not exists !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;      
      }

       //CHECK IF PAYER HAS SUFFICIENT MONEY OR NOT
       $sql = "Select * from spark where ACCNo='$ACCNo'";       
       if($result = $conn->query($sql)){            
            $row1 = $result->fetch_array(); 
            if($row1['Amount']<$Amount){
             echo "<script> alert('Payer does not have required balance !!');
             window.location.href='Transfer.php';
             </script>";  
             exit() ; 
             }  
       }  



       
      //THIS ELSE CODE BELOW IS PERFORMING TRANSACTION FROM PAYER AND PAYEE BANK ACCOUNTS
      //BELOW CODE RUNS WHEN ALL DETAILS ENTERED BY USER ARE CORRECT OR NOT

      echo "<div class ='center'>";
      echo "<div class ='center2'>";
      echo "<h1 style='text-align: center'>Transaction Successfully Completed</h1>
            <p  style='text-align: center; font-size:25px;'>Details of payer and payee are as follows<p>
            <table id = 'Table'>
            <tr>
            <th></th>
            <th>Account No</th>
            <th>Name</th>
            <th>Email</th>
           
            </tr>";

      //SELECTING PAYER DETAILS FROM ACCOUNTDETAILS TABLE
      $sql = "Select * from spark where ACCNo='$ACCNo'";       
      if($result = $conn->query($sql)){            
           $row1 = $result->fetch_array(); 
            //row1 contains payer details
                   echo "<tr> 
                        <td> Payer </td>
                        <td>".$row1['ACCNo']."</td>
                        <td>".$row1['Name']."</td>
                        <td>".$row1['Email']."</td>
                       
                        </tr>";                        
                   $PayerCurrentBalance = $row1['Amount'];            
        }
    
      //SELECTING PAYEE DETAILS FROM ACCOUNTDETAILS TABLE
      $sql2 = "Select * from spark where ACCNo='$RECNo'";
      if($result = $conn->query($sql2)){
            //row2 contains payee details
            $row2 = $result->fetch_array();
                   echo "<tr> 
                        <td> Payee </td>
                        <td>".$row2['ACCNo']."</td>
                        <td>".$row2['Name']."</td>
                        <td>".$row2['Email']."</td>
                       
                        </tr>"; 
                    $PayeeCurrentBalance = $row2['Amount'];                       
           
           
        }               
        echo "</table>";
        $PayeeCurrentBalance += $AmountT;
        $PayerCurrentBalance -= $Amount;
        echo "<br>";
        echo "<table id = 'Table' style='margin-bottom:15px;'>
                <tr>
                    <th></th>
                    <th>Old Balance</th>
                    <th>New Balance</th>
                </tr>
                <tr>
                    <th>Payer</th>
                    <td style='color:black'>".$row1['Amount']."</td>                        
                    <td style='color:black'>".$PayerCurrentBalance."</td>
                </tr>
                <tr>
                    <th>Payee</th>
                    <td style='color:black'>".$row2['Amount']."</td>                        
                    <td style='color:black'>".$PayeeCurrentBalance."</td>
                </tr>";
        echo "</table>";
        //echo "Payer has available Balance = ".$row1['balance']."<br>";           
        //echo "Payer has available Balance = ".$PayerCurrentBalance."<br>";
        //echo "Payee has available Balance = ".$PayeeCurrentBalance."<br>";

       //FOR UPDATING DETAILS OF PAYER
       $updatepayer ="Update spark set Amount='$PayerCurrentBalance' where ACCNo='$ACCNo'";
       //FOR UPDATING DETAILS OF PAYEE
       $updatepayee ="Update spark set Amount='$PayeeCurrentBalance' where accID='$RECNo'";

       //CHECK IF PAYER DETAILS ARE UPADTED OR NOT 
       if($conn->query($updatepayer)==true){
            ?>         
            <script>console.log("PAYER DETAILS UPDATED!!")</script>
            <?php
       }
       else{
            ?>        
            <script>alert("PAYER DETAILS NOT UPDATED!!")</script>
            <?php
       }

       //CHECK IF PAYEE DETAILS ARE UPADTED OR NOT 
       if($conn->query($updatepayee)==true){
                ?>         
                <script>console.log("PAYEE DETAILS UPDATED! ")</script>
                <?php
        }
        else{
                ?>        
                <script>alert("PAYEE DETAILS NOT UPDATED! ERROR OCCURED!")</script>
                <?php
        }

        //SETTING TIME ZONE
        date_default_timezone_set('Asia/Kolkata');           
        $date = date('Y-m-d H:i:s',time());
        //echo "Current time is : ".$date;

        //FOR UPDATING HISTORY TABLE WHICH MAINTAINS RECORDS OF ALL TRANSACTIONS
        $InsertTransactTable ="Insert into history (payer, payerAcc, payee, payeeAcc, amount, time) values ('$row1[Name]','$row1[ACCNo]','$row2[Name]','$row2[ACCNo]','$Amount','$date')";
        //EXECUTING INSERT COMMAND AND CHECKING IF INSERTION WAS SUCCESSULL OR NOT
        if($conn->query($InsertTransactTable)==true){
                ?>         
                <script>console.log("Record of this transaction saved! ")</script>
                <?php
        }
        else{
                ?>        
                <script>alert("Record of this transaction saved! ERROR OCCURED!")</script>
                <?php
        }


        echo "<br>";
    echo "</div>";
    echo "</div>";
   // echo"<script>alert('Transaction successfull!!')</script>";
    //END OF ELSE OF PROCEED BUTTON
 // }

//IF ENDS HERE    
}else{
  ?>
  <h4>Transaction completed</h1>
  <?php
}




?>