<?php
    session_start();
    if(!isset($_SESSION['idC'])){
        header('location:login.php');
    }

    if(isset($_GET['out'])){
        session_destroy();
        header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Room</title>
    <link rel="stylesheet" href="../css/rooms.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../images/hotel.png" />
</head>
<body>
    <main class="main">
        <div class="left">
            <div class="menu" onclick="window.location = 'rooms.php'">
                 <img src="../images/bed.png" class="icon"/>
                 <p>Find a Room</p>
            </div>
            <div class="menu" onclick="window.location = 'viewbooking.php'">
                 <img src="../images/saved.png" class="icon"/>
                 <p>Rooms You Reserved</p>
            </div>
            <div class="menu" >
                 <img src="../images/password.png" class="icon"/>
                 <p>Change Password</p>
            </div>
            <div class="logout" onclick="window.location = 'rooms.php?out=1';">
                 <img src="../images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
        <h1>Change Password<h1>
                <div class="center">
                    <div style="margin-bottom:10px;">
                       <input type="password" name="actual" id="cate" class="actual" placeholder="actual password" style="margin-bottom: inherit;">
                    </div>
                    <div style="margin-bottom:10px;">
                       <input type="password" name="new" id="cate1" class="new" placeholder="New Password" style="margin-bottom: inherit;">
                    </div>
                    <div style="margin-bottom:10px;">
                       <input type="password" name="new1" id="cate2" class="new1" placeholder="Verify New Password" style="margin-bottom: inherit;">
                    </div>
                    <div>
                       <input type="button" value="Change Password" id="sendpass">
                    </div>
                </div>
        </div>
        </div>
    </main>
    <script src="../jquery/jquery-3.5.1.js"></script>
    <script src="../jquery/password.js"></script>
</body>
</html>