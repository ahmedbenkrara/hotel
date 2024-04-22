<?php
session_start();
if(!isset($_SESSION['idA'])){
    header('location:login.php');
}
    include("../user/pages/connect.php");
    $query = "SELECT Client.*,Reservation.* FROM Client,Reservation WHERE Client.idC = reservation.idC;";
    $res = mysqli_query($con,$query);
    $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
    mysqli_free_result($res);
    mysqli_close($con);
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
  <style>
      .dataTables_wrapper .dataTables_filter input {
          margin-left: 0.5em;
          outline: none;
       }
  </style>
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
            <div class="logout">
                 <img src="../user/images/logout.png" class="out"/>
                 <p>Logout</p>
            </div>
        </div>
        <div class="right">
            <h2>View Booking</h2>
            <div style="padding-left:10px; padding-right:10px;">
            <div class="table-responsive">
            <table class="table table-hover " id="myTable">
                <thead class="thead-dark">
                    <tr>
                       <th>CIN</th>
                       <th>First name</th>
                       <th>Second name</th>
                       <th>Room</th>
                       <th>N person</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Check in</th>
                       <th>Check out</th>
                       <th>Price</th>
                       <th>Pay method</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($data);$i++){ ?>
                    <tr>
                       <th><?php echo $data[$i]['cin'] ?></th>
                       <td><?php echo $data[$i]['prenom'] ?></td>
                       <td><?php echo $data[$i]['nom'] ?></td>
                       <td><?php echo $data[$i]['numero'] ?></td>
                       <td><?php echo $data[$i]['Nperson'] ?></td>
                       <td><?php echo $data[$i]['email'] ?></td>
                       <td><?php echo $data[$i]['phone'] ?></td>
                       <td><?php echo $data[$i]['check_in_date'] ?></td>
                       <td><?php echo $data[$i]['check_out_date'] ?></td>
                       <td><?php echo $data[$i]['prix'] ?>$</td>
                       <?php if($data[$i]['paystatus'] == 1){ ?>
                       <td>Paypal</td>
                       <?php }else{ ?>
                       <td>Cash</td>
                       <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
           </table>
           </div>
           </div>
        </div>
    </main>
    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    });
    </script>
</body>
</html>