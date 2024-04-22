<?php
    session_start();
    if(!isset($_SESSION['idC'])){
        header('location:login.php');
    }else{
        include('connect.php');

        if(isset($_POST['start'])){
            $start = $_POST['start'];
            $end = $_POST['end'];
            //$query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 AND Chambre.numero NOT IN (SELECT numero FROM reservation WHERE reservation.check_in_date <= '$start' AND reservation.check_out_date >= '$end');";
            $query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 AND Chambre.numero NOT IN (SELECT numero FROM reservation WHERE (reservation.check_in_date <= '$start' AND reservation.check_out_date >= '$end') OR (reservation.check_in_date = '$start' AND reservation.check_out_date < '$end'))";
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
    
           /* $query = "(SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 AND Chambre.numero NOT IN (SELECT numero FROM reservation WHERE (reservation.check_in_date <= '$start' AND reservation.check_out_date >= '$end') OR (reservation.check_in_date = '$start' AND reservation.check_out_date < '$end')) LIMIT $get,$res_page)";
            $result = mysqli_query($con,$query);
            $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            mysqli_close($con);*/

            $ciphering = "AES-128-CTR";
  
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
  
            $encryption_iv = '1234567891011121';
  
            $encryption_key = "GeeksforGeeks";
            $S = openssl_encrypt($start, $ciphering,
            $encryption_key, $options, $encryption_iv);
            $E = openssl_encrypt($end, $ciphering,
            $encryption_key, $options, $encryption_iv);

        }/*else{
            $query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1;";
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
    
            $query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 LIMIT $get,$res_page;";
            $result = mysqli_query($con,$query);
            $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            mysqli_close($con);
        }*/
    }

    if(isset($_GET['out'])){
        session_destroy();
        header('location:rooms.php');
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
            <h1>Rooms And Rates<h1>
            <form action="rooms.php" method="post">
            <div class="search">
            
                <input type="text" onfocus="(this.type='date')" name="start" class="input" placeholder="Date From" id="from" value="<?php if(isset($_POST['start'])){echo $_POST['start'];} ?>">
                <input type="text" onfocus="(this.type='date')" name="end" class="input" placeholder="Date To" id="to" value="<?php if(isset($_POST['end'])){echo $_POST['end'];} ?>">
                <input type="submit" class="btn" id="send" value="Search"> 
                  
            </div>
            </form>
                <div class="container">
                   <div class="grid">
                   <?php
                   if(isset($_POST['start'])){ 
                   for($i=0;$i<count($data);$i++){ 
                   ?>
                      <article>
                        <img src="<?php echo "../../admin/".$data[$i]['image'] ?>" />
                        <div class="text">
                           <h5><?php echo $data[$i]['intitule'] ?></h5>
                           <p>Price : <?php echo $data[$i]['prix'] ?>$</p>
                        </div>
                        <input type="button" class="but" onclick="document.location.href = 'details.php?id=<?php echo $data[$i]['numero']; ?>&from=<?php echo $S ?>&end=<?php echo $E ?>'" value="Book Now">
                       </article>
                    <?php }
                     if(count($data) == 0){
                        echo "<h6>No room is available !</h6>";
                     }
                    }else{
                        echo "<h6>Search for a room !</h6>";
                    }
                       
                   ?>
                   </div>
                </div>
               <!-- <div class="pagination">
                
                   if(isset($pages)){
                    $tmp = 1;
                    for($i=1;$i<=$pages;$i++){
                        
                        if($tmp == 1){
                            echo "<div>";
                        }
                        if($i == 1){
                            echo "<a class='page' href='rooms.php?page=$previous><</a>";
                        }
                        echo "<a class='page' href='rooms.php?page=$i>$i</a>";
                        if($i == $pages){
                            echo "<a class='page' href='rooms.php?page=$next>></a>";
                        }
                        if($tmp == 12){
                            echo "</div>";
                            $tmp = 1;
                        }
                        $tmp++;
                    }
                   }
                
                </div> -->

           
        </div>
    </main>
    <script src="../jquery/jquery-3.5.1.js"></script>
    <script src="../jquery/searchroom.js"></script>
</body>
</html>