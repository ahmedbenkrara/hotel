<?php
    session_start();
    
    if(!isset($_SESSION['idC'])){
        header('location:login.php');
    }else{
        if(!isset($_GET['id']) || !isset($_GET['from']) || !isset($_GET['end'])){
            header("location:rooms.php");
        }else{
            $id = $_GET['id'];
            $idC = $_SESSION['idC'];
            $S = $_GET['from'];
            $E = $_GET['end'];
            $error = 1;
            $ciphering = "AES-128-CTR";
  
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
  
            $encryption_iv = '1234567891011121';
            $decryption_iv = '1234567891011121';
            $decryption_key = "GeeksforGeeks";
            $start=openssl_decrypt ($S, $ciphering, 
            $decryption_key, $options, $decryption_iv);
            $end = openssl_decrypt ($E, $ciphering, 
            $decryption_key, $options, $decryption_iv);
            
            $date1 = strtotime($start);
            $date2 = strtotime($end);
            $days = ($date2 - $date1)/(60 * 60 * 24);

            if($days == 0){
                $days = 1;
            }

            if(date_parse($start) > date_parse($end)){
                header('location:rooms.php');
            }else{
                include("connect.php");
                //$query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND numero = $id AND status = 1;";
                            $query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 AND numero = $id AND Chambre.numero NOT IN (SELECT reservation.numero FROM reservation WHERE reservation.check_in_date <= '$start' AND reservation.check_out_date >= '$end');";
                            $res = mysqli_query($con,$query);
                            $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
                            if(count($data) == 0){
                                header("location:rooms.php");
                            }
                            $prix = $data[0]['prix'];
                            mysqli_free_result($res);
                            
            }

        }

        if(isset($_GET['Number'])){
            if((int)$_GET['Number'] < 1 || (int)$_GET['Number'] > 4 || $_GET['Number'] == ""){
                $error = 1;
            }else{
                $error = 0;
            }
        }

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
    <title>Book a room</title>
    <link rel="stylesheet" href="../css/rooms.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../images/hotel.png" />
    <script src="https://www.paypal.com/sdk/js?client-id=AbCUAZWhtUeOHlxEXyGdCZlRsxM6oQTp5IxB-5zAKjyVpJjn5RhUb13fa4UxLCqATxS51mNKl6i3uuML&disable-funding=credit,card"></script>
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
                     <h2 style="margin-bottom:10px;">Number of people :</h2>
                     <div><form id="frm" action="" method="post">
                     <input type="number" min="1" max="4" class="Nperson" name="N" value="<?php if(isset($_GET['Number'])){echo $_GET['Number'] ;} ?>" placeholder="Number of persons">
                     </form>
                     </div>
                 </div>

                 <div class="dright" >
                     <h2>Price for night :</h2>
                     <div id="pwt"><?php echo $data[0]['prix'] ?>$</div>
                     <h2>Price for <?php echo $days; ?> days Without Tax :</h2>
                     <div id="pwt"><?php echo $data[0]['prix'] * $days ?>$</div>
                     <h2>Tax :</h2>
                     <div id="tax"><?php echo $data[0]['prix']*0.14 ?>$</div>
                     <h2>Price You Need To Pay :</h2>
                     <div id="pnp" style="color:red; font-weight:bold;"><?php echo $data[0]['prix']*0.14 +$data[0]['prix']*$days  ?>$</div>
                     <div id="paypal" id="cash" class="pay"></div>
                     <div><input type="button" class="pay" value="Pay Cash" id="cash"></div>
                     <!--<div><input type="button" class="pay" value="Pay With Paypal" id="paypal"></div>-->

                 </div>
            </div>
        </div>
    </main>
    <script src="../jquery/jquery-3.5.1.js"></script>
    <script>
    var price = <?php echo $data[0]['prix']*0.14 +$data[0]['prix']*$days ?>;
    var prix = <?php echo $data[0]['prix'] ?>;
    var days = <?php echo $days ?>;

    var Nperson = 1;
    paypal.Buttons({
        style:{
            color:'black',
            shape:'pill',
            height:30,
            label:'pay'
        },
        createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: price
            }
          }]
        });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert("Room booked with success !");
                window.location.href="booknow.php?id=<?php echo $id; ?>&Number=<?php if(isset($_GET['Number'])) echo $_GET['Number'];?>&from=<?php echo $start ?>&to=<?php echo $end ?>&status=1&price="+price+"&prix="+prix+"&days="+days+"";
            });
        },
        onCancel:function(data,actions){
            actions.redirect();
            alert("canceled");
        }
    }).render('#paypal');

    $("#paypal").hide();
    $("#cash").hide();

    var np = $(".Nperson").first();
    np.change(function(){
        if(np.val() == "" || parseInt(np.val()) < 1 || parseInt(np.val()) > 4){
            np.css("border","2px solid red");
            np.prop("title","Number f persons should be between 1 and 4 !");
            $("#paypal").hide();
            $("#cash").hide();
        }else{
            np.css("border","2px solid black");
            np.removeAttr("title");
            $("#paypal").show();
            $("#cash").show();
            Nperson = $(".Nperson").first().val();
            var start = "<?php echo $start; ?>";
            var n = window.location.toString().indexOf("Number");
            if(n == -1){
                $("#frm").prop("action",window.location.toString() + `&Number=${Nperson}`);
            }else{
                var link = window.location.toString();
                link = link.slice(0,n+7)+Nperson;
                $("#frm").prop("action",link);
            }
            
            $("#frm").submit();
        }
    });

    var error = "<?php echo $error; ?>";
    if(parseInt(error) == 1){
        np.css("border","2px solid red");
        np.prop("title","Number f persons should be between 1 and 4 !");
        $("#paypal").hide();
        $("#cash").hide();
    }else{
        np.css("border","2px solid black");
            np.removeAttr("title");
            $("#paypal").show();
            $("#cash").show();
    }

    $("#cash").click(function(){
        alert("Room booked with success !");
        window.location.href="booknow.php?id=<?php echo $id; ?>&Number=<?php if(isset($_GET['Number'])) echo $_GET['Number'];?>&from=<?php echo $start ?>&to=<?php echo $end ?>&status=0&price="+price+"&prix="+prix+"&days="+days+"";
    });

    </script>
    
</body>
</html>