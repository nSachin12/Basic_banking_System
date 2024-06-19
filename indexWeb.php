
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sparks BankingSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body{
            background-image: url("i.avif");
            background-size: cover;
            margin:1px;
            box-sizing: border-box;
            position: fixed;
        }
        .menu{
            background-color: rgba(197, 149, 5, 0.897);
            color:rgb(15, 7, 0);
            font-weight: bold;
            margin-left: 1px;
            border-radius: 5px;
            display: inline-flex;
            position: fixed;
            width: 100%;
            padding-top: 2px;
        }
      .menu h2{
        margin-right: 700px;        
        margin-left: 10px;
      }
      .menu h3 a{
        padding:15px;
        border: 0px solid black;
        color: black;
        font-size: medium;
        text-decoration:none;
        font-weight: bolder;
      }
      .menu h3 a:hover{
            cursor:pointer;
            background-color: #1a2830e3;
            color:white;
      }
      .con{
        border: 2px solid rgba(7, 8, 5, 0.395);
        position: fixed;
        text-align: center;
        color: aliceblue;
        padding: 50px 50px;
        margin-left: 20%;
        margin-top: 100px;
        background-color: rgba(0, 0, 0, 0.444); /* Black w/opacity/see-through */
        border-radius: 10px;
        width: 40%;
        height: 70%;

      }
      input{
        margin: 5px;
        background-color: transparent;
        border: 1px solid rgb(123, 130, 131);
        color: rgb(253, 250, 250);
        border-radius:5px;
      }
     ::placeholder{
      color: aliceblue;
      font-size: small;
     }
      button:hover{
        background-color: rgb(4, 246, 8);
        color: rgb(19, 15, 15);
        border-radius: 5px;
      }

      .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: rgb(52, 125, 188);
        color: white;
        text-align: center;
        font-size: small; 
     }
     .footer p{
      margin-bottom: 1px;
     }
    
    </style>
</head>
<body>
    
    <div class="menu">
        <h2> SF Bank</h2>
        <h3><a href="">Home</a> </h3>
        <h3><a href="index.php">View All Custumers</a> </h3>
        <h3><a href="">Transfer Money</a> </h3>
    </div>
  
    <?php include('database1.php'); ?>

    <form class="con" name="Myform" action="transfer.php" method="post" onsubmit=" return ValidateForm()">
        <h3 style="color: aqua;">Well come to spak Foundation Bank</h3>
       <p style="font-weight:bolder; color:rgb(212, 134, 9);font-family: Arial, Helvetica, sans-serif;"> Make Easy Tranfaction from here</p>
       <div class="form-group">
       <input type="text" placeholder="Enter Your AC Number" name="ACCNo" ><br>
      </div>
      <div class="form-group">
       <input type="text" placeholder="Enter receipent AC Nuber" name="RECNo"><br>
      </div>
      <div class="form-group">
       <input type="number" placeholder="Enter Amount" name="Amount"><br>
      </div>

       <button  class="btn btn-success" name="transfer">Submit</button>
       <h4 style="color: aqua;">Have a safe tranfaction</h4>
         
    </form>
    <?php 
     if(isset($_GET['messages']))
     {
        echo "<h6>".$_GET['messages']."</h6>";
     }
    ?>

    <footer class="footer">
      <p>Banking system website developed by SACHIN (Cse)</p>
      <p> LinkedIN:<a href="https://www.linkedin.com/in/nadimidoddisachin/" style="color: black;"> www.linkedin.com/in/nadimidoddisachin</a></p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
      function ValidateForm()
      { 
        var x = document.forms["myform"]["ACCNo"].value;
            var y = document.forms["myform"]["RECNo"].value;
            var z = document.forms["myform"]["Amount"].value;
            var regex=/^[0-9]+$/;

            
            if (x == "" || y=="" || z=="") {
                alert("Fill it!!");
                return false;
            }
      }
     </script>
</body>
</html>