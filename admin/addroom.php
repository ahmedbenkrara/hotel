<?php
session_start();
if(!isset($_SESSION['idA'])){
    header('location:login.php');
}

include('../user/pages/connect.php');

$query = "SELECT * FROM Categorie;";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

$query1 = "SELECT * FROM Chambre;";
$result1 = mysqli_query($con,$query1);
$data1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
mysqli_free_result($result1);

if(count($data1) == 0){
    $number = 1;
}else{
    $number = $data1[count($data1)-1]['numero'] + 1;
}


mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Room</title>
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
            <h1>Add A Room<h1>
            <div class="room">
              <form action="addR.php" method="post" enctype="multipart/form-data">
                <div class="rnum">
                    <input type="text" id="Rnumber" name="number" value="<?php echo $number ?>" placeholder="Room's Number" disabled>
                    <input type="text" id="Rprice" name="price" placeholder="Price">
                </div>
                <div>
                    <select name="cat" id="Scat" >
                    <option selected disabled>Select Category</option>
                    <?php for($i=0;$i<count($data);$i++){ ?>
                       <option value="<?php echo htmlspecialchars($data[$i]['idcat']) ?>"><?php echo htmlspecialchars($data[$i]['intitule']) ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div>
                    <textarea name="description" id="Sdes" placeholder="Description ..."></textarea>
                </div>
                <div>
                    <textarea name="amenties" id="Samenties" placeholder="Amenties"></textarea>
                </div>
                <div>
                    <input type="file" id="image" name="image">
                </div>
                <div>
                    <input type="radio" name="status" id="av" value="1">
                    <label for="cus"> Available</label>
                    <input type="radio" name="status" id="unav" value="0">
                    <label for="unav"> Unavailable</label>
                </div>
                <div>
                    <input type="submit" value="Add Room" id="addroom">
                </div>
              </form>
            </div>
        </div>
    </main>
    <script src="../user/jquery/jquery-3.5.1.js"></script>
    <script src="../user/jquery/addroom.js"></script>
</body>
</html>