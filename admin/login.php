<?php

session_start();
if(isset($_SESSION['idA'])){
    header('location:rooms.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <Link rel="stylesheet" href="../user/css/loginuser.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../user/images/hotel.png" />
</head>
<body>
    <div class="main">
        <div class="left"></div>
        <div class="right">
            <img src="../user/images/hotel.png"/>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 386 50">
                <text id="Four_Seasons_Hotel" data-name="Four Seasons Hotel" transform="translate(0 40)" font-size="46" font-family="ForteMT, Forte"><tspan x="0" y="0">Four Seasons Hotel</tspan></text>
           </svg>
           <form action="logA.php" method="post">
               <input type="text" class="input" name="email" id="email" placeholder="Enter Your Email">
               <input type="password" class="input" name="pass" id="password" placeholder="Enter Your Password">
            </form>
               <input type="button" class="btn" value="Login" id="send">
            
          
        </div>
    </div>
</body>
    <script src="../user/jquery/jquery-3.5.1.js"></script>
    <script src="../user/jquery/loginA.js"></script>
</html>