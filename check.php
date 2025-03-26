<?php include('include/connection.php');include('include/usercheck.php'); 
        
        $tmpSid = $_SESSION['user'];
 ?>
 
 <!-- Fill the form  -->
  <?php
    
    $query = "SELECT * FROM user WHERE userId='{$tmpSid}' LIMIT 1";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        $rec = mysqli_fetch_assoc($result);

        $fname = $rec['userName'];
        $lname = $rec['Lname'];
        $email = $rec['email'];
        $address = $rec['address'];
        $town = $rec['town'];
        $zip = $rec['zip'];
        $tp = $rec['tp'];        
    }
?>

<!-- show orders in table  -->
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
                $ttl += (int)$value['qtty']*(int)$value['price'];      
                
                $carttable .= '<tr><td>'.$value['name'].'</td>';
                $carttable .= '<td>'.$value['qtty'].'</td>';
                $carttable .= '<td>'.(int)$value['qtty']*(int)$value['price'].'</td></tr>';

            }
            
        }
    }
?>


















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Arcade Alley</title>
    <link rel="stylesheet" href="css/checkstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png">
    <style>
        body {
            background-image: url("images/cartback.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            
        }
        </style>
</head>
<body>
    <header class="header"><a href="index.php">
        <h1 class="title">ARCADE ALLEY</h1>
        <p class="subtitle">DISCOVER. PLAY. CONQUER.</p>
    </a>
    </header>
    <div class="container">
        <h1>Checkout</h1>
        <div class="checkout-container">
            <form class="billing-details">
                <h2>Billing details</h2>
                <label for="first-name">First name *</label>
                <input type="text" id="first-name" name="first-name" value='<?=$fname?>' required>
                
                <label for="last-name">Last name *</label>
                <input type="text" id="last-name" name="last-name" value='<?=$lname?>' required>
                
                <label for="company-name">Company name (optional)</label>
                <input type="text" id="company-name" name="company-name">
                
                <label for="country">Country / Region *</label>
                <select id="country" name="country" required>
                    <option value="Sri Lanka">Sri Lanka</option>
                </select>
                
                <label for="street-address">Street address *</label>
                <input type="text" id="street-address" name="street-address" value='<?=$address?>'  required>
                <input type="text" id="address-optional" name="address-optional" placeholder="Apartment, suite, unit, etc. (optional)">
                
                <label for="city" >Town / City *</label>
                <input type="text" id="city" name="city" value='<?=$town?>' required>
                
                <label for="postcode">Postcode / ZIP *</label>
                <input type="text" id="postcode" name="postcode"  value='<?=$zip?>' required>
                
                <label for="phone">Phone *</label>
                <input type="tel" id="phone" name="phone" value='<?=$tp?>'  required>
                
                <label for="email">Email address *</label>
                <input type="email" id="email" name="email" value='<?=$email?>'  required>
                
                <h2>Shipping Details</h2>
                <label for="order-notes">Order notes (optional)</label>
                <textarea id="order-notes" name="order-notes" placeholder="Notes about your order, e.g., special notes for delivery."></textarea>
            </form>
            <div class="order-summary">
                <h2>Your order</h2>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Subtotal</th>
                    </tr>
                    <!-- Example row -->
                    <?=$carttable?>
                    
                </table>
                <h4><a href="cart.php" style="color:black;text-decoration: none;">Go Back to Cart</a></h4>
                <div class="shipping-options">
                    <h3>Shipping</h3>
                    <label for="arcadealley-delivery">
                        <input type="radio" id="arcadealley-delivery" name="shipping" value="arcadealley-delivery" checked>
                        Arcade Alley Delivery: Rs.850
                    </label>
                    <label for="local-pickup">
                        <input type="radio" id="local-pickup" name="shipping" value="Local pickup">
                        Local pickup
                    </label>
                </div>
                <div class="payment-method">
                    <h3>Payment Method</h3>
                    <label for="payment-method">
                        <input type="radio" id="payment-method" name="payment" value="online-pay" checked>
                        Cash on delivery
                    </label>
                </div>
                <div class="terms">
                    <label for="terms">
                        <input type="checkbox" id="terms" name="terms" required>
                        I have read and agree to the website terms and conditions *
                    </label>
                </div>
                <a href="include/checkout.php"><button type="submit">Checkout</button><a>
            </div>
        </div>
    </div>

    <footer>
        <div class="copyright-bar"></div>
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
                    <a href="" class="section-links"><li>Location</li></a>
                </ul>
            </div>

        </div>
    </footer>
</body>
</html>
