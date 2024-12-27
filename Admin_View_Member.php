<?php
include 'connect2.php';

$query = "select * from members";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puff Lab</title>
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="stylesheet" href="CSS/Admin_View_Member.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <table class ="table-container" id="customers" align="center" border="1px" style="line-height: 30px;">
            <tr>
                <th colspan="6">
                    <h2>Customer Record</h2>
                </th>
            </tr>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile Number</th>
            </tr>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $rows['username']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['phone_num']; ?></td>
                </tr>
            <?php
            }
            ?>
    </table>

    <footer>
        <p>PuffLab &copy; 2024</p>
    </footer>

</body>
<script>
    let clickCount = 0; // Initialize the click counter
    const logoLink = document.getElementById('logo-link'); // Reference the logo link element

    if (logoLink) {
        logoLink.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default navigation

            clickCount++; // Increment the click counter

            // Debug: Log the click count in the console
            console.log(`Logo clicked ${clickCount} times.`);

            // Redirect after 7 clicks
            if (clickCount > 7) {
                window.location.href = "Admin_Login.php";
            }
        });
    } else {
        console.error("Element with ID 'logo-link' not found.");
    }
</script>
</html>