<?php
session_start();
if(!isset($_SESSION['idA'])){
    header('location:login.php');
}

if(!isset($_GET['id'])){
    header("location:rooms.php");
}else{
    $id = $_GET['id'];
    include("../user/pages/connect.php");
    $query = "SELECT * FROM Chambre WHERE numero = $id;";
    $res = mysqli_query($con,$query);
    $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
    if(count($data) == 0){
        header("location:rooms.php");
    }
    mysqli_free_result($res);

    $query1 = "SELECT * FROM Categorie;";
    $res1 = mysqli_query($con,$query1);
    $data1 = mysqli_fetch_all($res1,MYSQLI_ASSOC);
    mysqli_free_result($res1);
    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="../user/css/rooms.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../user/images/hotel.png" />
</head>
<body>
    <main class="main">
        <div class="left">
            <div class="menu" onclick="window.location = 'Addroom.php';">
                 <img src="../user/images/bed.png" class="icon"/>
                 <p>Add a Room</p>
            </div>
            <div class="menu" onclick="window.location = 'rooms.php';">
                 <img src="../user/images/edit.png" class="icon"/>
                 <p>Update Rooms</p>
            </div>
            <div class="menu" onclick="window.location = 'viewbooking.php';">
                 <img src="../user/images/view.png" class="icon"/>
                 <p>View Bookings</p>
            </div>
            <div class="menu" onclick="window.location = 'Addcat.php';">
                 <img src="../user/images/add.png" class="icon"/>
                 <p>Add Category</p>
            </div>
            <div class="logout" onclick="window.location = 'rooms.php?out=1';">
                 <img src="../user/images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
            <h1>Edit Room<h1>
            <div class="room">
              <form action="editR.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="rnum">
                    <input type="text" id="Rnumber" name="number"  placeholder="Room's Number" value="<?php echo $data[0]['numero'] ?>" disabled>
                    <input type="text" id="Rprice" name="price" placeholder="Price" value="<?php echo $data[0]['prix'] ?>">
                </div>
                <div>
                    <select name="cat" id="Scat" >
                    <option disabled>Select Category</option>
                    <?php for($i=0;$i<count($data1);$i++){ ?>
                       <?php if($data[0]['idcat'] == $data1[$i]['idcat']){ ?>
                            <option value="<?php echo $data1[$i]['idcat'] ?>" selected><?php echo $data1[$i]['intitule'] ?></option>
                       <?php }else{ ?>
                            <option value="<?php echo $data1[$i]['idcat'] ?>"><?php echo $data1[$i]['intitule'] ?></option>
                       <?php } ?>
                    <?php } ?>
                    </select>
                </div>
                <div>
                    <textarea name="description" id="Sdes" placeholder="Description ..."><?php echo $data[0]['description'] ?></textarea>
                </div>
                <div>
                    <textarea name="amenties" id="Samenties" placeholder="Amenties"><?php echo $data[0]['amenties'] ?></textarea>
                </div>
                <div>
                    <img src="<?php echo $data[0]['image'] ?>" class="edimg"/>
                    <input type="file" id="image" name="image">
                </div>
                <div>
                    <?php if($data[0]['status'] == 1){ ?>
                    <input type="radio" name="status" id="av" value="1" checked>
                    <?php }else{ ?>
                        <input type="radio" name="status" id="av" value="1">
                    <?php } ?>
                    <label for="cus"> Available</label>
                    <?php if($data[0]['status'] == 0){ ?>
                    <input type="radio" name="status" id="unav" value="0" checked>
                    <?php }else{ ?>
                        <input type="radio" name="status" id="unav" value="0">
                    <?php } ?>
                    <label for="unav"> Unavailable</label>
                </div>
                <div>
                    <input type="submit" value="Edit" id="addroom">
                </div>
              </form>
            </div>
        </div>
    </main>
    <script src="../user/jquery/jquery-3.5.1.js"></script>
    <script src="../user/jquery/addroom.js"></script>
    <script>
       /* const reader = new FileReader();
        document.querySelector("#image").addEventListener("change",function(){
            
            reader.addEventListener("load",function(){
                localStorage.setItem("recent",reader.result);
            });
         reader.readAsDataURL(this.files[0]);

        });
        
        const img = localStorage.getItem("recent");
        document.querySelector(".edimg").setAttribute("src",img);*/
    </script>
</body>
</html>