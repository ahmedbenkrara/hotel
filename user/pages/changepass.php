<?php
    if(isset($_POST['actual'])){

            $actual = htmlspecialchars($_POST['actual']);
            $New = htmlspecialchars($_POST['New']);
            $New1 = htmlspecialchars($_POST['New1']);
            session_start();
            $id = $_SESSION["idC"];
  
                include("connect.php");

                $query = "SELECT * FROM Client WHERE idC = $id;";
                $res = mysqli_query($con,$query);
                $data = mysqli_fetch_all($res,MYSQLI_ASSOC);

                if(password_verify($actual,$data[0]["pass"])){
                    if($actual == $New){
                        //should enter new pass
                        echo json_encode("-1");
                    }else{
                        //should be updated
                        $pass = password_hash($New,PASSWORD_BCRYPT);
                        $query = "UPDATE Client SET pass = '$pass' WHERE idC = $id";
                        mysqli_query($con,$query);

                        echo json_encode("0");
                    }
                }else{
                    //wrong pass
                    echo json_encode("1");
                }

    }
?>