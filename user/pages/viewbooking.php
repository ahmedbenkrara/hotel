<?php
session_start();

if(!isset($_SESSION['idC'])){
    header('location:login.php');
}else{
    include('connect.php');
$idC = $_SESSION['idC'];
$query = "SELECT reservation.*,Chambre.*,Categorie.intitule FROM reservation,Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND reservation.numero = chambre.numero AND reservation.idC = $idC;";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);


$res_page = 12;

$pages = ceil(count($data)/$res_page);

if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$get = ($page-1)*$res_page;

$previous = $page;
$next = $page;
if($page > 1){
    $previous = $page -1;
}

if($page < $pages){
    $next = $page+1;
}


$query = "SELECT reservation.*,Chambre.*,Categorie.intitule FROM reservation,Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND reservation.numero = chambre.numero AND reservation.idC = $idC LIMIT $get , $res_page;";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
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
            <div class="logout" onclick="window.location = 'rooms.php?out=1';">
                 <img src="../images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
            <h1>Booked Rooms<h1>
            <div class="container">
                <div class="grid">

                <?php for($i=0;$i<count($data);$i++){ ?>
                <article>
                    <img src="../../admin/<?php echo $data[$i]['image'] ?>" />
                    <div class="text">
                        <h5><?php echo $data[$i]['intitule'] ?></h5>
                        <p>Room : <?php echo $data[$i]['numero'] ?></p>
                    </div>
                        <input type="button" class="but" onclick="document.location.href = 'reservation_details.php?reservation=<?php echo $data[$i]['idR']; ?>'" value="Details">
                </article>
                <?php }
                     if(count($data) == 0){
                       echo "<h6>No Rooms Booked</h6>";
                     }
                ?>

                </div>
                <div class="pagination">
                <?php 
                    $tmp = 1;
                    for($i=1;$i<=$pages;$i++){
                        
                        if($tmp == 1){
                            echo "<div>";
                        }
                        if($i == 1){
                            echo "<a class='page' href='viewbooking.php?page=$previous'><</a>";
                        }
                        echo "<a class='page' href='viewbooking.php?page=$i'>$i</a>";
                        if($i == $pages){
                            echo "<a class='page' href='viewbooking.php?page=$next'>></a>";
                        }
                        if($tmp == 12){
                            echo "</div>";
                            $tmp = 1;
                        }
                        $tmp++;
                    }
                ?>
                </div>
            </div>

        </div>
    </main>
    <script src="../jquery/jquery-3.5.1.js"></script>
</body>
</html>