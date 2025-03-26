<!-- php code-->
 <?php include('include/connection.php');include('include/usercheck.php'); 
        $pagetitle = 'User Panel';
        $tmpSid = $_SESSION['user'];                                                     //temp session id please remove when create login page
        $errors = array();
 ?>
 

 <!-- cart item  -->
<?php
    $carttable = '';
    if(isset($_SESSION['cart']))
    {
        if(!empty($_SESSION['cart']))
        {
            $ttl=0;
            foreach($_SESSION['cart'] as $key => $value)
            {
                $ttl += (int)$value['qtty']*(int)$value['price'];
                $carttable .="<tr><td name='name'>".$value['name']."</td>";
                $carttable .="<td>".$value['price']."</td>";
                $carttable .="<td>".$value['qtty']."</td>";
                $carttable .="<td>".(int)$value['qtty']*(int)$value['price']."</td>";
                $carttable .="<td><a href='user.php?action=remove&name=".$value['name']."'>Remove</a></td></tr>";
            }
            $carttable .="<tr><th colspan='3' style='text-align:center;'>Total</th><td>".$ttl."</td></tr>";
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
                        header('Location: user.php');
                    }
                }   
            }
        }
    }
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
            $opass = mysqli_real_escape_string($connection,$_POST['opass']);
            $newhash = sha1($npass);
            $oldhash = sha1($opass);
            if($hash == $oldhash){
                $query = "UPDATE user SET pass='{$newhash}' WHERE userId='{$tmpSid}'";
                $result = mysqli_query($connection,$query);
                if($result)
                {
                    $errors[] = "updated successfuly";
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

<!-- Details Update  -->
<?php
    
    $query = "SELECT * FROM user WHERE userId='{$tmpSid}' LIMIT 1";
    $result = mysqli_query($connection,$query);    
    if($result)
    {
        
        $data = mysqli_fetch_assoc($result);
        $id = $data['userId'];
        $username = $data['userName'];
        $email = $data['email'];            
        $address = $data['address'];
        $mobile = $data['tp'];                      
    }
    if(isset($_POST['detSubmit']))    
    {
        
        $username = mysqli_real_escape_string($connection,$_POST['uname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $address = mysqli_real_escape_string($connection,$_POST['address']);
        $mobile = mysqli_real_escape_string($connection,$_POST['mobile']);

        $query = "UPDATE user SET userName='{$username}',email='{$email}', address='$address',tp='{$mobile}' WHERE userId='{$tmpSid}' LIMIT 1";
        $result = mysqli_query($connection,$query);
        if($result)
        {
            echo "updated";
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








<!-- html code  -->
 <?php include('include/header.php'); ?>
 <div class="container">
    <!-- Add to card table (nickname,qtty,price,buy,cancel)  -->
    <form action="include/checkout.php" method="POST">
            <h1>Cart Items</h1> 
            <table class="table">
                <tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th><th>Update</th></tr>
                <?php 
                    echo $carttable;
                ?> 
            </table>  
            <button type="submit" name="check">Checkout</button>         
    </form>
    <hr>
        
    <!-- order response table (order number, price,progress )  -->
    <form action="user.php" method="POST">
        
            <h1>ORDER</h1>
            <table class="table">
                <tr><th>ORDER NO</th><th>Name</th><th>Price</th><th>Status</th></tr>
                <?php 
                    echo $orderTableCode;
                ?>
            </table>
    </form>
    <hr>
    <!-- Details update  -->
    <form action="user.php" method="POST">
            <h1>User Details Update</h1>            
            <p><label>User ID</label><input type="text" name="uid" class="d-block" value="<?php echo $id  ?>" readonly></p>
            <p><label>Username</label><input type="text" name="uname" class="d-block" value="<?php echo $username?>"></p>
            <p><label>E-Mail</label><input type="email" name="email" class="d-block" value="<?php echo $email?>"></p>
            <p><label>Address</label><input type="text" name="address" class="d-block" value="<?php echo $address?>"></p>
            <p><label>Mobile</label><input type="text" name="mobile" class="d-block" value="<?php echo $mobile?>"></p>
            <input type="submit" type="submit" name="detSubmit" value="Submit" class="d-block">
    </form>
    <hr>

    <!-- password update  -->
    <form action="user.php" method="POST" onsubmit="return validateForm()">
            <h1>Change Password</h1>  
            <?php if(!empty($errors)) foreach($errors as $i){echo $i;} ?>       
            <input type="password" placeholder="Old Password" name="opass" class="d-block" required>
            <input type="password" placeholder="New Password" name="npass" id='new' class="d-block" required>
            <input type="password" placeholder="Confirm New Password" name="cpass" id='confirm' class="d-block" required><br>
            <input type="submit" type="submit" name="passSubmit" value="Change Password" class="d-block">
    </form>
    <hr>

    <!-- Logout  -->
     <form action="user.php" method='post'>
        <input type="submit" value="LOG OUT" name='logout'>
     </form>

 </div>

    




 <script>
        function validateForm() {
            var newPassword = document.getElementById("new").value;
            var confirmPassword = document.getElementById("confirm").value;

            if (newPassword !== confirmPassword) {
                alert("New password and Confirm password do not match!");
                return false; 
            } else {
                
                return confirm("Do you want to proceed?");
            }
        }
    </script>
<?php include('include/footer.php'); ?>
<?php mysqli_close($connection); ?>

