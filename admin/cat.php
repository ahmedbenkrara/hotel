<?php
session_start();
if(!isset($_SESSION['idA'])){
    header('location:login.php');
}
if(isset($_POST['name'])){
    include('../user/pages/connect.php');
    $name = $_POST['name'];
    $des = $_POST['desc'];

    $query = "INSERT INTO Categorie(intitule,description) VALUES('$name','$des');";
    mysqli_query($con,$query);

    echo json_encode("0");
}

?>