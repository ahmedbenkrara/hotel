<?php
   if(isset($_POST['email']) && isset($_POST['pass'])){

    $email = $_POST['email'];
    $password = $_POST['pass'];

    include('../user/pages/connect.php');

    $query = "SELECT idA,pass FROM Admin WHERE email = '$email';";
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
                session_start();
                $_SESSION['idA'] = $data[0]['idA'];
                echo json_encode("2");
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