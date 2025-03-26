<?php include('include/connection.php');include('include/usercheck.php'); 
        $pagetitle = 'User Panel';
        $tmpSid = $_SESSION['user'];                                                     //temp session id please remove when create login page
        $errors = array();
        $suc = array();
 ?>


 <!-- update password  -->
 <?php
    if(isset($_POST['passSubmit']))
    {
        $query = "SELECT pass FROM user WHERE userId='$tmpSid' LIMIT 1";
        $result = mysqli_query($connection,$query);
        
        if(mysqli_num_rows($result)==1)
        {
            $rec = mysqli_fetch_assoc($result);
            $hash = $rec['pass'];
        }
        else 
        {
            echo "Query failed";
        }

        $key = array('opass','npass','cpass');
        
        foreach($key as $i)
        {
            if(empty(trim($_POST[$i])))
            {
                $errors[] = "$i field is empty";
            }
        }

        if(empty($errors))
        {
            $npass = mysqli_real_escape_string($connection,$_POST['npass']);
            $cpass = mysqli_real_escape_String($connection,$_POST['cpass']);
            $opass = mysqli_real_escape_string($connection,$_POST['opass']);
            $newhash = sha1($npass);
            $oldhash = sha1($opass);
            if($hash == $oldhash and $npass == $cpass){
                $query = "UPDATE user SET pass='{$newhash}' WHERE userId='{$tmpSid}'";
                $result = mysqli_query($connection,$query);
                if($result)
                {
                    $suc[] = "updated successfuly";
                }
                else 
                {
                    $errors[] = "Update failed";
                }
            }
            else 
            {
                $errors[] =  "Password Is incorrect";
            }                    
        }
    }
?>

<!-- Logout  -->
<?php
    if(isset($_POST['logout']))
    {
        $_SESSION = array();
        if(isset($_COOKIE[session_name()]))
        {
            setcookie(session_name(),'',time()-86400,'/');            
        }
        session_destroy();
        header('Location: login.php');
    }
?>

