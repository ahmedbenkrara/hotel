<?php
   use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['email']) && isset($_POST['name'])){

    $name =  $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

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
   $mail->setFrom($email,$name);
   $mail->addAddress('ahmed.benkrara11@gmail.com');
   $mail->Subject = $subject;
   $mail->Body = $message;
   if($mail->send()){
       $response = "Email sent with success";
   }else{
       $response = "Something went wrong : ".$mail->ErrorInfo;
   }

   exit(json_encode(array("response" => $response)));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/first.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../images/hotel.png" />
    <title>Welcome To Four Seasons</title>
</head>
<body>
        <header id="hdr1">
            <div class="cov">

               <nav>
               <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 843 132" class="svg1">
                   <text id="Four_Seasons" data-name="Four Seasons" fill="#f5f5f5" font-size="100" font-family="ForteMT, Forte"><tspan x="25" y="16">FOUR SEASONS</tspan></text>
               </svg>
                        <ul class="cat">
                            <li class="mn" onclick="location.href='#hdr1'">Home</li>
                            <li class="mn" onclick="location.href='#ab'">About</li>
                            <li class="mn" onclick="location.href='#contact'">Contact</li>
                            <li class="mn" onclick="location.href='Login.php'">Login</li>
                            <li class="mn" onclick="location.href='signup.php'">Sign Up</li>
                            <li class="menu"><img src="../images/menu.png" ></li>
                        </ul>
                        <ul class="cat1">
                        <img src="../images/close.png" >
                            <li onclick="location.href='#hdr1'">Home</li>
                            <li onclick="location.href='#ab'">About</li>
                            <li onclick="location.href='#contact'">Contact</li>
                            <li onclick="location.href='Login.php'">Login</li>
                            <li onclick="location.href='signup.php'">Sign Up</li>
                        </ul>
                </nav>

                <div class="welcoming">
                    <h1>DISCOVER</h1>
                    <h4>Four Seasons Hotel</h4>
                   <div class="explore" onclick="location.href='Login.php'"><p>Explore Now ...</p></div>
                </div>

            </div>
        </header>
        <div id="about">
            <h1 id="ab">Who are we ?</h1>
            <div>

The Four seasons hotel is a member of the Small Charming Hotels group, which has given a personal character to all its hotels, with all the following advantages:
Position in a quiet part of the historic center
Magic of times long gone
Quality services based on a professional approach to employees
Hospitality and excellent cuisine
History
The tradition of the Four Seasons hotel dates back to the 17th century when there was an inn called "Green Beef". Construction of the Masaryk station near the hotel was completed in 1845. Around this time, Prague began to accommodate the first steam trains. The hostel has been renovated and transformed into a hotel called "The English Court". Approximately 90 years later, in 1935, the hotel was renamed the Atlantic Hotel and it has retained that name to this day. The last complete renovation of the Atlantic Hotel took place in 2004. In 2015, the hotel entrance as well as the reception and lobby were rebuilt. The hotel is regularly modernized.
The Four Seasons Hotel today
The hotel's five-storey building offers its guests 65 very spacious and comfortable rooms. The hotel is served by two elevators. Some of the rooms face Na Poříčí Street and others face the courtyard. The hotel is accessible to people with reduced mobility (except for the conference hall).
The hotel includes the Havana lobby bar, the Fiesta restaurant (breakfasts 7: 00-10: 00, daily menu 11:00 - 14:30), a congress hall, a small lounge, a winter garden with a pool table.
A Wi-Fi internet connection is available free of charge throughout the hotel.
Car park
We offer the possibility of reserving a parking space for your car or motorbike directly at the Atlantic Hotel. The parking fees are 20 euros / day (10 euros / day for a motorbike). More details on the parking lot.
In our hotel, we respond responsibly to your wishes. Our staff are always ready to satisfy you and thus make your stay in Prague a pleasant one.
The management and employees of the Small Charming Hotels group look forward to your visit.
</div>
<img src="../images/who.jfif" class="aim"/>
        </div>

        <div class="contact" id="contact">
            <!--<form action="first.php" method="post">-->
              <div class="contact-form">
                  <h1>Contact Us</h1>
                  <div class="txtb">
                      <label>Full name :</label>
                      <input type="text" name="" id="name" placeholder="Enter Your Name">
                  </div>
                  <div class="txtb">
                      <label>Subject :</label>
                      <input type="text" name="" id="subject" placeholder="Enter Subject">
                  </div>
                  <div class="txtb">
                      <label>Email :</label>
                      <input type="text" name="" id="email" placeholder="Enter Your Email">
                  </div>
                  <div class="txtb">
                      <label>Message :</label>
                      <textarea name="" id="message" placeholder="Mesage"></textarea>
                  </div>
                  <input type="button" value="Send" id="send" class="send"/>
              </div>
              <!--</form>-->
        </div>
        <footer>
            <h3>Created by <mark>Ahmed BENKRARA</mark> copyrights &copy; 2021/2022</h3>
        </footer>

        <script src="../jquery/jquery-3.5.1.js"></script>
        <script src="../jquery/first.js"></script>
</body>
</html>