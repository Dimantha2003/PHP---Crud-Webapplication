<?php include('include/connection.php');session_start(); ?>






<!-- ASC -->
<?php 

    if(!isset($connection))
    {
        include('include/connection.php');        
    }

    $query = "SELECT * FROM product WHERE isDeleted = 'no' ORDER BY id ASC LIMIT 4";
    $result = mysqli_query($connection,$query);
    if($result){

        
        $tag = '';

        while($product = mysqli_fetch_assoc($result))
        {
            $id = $product['id']; 
            $title = $product['nickName'];
            $img = $product['img'];
            $price = $product['price'];

            $tag .= '<div class="products">';
            $tag .= '<a href="/crud/product.php?pid='.$id.'">';
            $tag .= '<p class="product-name">'.$title.'</p>';
            $tag .= '<img src="'.$img.'" alt="">';
            $tag .= '<p>'.number_format($price).'.00 LKR</p>';
            $tag .= '</a>';
            $tag .= '</div>';

        }
    }    
    
?>
<!-- DESC -->
<?php 

if(!isset($connection))
{
    include('include/connection.php');        
}

$query = "SELECT * FROM product WHERE isDeleted = 'no' ORDER BY id DESC LIMIT 4";
$result = mysqli_query($connection,$query);
if($result){

    
    $tag2 = '';

    while($product = mysqli_fetch_assoc($result))
    {
        $id = $product['id']; 
        $title = $product['nickName'];
        $img = $product['img'];
        $price = $product['price'];

        $tag2 .= '<div class="products">';
        $tag2 .= '<a href="/crud/product.php?pid='.$id.'">';
        $tag2 .= '<p class="product-name">'.$title.'</p>';
        $tag2 .= '<img src="'.$img.'" alt="">';
        $tag2 .= '<p>'.number_format($price).'.00 LKR</p>';
        $tag2 .= '</a>';
        $tag2 .= '</div>';

    }
}    

?>
<!-- Random -->
<?php 

if(!isset($connection))
{
    include('include/connection.php');        
}

$query = "SELECT * FROM product WHERE isDeleted = 'no' ORDER BY RAND() LIMIT 4";
$result = mysqli_query($connection,$query);
if($result){

    
    $tag3 = '';

    while($product = mysqli_fetch_assoc($result))
    {
        $id = $product['id']; 
        $title = $product['nickName'];
        $img = $product['img'];
        $price = $product['price'];

        $tag3 .= '<div class="products">';
        $tag3 .= '<a href="/crud/product.php?pid='.$id.'">';
        $tag3 .= '<p class="product-name">'.$title.'</p>';
        $tag3 .= '<img src="'.$img.'" alt="">';
        $tag3 .= '<p>'.number_format($price).'.00 LKR</p>';
        $tag3 .= '</a>';
        $tag3 .= '</div>';

    }
}    

?>

<!-- ************************************************HTML CODE************************************************ -->



<?php include('include/header.php'); ?>  
<main class="content">

        <!--SEARCH BAR-->

        <!--SEARCH BAR-->


        <!--SLIDESHOW-->
        <div class="carousel">
            <div class="slides">
                <div class="slide"><img src="home-images/1.PNG" alt="Slide 1"></div>
                <div class="slide"><img src="home-images/2.JPG" alt="Slide 2"></div>
                <div class="slide"><img src="home-images/3.JPG" alt="Slide 3"></div>
                <div class="slide"><img src="home-images/4.JPG" alt="Slide 4"></div>
        </div>
        <button class="control left" onclick="prevSlide()">&#10094;</button>
        <button class="control right" onclick="nextSlide()">&#10095;</button>
        </div>
        <!--SLIDESHOW-->

        <!--PRODUCT SHOWCASE-->
        <div class="discover-products">
            <h2>Discover Now</h2>
            <div class="product-container">
                <div class="product-list">
                   <?=$tag?>
                </div>
            </div>
        </div>

        <div class="recently-added">
            <h2>Recently Added</h2>
            <div class="product-container">
                <div class="product-list">
                    <?=$tag2?>
                </div>

            </div>
        </div>

        <div class="best-selling">
            <h2>Best Selling</h2>
            <div class="product-container">
                <div class="product-list">
                    <?=$tag3;?>
                   
                </div>

            </div>
        </div>

        
            
        <!--PRODUCT SHOWCASE-->
      
    </main>
    

    <!--THIS IS FOOTER!!!!-->
    <footer>
        <div class="copyright-bar"></div>
        <div class="footer-container">

            <div class="footer-section">
                <p class="main-heading">Customer Care</p>
                <ul>
                    <a href="myaccount.php"><li>My account</li></a>
                    <a href="warranty.html"><li>Warranty Policy</li></a>
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
                    <a href="home.php"><li>Shop</li></a>
                    <a href="about.html"><li>About us</li></a>
                    <a href="contact.html"><li>Contact Us</li></a>
                    <a href="" class="section-links"><li>Location</li></a>
                </ul>
            </div>

        </div>
    </footer>

    <script>
        function toggleAuthButtons() {
            const authButtons = document.querySelector('.auth-buttons');
            authButtons.classList.toggle('show');
        }
    </script>
    <script src="https://kit.fontawesome.com/ff0d0f7bd0.js" crossorigin="anonymous"></script>
    <script src="js/slideshow.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="index.js"></script>
</body>
</html>
</body>
</html>


<?php mysqli_close($connection); ?>