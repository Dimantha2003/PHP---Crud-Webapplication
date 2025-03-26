<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Arcade Alley</title>
    
    
    <link rel="stylesheet" href="css/style-home.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/headerstyle.css">
    
    
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/ff0d0f7bd0.js" crossorigin="anonymous"></script>
</head>
<body>

    <!--THIS IS HEADER!!!!-->
    <header class="header"><a href="home.php">
        <h1 class="title">ARCADE ALLEY</h1>
        <p class="subtitle">DISCOVER. PLAY. CONQUER.</p>
    </a>
    </header>
    <!--THIS IS HEADER!!!!-->
    <nav class="navbar">
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="video-games.php">Video Games</a></li>
                <li><a href="gaming-consoles.php">Gaming Consoles</a></li>
                <li><a href="gaming-accessories.php">Accessories</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <div class="search-container">
                <form action="search.php" method="post">
                <input type="text" class="search-input" placeholder="Search Products..." name="searchbar">
                <button type="submit" class="search-btn" name="searchsub" style="background-color: transparent;"><i class="fa-solid fa-magnifying-glass" ></i></button>
                </form>
            </div>
            <div class="add-to-cart">
                <button class="add-cart" class="cart-btn" style="background-color: transparent;">
                    <a href="cart.php" style="color:white;"><i class="fa-solid fa-cart-shopping"></i></a>
                </button>
            </div>
            <div class="auth-container">
                <button class="user-icon" onclick="toggleAuthButtons()" style="background-color: transparent;"><i class="fa-solid fa-user"></i></button>
                <div class="auth-buttons">
                    <?php
                        if(isset($_SESSION['position']))
                        {
                            if($_SESSION['position'] != "admin") $url = "myaccount.php";else $url="dashboard.php";
                            if(isset($_SESSION['user']))                        
                            {
                                echo '<button class="auth-btn" onclick="location.href=\''.$url.'\'"><i class="fa-solid fa-user"></i>Account</button>';
                            }
                        }
                        else
                        {
                            echo '<button class="auth-btn" onclick="location.href=\'login.php\'"><i class="fa-solid fa-clipboard"></i>LOGIN</button>';
                        }
                    ?>
                    
                    
                </div>
            </div>
        </nav>