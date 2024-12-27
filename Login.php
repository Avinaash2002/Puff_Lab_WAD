<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puff Lab</title>
    <link rel="stylesheet" href="CSS/Login.css">
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
                    <a href="index.html"><div class="logo"></div></a>
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
        <div class = "image-section">
            <img src="images/login_puff.png" alt="Crown puffs">
        </div>
        <div class="wrapper">
            <h1>Hello there, puff lover!</h1>
            <p>Log in to your account now, and let's get you back to those delicious cream puffs!</p>
            <br>
            <p id="error message" style="color: red; font-weight: bold;"></p>
            <form id="form" method="post">
                <div>
                    <label for ="Username">Username</label>
                    <input type="text" name="Username" id="Username-input" placeholder="Username">
                </div>
                <div class="user-box">
                    <label for ="Passworde">Password</label>
                    <input type="password" name="Password" id="Password-input" placeholder="Password">
                    <span class="password-toggle-icon" onclick="togglePassword('Password-input', this)">
                        <i class="fas fa-eye"></i>
                </div>
                <input type="submit" name="Login" value="Login" style="margin-left:90px">
                <div class="New">
                    <p>New to Puff Lab? <a href="SignUp.html">Sign Up</a> here!</p>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p class="id">PuffLab &copy; 2024</p>
    </footer>

</body>
</html>

<?php

include 'connect.php';


if(isset($_POST['Login']))
{
    $Customer_username = $_POST['Username'];
    $Customer_Password = $_POST['Password'];
    $Customer_Password = md5($Customer_Password);

    $result = mysqli_query($conn, "SELECT * FROM members where username='$Customer_username'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){

        if($Customer_Password == $row["password"]){
            $_SESSION["Login"] = true;
            $_SESSION["id"] = $row["id"];

            echo "<script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User Login Successful',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                // Redirect to the user homepage after SweetAlert
                setTimeout(() => { window.location.href = 'User_homepage.php'; }, 300);
            });
            </script>";
        }
        else{

            echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Incorrect password!',
                });
            </script>";

        }
        
    }
    else{

        echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User not Registered',
                });
            </script>";
          
    }
}
?>