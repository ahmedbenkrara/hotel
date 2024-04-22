<?php

    session_start();
    if(isset($_SESSION['idC'])){
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
    <Link rel="stylesheet" href="../css/loginuser.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../images/hotel.png" />
</head>
<body>
    <div class="main">
        <div class="left"></div>
        <div class="right">
            <img src="../images/hotel.png"/>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 386 50">
                <text id="Four_Seasons_Hotel" data-name="Four Seasons Hotel" transform="translate(0 40)" font-size="46" font-family="ForteMT, Forte"><tspan x="0" y="0">Four Seasons Hotel</tspan></text>
           </svg>
               <input type="text" class="input" name="" id="email" placeholder="Enter Your Email">
               <input type="password" class="input" name="" id="password" placeholder="Enter Your Password">
           <input type="button" class="btn" id="send" value="Login">
           <input type="button" class="btn" onclick="location.href='signup.php'" value="Sign Up">
        </div>
    </div>
    <script src="../jquery/jquery-3.5.1.js"></script>
    <script src="../jquery/login.js"></script>
</body>
</html>