<?php

if(isset($_POST['email']) && isset($_POST['pass'])){

    $email = $_POST['email'];
    $password = $_POST['pass'];

    include('connect.php');

    $query = "SELECT idC,pass,verified FROM Client WHERE email = '$email';";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count = count($data);
    mysqli_free_result($result);
    mysqli_close($con);
    if($count > 0){
        //user found
        //verify pass
        if(password_verify($password,$data[0]['pass'])){
            //correct

            //verify if email is confirmed
            if($data[0]['verified'] == 0){
                echo json_encode("2");
            }else if($data[0]['verified'] == 1){
                session_start();
                //$_SESSION['idC'] = 1;
                $_SESSION['idC'] = $data[0]['idC'];
                echo json_encode("3");
            }
            
        }else{
            //error pass
            echo json_encode("1");
        }
    }else{
        //user not found
        echo json_encode("0");
    }
    
}
?>