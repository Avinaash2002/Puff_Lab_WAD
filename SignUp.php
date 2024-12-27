<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP - Puff Lab</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="Validation_Login_SignUp.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>

                <li class="dropdown">
                    <a href="products.html">Products</a>
                    <ul class="dropdown-menu">
                        <li><a href="products.html#regular">Regular</a></li>
                        <li><a href="products.html#deluxe">Deluxe</a></li>
                        <li><a href="products.html#luxury">Luxury</a></li>
                    </ul>
                </li>
                
                <li class="logo-container">
                    <a href="#" id="logo-link"><div class="logo" id="logo"></div></a>
                </li>
                <li><a href="contact.html">Contact Us</a></li>
                
                <!-- New Icons Section -->
            <li class="icon-container">
                <a href="search-page.html" class="icon-button">
                    <img src="images/icon1.png" alt="Search Icon" class="icon-img">
                </a>
            </li>
            <li class="icon-container">
                <a href="profile-page.html" class="icon-button">
                    <img src="images/icon2.png" alt="Profile Icon" class="icon-img">
                </a>
            </li>
            <li class="icon-container">
                <a href="cart.html" class="icon-button">
                    <img src="images/icon3.png" alt="Cart Icon" class="icon-img">
                </a>
            </ul>  
        </nav>
        
    </header>

    <div class="wrapper">
        <h1>Create your account!</h1>
        <p>Sign Up to unlock sweet deals</p>
        <br>
        <p id="error message" style="color: red; font-weight: bold;"></p>
        <form id="form" method="post">
            <div>
                <label for ="Username">Username</label>
                <input type="text" name="Username" id="Username-input" placeholder="Username">
            </div>
            <div>
                <label for ="PhoneNumber">Phone Number</label>
                <input type="text" name="PhoneNumber" id="PhoneNumber-input" placeholder="01X-XXXXXXXX">
            </div>
            <div>
                <label for ="Email">Email</label>
                <input type="email" name="Email" id="Email-input" placeholder="example@gmail.com">
            </div>
            <div class="user-box">
                <label for ="Passworde">Password</label>
                <input type="password" name="Password" id="Password-input" placeholder="Password">
                <span class="password-toggle-icon" onclick="togglePassword('Password-input', this)">
                    <i class="fas fa-eye"></i>
            </div>
            <div class="user-box">
                <label for ="Repeat-Password">Re-enter Password</label>
                <input type="password" name="Repeat-Password" id="Repeat-Password-input" placeholder="Re-enter Password">
                <span class="password-toggle-icon" onclick="togglePassword('Repeat-Password-input', this)">
                    <i class="fas fa-eye"></i>
            </div>
            <input type="submit" name="SignUp" value="Sign Up" style="margin-left:90px">
            <p>Already have an Account? <a href="Login.php">Login</a></p>
            </div>
        </form>
    </div>

    <footer>
        <p>PuffLab &copy; 2024</p>
    </footer>

</body>
</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'connect.php';

$mail = new PHPMailer(true);

if(isset($_POST['SignUp']))
{
    $Customer_username = $_POST['Username'];
    $Customer_PhoneNum = $_POST['PhoneNumber'];
    $Customer_Email = $_POST['Email'];
    $Customer_Password = $_POST['Password'];
    $Customer_Password = md5($Customer_Password);

    $checkusername1="SELECT * FROM members where username='$Customer_username'";
    $checkusername2="SELECT * FROM members where email='$Customer_Email'";
    $result1 = $conn->query($checkusername1);
    $result2 = $conn->query($checkusername2);
    if($result1->num_rows>0 && $result2->num_rows>0){

        ?>
        <script>

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The username and email already exist!. Proceed to Login",
            footer: '<a href="Login.php">proceed to Login</a>'
          });
        
        </script>
        <?php
    }
    elseif($result1->num_rows>0){

        ?>
        <script>

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The username already exist!",
            footer: '<a href="Login.php">proceed to Login</a>'
          });
        
        </script>
        <?php
    }
    elseif($result2->num_rows>0){

        ?>
        <script>

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The email already exist!",
            footer: '<a href="Login.php">proceed to Login</a>'
          });
        
        </script>
        <?php

    }
    else{
        $sql = "INSERT INTO members(username,phone_num,email,password) VALUES ('$Customer_username','$Customer_PhoneNum','$Customer_Email','$Customer_Password')";

            if($conn->query($sql)==TRUE){

                echo "<script>
                Swal.fire({
                    title: 'Sign Up Successful!',
                    text: 'Please proceed to login.',
                    icon: 'success',
                    footer: '<a href=\"Login.php\">Go to Login</a>',
                    draggable: true
                });
                </script>";

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'naash2024@gmail.com';                     //SMTP username
                $mail->Password   = 'egli xvbd ljkk mebd';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('naash2024@gmail.com', 'Puff Lab');
                $mail->addAddress($Customer_Email, $Customer_username);     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('82623@siswa.unimas.my');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('assets/Lab5.pdf', 'Lab5_WAD.pdf');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Test email - Lab5 WAD';
                $mail->Body    = 'If you can see this message, congratulations! You can now send and receive email using PHP mail function. <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
    
            }
            else{
                echo "Error:".$conn->error;
            }
    }
}

?>