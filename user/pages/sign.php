<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["fname"])){
    $fname = htmlspecialchars($_POST['fname']);
    $sname = htmlspecialchars($_POST['sname']);
    $cin = htmlspecialchars($_POST['cin']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);
    $phone = htmlspecialchars($_POST['phone']);
    $bdy = htmlspecialchars($_POST['bdy']);

    $Hashed = password_hash($pass,PASSWORD_BCRYPT);

    $token = 'qzaesdrftgyhbvcxwkijhlmpoAYSEXRTQOMLKJHBG0321456879!$/()*';
    $token = str_shuffle($token);
    $token = substr($token,0,10);

    include('connect.php');

    $query = "SELECT * FROM Client WHERE email = '$email';";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count = count($data);
    mysqli_free_result($result);

    $query1 = "SELECT * FROM Client WHERE cin = '$cin';";
    $result1 = mysqli_query($con,$query1);
    $data1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
    $count1 = count($data1);
    mysqli_free_result($result1);
   
    $error = -1;
    if($count > 0 && $count1 > 0){
        $error = 11;
    }else if($count > 0 && $count1 == 0){
        $error = 0;
    }else if($count == 0 && $count1 > 0){
        $error = 1;
    }

    if($error == 0 || $error == 1 || $error == 11){
        echo json_encode($error);
    }else{
        $query = "INSERT INTO Client(cin,prenom,nom,email,pass,phone,date_de_naissance,token,verified) VALUES('$cin','$fname','$sname','$email','$Hashed','$phone','$bdy','$token',0);";
        mysqli_query($con,$query);

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
        $mail->setFrom("hello@fourseasonshotel.com","ahmed");
        $mail->addAddress($email);
        $mail->Subject = 'Please Verify Email';
        $mail->Body = "
        <a href='http://127.0.0.1/PFF/user/pages/confirm.php?email=$email&token=$token'>Please Click On Me To Verify Your Email</a>

        ";
        $mail->send();
        echo json_encode("You signed up with success, confirm your email");
    }
}else{
    header('location:signup.php');
}

mysqli_close($con);
?>