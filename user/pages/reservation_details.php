<?php
    session_start();
    
    if(!isset($_SESSION['idC'])){
        header('location:login.php');
    }else{
        if(!isset($_GET['reservation'])){
            header("location:viewbooking.php");
        }else{
            $idC = $_SESSION['idC'];
            $idr = $_GET['reservation'];
                include("connect.php");
                $query = "SELECT reservation.*,Chambre.*,Categorie.intitule FROM reservation,Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND reservation.numero = chambre.numero AND reservation.idR = $idr AND reservation.idC = $idC;";
                $res = mysqli_query($con,$query);
                $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
                if(count($data) == 0){
                    header("location:viewbooking.php");
                }

        }

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
    <title>details</title>
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
            <div class="menu" onclick="window.location = 'password.php'">
                 <img src="../images/password.png" class="icon"/>
                 <p>Change Password</p>
            </div>
            <div class="logout" onclick="window.location = 'details.php?out=1';">
                 <img src="../images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
            <h1>Booking With Details</h1>
            <img class="cover" src="<?php echo "../../admin/".$data[0]['image'] ?>"/>
            <div class="details">
                 <div class="dleft">
                     <h2>Numero :</h2>
                     <div id="numero"><?php echo $data[0]['numero'] ?></div>
                     <h2>Description :</h2>
                     <div id="description"><?php echo $data[0]['description'] ?></div>
                     <h2>Amenties :</h2>
                     <div id="amenties"><?php echo $data[0]['amenties'] ?></div>
                     <h2>Category :</h2>
                     <div id="cat"><?php echo $data[0]['intitule'] ?></div>
                 </div>

                 <div class="dright" >
                     <h2>Number of people :</h2>
                     <div ><?php echo $data[0]['Nperson'] ?></div>
                     <h2>Price Paid :</h2>
                     <div id="pnp" style="color:red; font-weight:bold;"><?php echo $data[0]['prix']  ?>$</div>
                 </div>
            </div>
        </div>
    </main>
    <script src="../jquery/jquery-3.5.1.js"></script>
</body>
</html>