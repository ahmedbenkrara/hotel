<?php

if(isset($_GET['id'])){
        include("../user/pages/connect.php");
        $id = $_GET['id'];
        $path = "";
        if($_FILES['image']['name'] != ""){
            $file = $_FILES['image'];
            $filename = $_FILES['image']['name'];
            $filetmp = $_FILES['image']['tmp_name'];
    
            $filext = explode('.',$filename);
            $fileact = strtolower(end($filext));
    
            $name = uniqid('',true).".".$fileact;
            $path = 'images/'.$name;
        }else{
            $query = "SELECT * FROM Chambre WHERE numero = $id;";
            $res = mysqli_query($con,$query);
            $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            $path = $data[0]['image'];
        }
        $path = mysqli_real_escape_string($con,$path);
        $prix = $_POST['price'];
        $cat = $_POST['cat'];
        $description = $_POST['description'];
        $description = mysqli_real_escape_string($con,$description);
        $amenties = $_POST['amenties'];
        $amenties = mysqli_real_escape_string($con,$amenties);
        $status = $_POST['status'];
    
        $update = "UPDATE Chambre SET image = '$path' , description = '$description' , idcat = $cat , amenties = '$amenties' , prix = $prix , status = $status WHERE numero = $id;";
        mysqli_query($con,$update);
        move_uploaded_file($filetmp,$path);
        header("location:editroom.php?id=$id");
}else{
    header("location:rooms.php");
}

?>