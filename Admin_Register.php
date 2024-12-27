<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puff Lab</title>
    <link rel="stylesheet" href="CSS/Admin_Register.css">
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

    <div class="login-container">
        <div class="wrapper">
            <h1>Administrator Registration</h1>
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
                <input type="submit" name="Register" value="Register" style="margin-left:90px">
            </form>
        </div>
    </div>

    <footer>
        <p>PuffLab &copy; 2024</p>
    </footer>

</body>
</html>

<?php

include 'connect2.php';

if(isset($_POST['Register']))
{
    $Admin_username = $_POST['Username'];
    $Admin_PhoneNum = $_POST['PhoneNumber'];
    $Admin_Email = $_POST['Email'];
    $Admin_Password = $_POST['Password'];
    $Admin_Password = md5($Admin_Password);

    $checkusername1="SELECT * FROM admin where username='$Admin_username'";
    $checkusername2="SELECT * FROM admin where email='$Admin_Email'";
    $result1 = $conn->query($checkusername1);
    $result2 = $conn->query($checkusername2);
    if($result1->num_rows>0 && $result2->num_rows>0){

        ?>
        <script>

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The username and email already exist!. Proceed to Admin Login",
            footer: '<a href="Admin_Login.php">proceed to Login</a>'
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
            footer: '<a href="Admin_Login.php">proceed to Login</a>'
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
            footer: '<a href="Admin_Login.php">proceed to Login</a>'
          });
        
        </script>
        <?php

    }
    else{
        $sql = "INSERT INTO admin(username,phone_num,email,password) VALUES ('$Admin_username','$Admin_PhoneNum','$Admin_Email','$Admin_Password')";

            if($conn->query($sql)==TRUE){

                echo "<script>
                Swal.fire({
                    title: 'Registration Successful!',
                    text: 'Please proceed to Admin login.',
                    icon: 'success',
                    footer: '<a href=\"Admin_Login.php\">Go to Login</a>',
                    draggable: true
                });
                </script>";
            }
            else{
                echo "Error:".$conn->error;
            }
    }
}

?>