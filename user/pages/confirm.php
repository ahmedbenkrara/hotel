<?php

if(isset($_GET['email']) && $_GET['token']){

    $email = $_GET['email'];
    $token = $_GET['token'];

    include('connect.php');

    $query = "SELECT * FROM Client WHERE email = '$email' AND token = '$token';";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count = count($data);

    if($count > 0){
        $query = "UPDATE Client SET token = '',verified = 1 WHERE email = '$email';";
        mysqli_query($con,$query);
        header('location:login.php');
    }else{
        header('location:signup.php');
    }

}else{
    header('location:signup.php');
}

?>