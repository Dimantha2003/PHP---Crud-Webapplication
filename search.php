<?php include('include/connection.php');
      $errors = array();
      $code = '';
?>

<?php
    if(isset($_POST['searchsub']))
    {
        $key = mysqli_real_escape_string($connection,$_POST['searchbar']);
        $query = "SELECT * FROM product WHERE (title LIKE '%{$key}%') and isDeleted='no'";
        $result = mysqli_query($connection,$query);
        if($result) 
        {
            if(mysqli_num_rows($result)>0)
            {
                while($rec = mysqli_fetch_assoc($result)) 
                {
                    $code .= '<div class="videogames">';
                    $code .= '<a href="/crud/product.php?pid='.$rec['id'].'">';
                    $code .= '<p>'.$rec['nickName'];
                    $code .= '</p><img src="'.$rec['img'].'"><p>Rs.';
                    $code .= number_format($rec['price']).'.00</p></a></div>';
                }           
            }
            else $errors[] = "No item to Display";
        }
    }
    
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Arcade Alley</title>
    <link rel="stylesheet" href="css/catpagestyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/video-games.css">   
    <link rel="icon" type="image/png" href="images/favicon.png"> 
</head>
<body>
    <header class="header"><a href="index.php">
        <h1 class="title">ARCADE ALLEY</h1>
        <p class="subtitle">DISCOVER. PLAY. CONQUER.</p>
    </a>
    </header>

    <!--NAV BAR-->

    <main class="content">
        <div class="category-videogames">
            <h1>Search</h1>
            <h4><a href="home.php">Home</a> > Search</h4>

           <!-- Error message display  -->
           <?php
                if(!empty($errors))
                {
                    foreach($errors as $e)
                    {
                        echo "<h4 style='text-align:center;'>$e</h4>";
                    }
                }
            ?>

            
            <div class="videogames-container">
                <?=$code?>    
            </div>
        </div>
    </main>

    <!-- <footer>
        <div class="footer-container">

            <div class="footer-section">
                <p class="main-heading">Customer Care</p>
                <ul>
                    <a href=""><li>My account</li></a>
                    <a href=""><li>Warranty Policy</li></a>
                    <a href=""><li>Privacy Policy</li></a>
                    <a href=""><li>Terms and Conditions</li></a>
                </ul>
            </div>

            <div class="footer-section">
                <p class="main-heading">ARCADE ALLEY</p>
                <ul>
                <li>CONTACT INFO</li>
                <li>NO.22, ABC ROAD, HOMAGAMA COLOMBO</li>
                <li>+94715522775</li>
                <li>+94715513775</li>
                </ul>
            </div>

            <div class="footer-section">
                <p class="main-heading">Find it fast</p>
                <ul>
                    <a href=""><li>Shop</li></a>
                    <a href=""><li>About us</li></a>
                    <a href=""><li>Contact Us</li></a>
                    <a href=""><li>Location</li></a>
                </ul>
            </div>

        </div>
    </footer>
</body>
</html> -->

<?php include('include/footer.php'); ?>


<?php mysqli_close($connection); ?>