<!-- Details Update  -->
<?php
    
    $query = "SELECT * FROM user WHERE userId='{$tmpSid}' LIMIT 1";
    $result = mysqli_query($connection,$query);    
    if($result)
    {
        
        $data = mysqli_fetch_assoc($result);
        $id = $data['userId'];
        $username = $data['userName'];
        $lname = $data['Lname'];
        $email = $data['email'];            
        $address = $data['address'];
        $town = $data['town'];
        $zip = $data['zip'];
        $mobile = $data['tp'];                      
    }
    if(isset($_POST['detSubmit']))    
    {
        
        $username = mysqli_real_escape_string($connection,$_POST['uname']);
        $lname = mysqli_real_escape_string($connection,$_POST['lname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $address = mysqli_real_escape_string($connection,$_POST['address']);
        $town = mysqli_real_escape_string($connection,$_POST['town']);
        $zip = mysqli_real_escape_string($connection,$_POST['zip']);
        $mobile = mysqli_real_escape_string($connection,$_POST['mobile']);

        $query = "UPDATE user SET userName='{$username}',Lname='{$lname}',email='{$email}', address='$address',town='{$town}',zip='{$zip}',tp='{$mobile}' WHERE userId='{$tmpSid}' LIMIT 1";
        $result = mysqli_query($connection,$query);
        if($result)
        {
            $suc[] = "updated";
        }
        else
        {
            echo "Not Updated";
        }
        

    }
?>
<!-- order list  -->
<?php
    $orderTableCode = '';
    $query = "SELECT * FROM userorder WHERE userid='{$tmpSid}'";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        while($rec=mysqli_fetch_assoc($result))
        {
            if($rec['isConfirmed']==1)
            {
                $o ='Completed';
                $c='green';
            }
            else 
            {
                $o ='Pending....';
                $c='red';
            }

            $orderTableCode .= "<tr>";
            $orderTableCode .= "<td>".$rec['orderID']."</td>";
            $orderTableCode .= "<td>".$rec['nickname']."</td>";
            $orderTableCode .= "<td>Rs. ".$rec['price'].".00</td>";
            $orderTableCode .= '<td><button style="background-color:'.$c.'">'.$o.'</button></td>';
            $orderTableCode .= "</tr>";
        }
    }
?>














<!DOCTYPE HTML>
<html lan="en">
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/myaccstyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        
        <link rel="icon" type="image/png" href="images/favicon.png">

        <title>My Account</title>
        <script>
            function showSection(sectionId) {
                const sections = document.querySelectorAll('.content');
                sections.forEach(section => {
                    if (section.id === sectionId) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            }
            document.getElementById('logoutButton').addEventListener('click', function() {
    document.getElementById('message').textContent = 'You have been logout.Thank you for visiting!';
});

        </script>
            </head>
    <body>
         <!--THIS IS HEADER!!!!-->
    <header class="header"><a href="home.php">
        <h1 class="title">ARCADE ALLEY</h1>
        <p class="subtitle">DISCOVER. PLAY. CONQUER.</p>
    </a>
    </header>

    <!--My account-->
        
    <div class="account">
        <h1><a href="myaccount.php" style="color:black;text-decoration: none;">My Account </a></h1>
        </div>
        <div class="main-content">
                <nav class="side-navbar">
                   
                    <ul class="nav-list">
                        <li class="nav-item"><a href="#" onclick="showSection('dashboard')">Dashboard</a></li><hr>
                        <li class="nav-item"><a href="#" onclick="showSection('account')">Change Password</a></li><hr>
                        <li class="nav-item"><a href="#" onclick="showSection('address')">Update Details</a></li><hr>
                        <li class="nav-item"><a href="#" onclick="showSection('orders')">Orders</a></li><hr>
                        <li class="nav-item"><a href="include/logout.php" onclick="showSection('logout')">Logout</a></li>
                    </ul>
                </nav>
            
                <!--DASHBOARD-->
            <div id="dashboard" class="content" >
                    <div class="dashboard-message">
                        <span><b><?="Hey, ".$username." "?>Welcome to your Account!</b><br><br>From your account dashboard you can edit your account details,manage your address and view your orders.</span>
                </div>
            </div>

            <!--ACCOUNT DETAILS-->
            <div id="account" class="content" style="display: none;">
                <h2>Account Details</h2>

           <form class="details-form" method="post" action="">
            <label for="firstname">First Name: </label>
            <input type="text" id="firstname" value="<?php echo $username?>" disabled>
            <label for="lastname">Last Name: </label>
            <input type="text" id="lastname" value="<?php echo $lname?>" disabled>
            <label for="email">Email : </label>
            <input type="email" id="email" value="<?php echo $email?>" disabled>
            
            </form>

            <!-- password change  -->

            <form class="password-change-form" method="post" action="myaccount.php">
                <?php
                    if(!empty($errors))
                    {
                        foreach($errors as $e)
                        {
                            echo "<div style='color:red;'>$e</div>";
                        }

                    }
                    
                ?>
                <?php
                    if(!empty($suc))
                    {
                        foreach($suc as $e)
                        {
                            echo "<div style='color:green;'>$e</div>";
                        }

                    }
                    
                ?>
             <h3>Change Password </h3>
            <label for="oldpassword" >Old Password:</label>
            <input type="password" id="oldpassword" name="opass">
            <label for="newpassword" >New Password:</label>
            <input type="password" id="newpassword" name="npass" required>
            <label for="password">Confirm new password :</label>
            <input type="password" id="confirmpassword" name="cpass" required>
            <button type="submit" name="passSubmit">Save Changes</button>
           </form>

        </div>

<!--ADDRESS-->
        <div id="address" class="content" style="display: none;">
            <h2>Address</h2>

       <form class="address-form" method="post" action="">

                <?php
                    if(!empty($errors))
                    {
                        foreach($errors as $e)
                        {
                            echo "<div style='color:red;'>$e</div>";
                        }
                    }                    
                ?>
                <?php
                    if(!empty($suc))
                    {
                        foreach($suc as $e)
                        {
                            echo "<div style='color:green;'>$e</div>";
                        }
                    }                    
                ?>


        <label for="firstname">First Name: </label>
        <input type="text" id="firstname" name="uname" value="<?php echo $username?>" required>
        <label for="lastname">Last Name: </label>
        <input type="text" id="lastname" name="lname" value="<?php echo $lname?>" required>
        <label for="street">Street Name: </label>
        <input type="text" id="street" name="address" value="<?php echo $address?>" required> 
        <label for="town">Town/city: </label>
        <input type="text" id="town" name="town" value="<?php echo $town?>" required>
        <label for="postcode">Postcode/ZIP: </label>
        <input type="text" id="postcode" name="zip" value="<?php echo $zip?>" required>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value="<?php echo $email?>" required>
        <label for="Tnumber">Telephone Number: </label>
        <input type="text" id="Tnumber" name="mobile" value="<?php echo $mobile?>" required>
        <button type="submit" name="detSubmit">Save Changes</button>
       </form>
    </div>

    <!--ORDER-->
        <div id="orders" class="content" style="display: none;width:100%;">
            <!-- order response table (order number, price,progress )  -->
            <form action="myaccount.php" method="POST">
                
                <h1>ORDERS</h1>
                <table class="table">
                    <tr><th>ORDER NO</th><th>Name</th><th>Price</th><th>Status</th></tr>
                    <?php 
                        echo $orderTableCode;
                    ?>
                </table>
            </form>
         </div>

            <!--LOGOUT-->
            <form action="myaccount.php" method="post">
                <div id="logout" class="content" style="display: none;">
                    <div style="">
                        <button type="submit" id="logoutbutton" name="logout">logout</button>
                    </div>
                </div>
            </form>
    </div>

<!--Footer-->
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
                            <a href="home.php"><li>Shop</li></a>
                            <a href="about.html"><li>About us</li></a>
                            <a href="contact.html"><li>Contact Us</li></a>
                            <a href=""><li>Location</li></a>
                        </ul>
                    </div>
        
                </div>
            </footer>
    </body>
    </html>