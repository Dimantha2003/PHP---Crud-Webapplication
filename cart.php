<?php include('include/connection.php');include('include/usercheck.php'); 
        
        $tmpSid = $_SESSION['user'];                                                     
        $errors = array();
 ?>


 <!-- cart item  -->
 <?php
    $carttable = '';
    $ttl=0;
    if(isset($_SESSION['cart']))
    {
        if(!empty($_SESSION['cart']))
        {
            
            foreach($_SESSION['cart'] as $key => $value)
            {
                $pid = $value['iid'];
                $query = "SELECT * FROM product WHERE id='{$pid}' LIMIT 1";
                $result = mysqli_query($connection,$query);
                if($result)
                {
                    $url = mysqli_fetch_assoc($result)['img'];
                    
                }
                $ttl += (int)$value['qtty']*(int)$value['price'];

                $carttable .= '<tr><td><div class="product-info"><img src="'.$url.'" alt="Product Image"><span>'.$value['name'];
                $carttable .= '</span></div></td><td>Rs.'.$value['price'];
                $carttable .= '</td><td>'.$value['qtty'];
                $carttable .= '</td><td>Rs.'.(int)$value['qtty']*(int)$value['price'];
                $carttable .= "</td><td><a href='cart.php?action=remove&name=".$value['name']."'>Remove</a></td></tr>";

            }
            
        }

        if(isset($_GET['action']))
        { 
            if($_GET['action']=='remove')
            {
                foreach($_SESSION['cart'] as $key => $value)
                {
                    if($value['name']==$_GET['name'])
                    {
                        unset($_SESSION['cart'][$key]);
                        header('Location: cart.php');
                    }
                }   
            }
        }
    }
?>



















<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart - Arcade Alley</title>
    <link rel="stylesheet" href="css/stylecart.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="icon" type="image/png" href="favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
          background-image: url("images/back2.jpg");
          background-repeat: no-repeat;
          background-attachment: fixed;
        background-size: cover;
        }
        </style>
</head>
<body>
    <header class="header"><a href="home.php">
        <h1 class="title">ARCADE ALLEY</h1>
        <p class="subtitle">DISCOVER. PLAY. CONQUER.</p>
    </a>
    </header>

    <div class="cart">
        <h1>Cart</h1>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $carttable ?>
            </tbody>
        </table>
        <div class="cart-actions">
            
            <a href="check.php"><button class="proceed-checkout">Proceed to checkout</button><a>
        </div>
        <div class="cart-totals">
            <h2>Cart totals</h2>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>Rs. <?=$ttl;?>.00</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>
                        <input type="radio" name="shipping" checked> Island-Wide Delivery: Rs.700
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>Rs. <?php if($ttl!=0) echo $ttl+700;else echo 0?>.00</td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
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
</html>
