<?php 
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET['id'])){
    session_start();
    $idC = $_SESSION['idC'];
    $N = $_GET['Number'];
    $id = $_GET['id'];
    $start = $_GET['from'];
    $end = $_GET['to'];
    $prix = $_GET['price'];
    $status = $_GET['status'];
    $days = $_GET['days'];
    //price for 1 night
    $price = $_GET['prix'];
    $tax = $price * 0.14;
    $pwt = $price * $days;
    $pt = $pwt + $tax;
    include("connect.php");
    /*$query = "SELECT Chambre.*,Categorie.intitule FROM Chambre,Categorie WHERE Chambre.idcat = Categorie.idcat AND Chambre.status = 1 AND numero = $id AND Chambre.numero NOT IN (SELECT reservation.numero FROM reservation WHERE reservation.check_in_date <= '$start' AND reservation.check_out_date >= '$end');";
    $res = mysqli_query($con,$query);
    $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
    if(count($data) == 0){
        header("location:rooms.php");
    }
    $prix = $data[0]['prix'];
    mysqli_free_result($res);*/

    $insert = "INSERT INTO Reservation(idC,Nperson,numero,prix,paystatus,check_in_date,check_out_date) VALUES($idC,$N,$id,$prix,$status,'$start','$end');"; 
    mysqli_query($con,$insert);
    $query = "SELECT prenom,email FROM Client WHERE idC = $idC;";
    $res = mysqli_query($con,$query);
    $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $name = $data[0]['prenom'];
    $email = $data[0]['email'];
    $pay = "";
    if($status == 0){
        $pay = "Price You Need To Pay :";
    }else{
        $pay = "Price You Payed :";
    }
    $message = "
    <h2>Hello <b>Mr/Mrs</b> ".$name." you have booked a room with the following details :</h2><br/><br/>
    <table style='border-collapse: collapse; border-radius:20px; font-family:cursive;'>
        <tr>
            <th style='border:2px solid orangered; padding:8px; color:white; background:orangered;'>Room's Number</th>
            <th style='border:2px solid orangered; padding:8px; color:white; background:orangered;'>Price for one night</th>
            <th style='border:2px solid orangered; padding:8px; color:white; background:orangered;'>For</th>
            <th style='border:2px solid orangered; padding:8px; color:white; background:orangered;'>From</th>
            <th style='border:2px solid orangered; padding:8px; color:white; background:orangered;'>To</th>
        </tr>
        <tr>
            <td style='border:2px solid orangered; padding:8px; font-family:cursive;'><b>$id</b></td>
            <td style='border:2px solid orangered; padding:8px;' font-family:cursive;><b>$prix $</b></td>
            <td style='border:2px solid orangered; padding:8px;' font-family:cursive;><b>$N people</b></td>
            <td style='border:2px solid orangered; padding:8px;' font-family:cursive;><b>$start</b></td>
            <td style='border:2px solid orangered; padding:8px;' font-family:cursive;><b>$end</b></td>
        </tr>
    </table><br/><br/><br/>
    <h1 style='color:red;'>Your Bills :</h1><br/><br/>
    <h2>Price for $days nights Without Tax : <span style='color:orangered;'> $pwt </span>$</h2><br/>
    --------------------------------------------------------------<br/>
    <h2>Tax : <span style='color:orangered;'>$tax</span> $</h2><br/>
    --------------------------------------------------------------<br/>
    <h2>$pay  <span style='color:orangered;'>$pt</span>$</h2>
    ";

    require_once "../PHPMailer/src/PHPMailer.php";
    require_once "../PHPMailer/src/SMTP.php";
    require_once "../PHPMailer/src/Exception.php";
 
    $mail = new PHPMailer();
 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ahmed.benkrara11@gmail.com';
    $mail->Password = 'ahmedbenkrara123'; 
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
 
    $mail->isHTML(true); 
    $mail->setFrom("hello@fourseasonshotel.com","FourSeasons Hotel");
    $mail->addAddress($email);
    $mail->Subject = 'Welcome To Four Seasons Hotel';
    $mail->Body = $message;
    $mail->send();

    header("location:rooms.php");
}else{
    header("location:rooms.php");
}
?>