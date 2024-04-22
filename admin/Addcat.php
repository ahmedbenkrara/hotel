<?php
session_start();
if(!isset($_SESSION['idA'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="../user/css/rooms.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../user/images/hotel.png" />
</head>
<body>
    <main class="main">
        <div class="left">
            <div class="menu" onclick="window.location = 'Addroom.php';">
                 <img src="../user/images/bed.png" class="icon"/>
                 <p>Add a Room</p>
            </div>
            <div class="menu" onclick="window.location = 'rooms.php';">
                 <img src="../user/images/edit.png" class="icon"/>
                 <p>Update Rooms</p>
            </div>
            <div class="menu" onclick="window.location = 'viewbooking.php';">
                 <img src="../user/images/view.png" class="icon"/>
                 <p>View Bookings</p>
            </div>
            <div class="menu" onclick="window.location = 'Addcat.php';">
                 <img src="../user/images/add.png" class="icon"/>
                 <p>Add Category</p>
            </div>
            <div class="logout" onclick="window.location = 'rooms.php?out=1';">
                 <img src="../user/images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
            <h1>Add Category<h1>
                <div class="center">
                    <div>
                       <input type="text" name="" id="cate" placeholder="cat name">
                    </div>
                    <div>
                       <textarea name="" id="desc" placeholder="Description ..."></textarea>
                    </div>
                    <div>
                       <input type="button" value="Add a new cat" id="add">
                    </div>
                </div>
        </div>
    </main>
    <script src="../user/jquery/jquery-3.5.1.js"></script>
    <script src="../user/jquery/addcat.js"></script>
</body>
</html>