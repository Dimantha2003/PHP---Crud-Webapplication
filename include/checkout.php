<?php include('connection.php'); session_start();$tmpSid = $_SESSION['user']; ?>
<?php
    
    if(isset($_SESSION['cart']))
    {
        if(!empty($_SESSION['cart']))
        {            
            foreach($_SESSION['cart'] as $key => $value)
            {
                $iid = $value['iid'];
                $qtty = $value['qtty'];
                $price = $value['price'];
                $nick = $value['name'];
                $tprice = (int)$price*(int)$qtty;
                $query = "INSERT INTO userorder(userID,itemId,quantity,isConfirmed,price,nickname) VALUES('{$tmpSid}','{$iid}','{$qtty}',0,'{$tprice}','{$nick}')";
                $result = mysqli_query($connection,$query);
                $_SESSION['cart'] = array();
                if($result)header('Location: ../myaccount.php');
                else echo "no";
            }
        }
        else header('Location: ../user.php?status=emptycart');
        
        
     }


?>













<?php mysqli_close($connection)  ?>