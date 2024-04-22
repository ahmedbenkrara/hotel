<?php

$file = $_FILES['image'];
$filename = $_FILES['image']['name'];
$filetmp = $_FILES['image']['tmp_name'];

$filext = explode('.',$filename);
$fileact = strtolower(end($filext));

$name = uniqid('',true).".".$fileact;
$path = 'images/'.$name;
include('../user/pages/connect.php');

$query = "SELECT * FROM Chambre;";
$res = mysqli_query($con,$query);
$data = mysqli_fetch_all($res,MYSQLI_ASSOC);

if(count($data) == 0){
    $number = 1;
}else{
    $number = $data[count($data)-1]['numero'] + 1;
}



$price = $_POST['price'];
$price = (int)$price;
$cat = $_POST['cat'];
$description = $_POST['description'];
$description = mysqli_real_escape_string($con,$description);
$amenties = $_POST['amenties'];
$amenties = mysqli_real_escape_string($con,$amenties);
$status = $_POST['status'];
$status = (int)$status;

echo $number.' '.$price.' '.$cat.' '.$description.' '.$amenties.' '.$status;


$query1 = "INSERT INTO Chambre(numero,image,description,idcat,amenties,prix,status) VALUES($number,'$path','$description',$cat,'$amenties',$price,$status);";
mysqli_query($con,$query1);
move_uploaded_file($filetmp,$path);


mysqli_close($con);
header('location:Addroom.php');
?>