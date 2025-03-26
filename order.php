<?php include('include/connection.php');$pagetitle = 'order Confirm';include('include/header.php');include('include/admincheck.php'); ?>
<!-- show item which are not confirmed  -->
<?php    
    $orderTableCode = '';
    $query = "SELECT * FROM userorder WHERE isConfirmed=0";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        while($rec=mysqli_fetch_assoc($result))
        {
            $user = $rec['userID'];
            $item = $rec['itemId'];

            $query2 = "SELECT * FROM user WHERE userId='{$user}' LIMIT 1";
            $result2 = mysqli_query($connection,$query2);
            if($result2)
            {
                $rec2 = mysqli_fetch_assoc($result2);
            }



            $orderTableCode .= "<tr>";
            $orderTableCode .= "<td>".$rec['orderID']."</td>";
            $orderTableCode .= "<td>".$rec['nickname']."</td>";
            $orderTableCode .= "<td>Rs. ".$rec['price'].".00</td>";
            $orderTableCode .= "<td>".$rec['quantity']."</td>";
            $orderTableCode .= "<td>".$rec2['userName'].'<br>'.$rec2['address'].'<br>'.$rec2['tp']."</td>";
            $orderTableCode .= '<td><a href="order.php?oid='.$rec['orderID'].'&qtty='.$rec['quantity'].'&iid='.$item.'">Confirm</a></td>';
            $orderTableCode .= "</tr>";
        }
    }
?>

<!-- update after confirm  -->
<?php
    if(isset($_GET['oid']))
    {
        $oid = $_GET['oid'];
        $qtty = $_GET['qtty'];
        $iid = $_GET['iid'];        
        
        $query = "UPDATE userorder SET isConfirmed=1 WHERE orderID='{$oid}'"; 
        $result = mysqli_query($connection,$query);

        if($result){
            $query2 = "SELECT * FROM product WHERE id='{$iid}' LIMIT 1";
            $result2 = mysqli_query($connection,$query2);
            $rec = mysqli_fetch_assoc($result2);
            $stock = $rec['stock'];
            $new = (int)$stock - (int)$qtty;
            
            $query3 = "UPDATE product SET stock='{$new}' WHERE id='{$iid}'"; 
            $result3 = mysqli_query($connection,$query3);

            header('Location: order.php');
        }
    }
?>


<a href="admin.php">Admin Panel</a>
<form action="order.php" method="post">
    <h1>ORDER Confirm (Admin Panel)</h1>
    <table class="table">
        <tr><th>ORDER NO</th><th>Name</th><th>Price</th><th>quantity</th><th>User Details</th><th>Status</th></tr>
        <?php 
            echo $orderTableCode;
        ?>
    </table>
</form>









<?php mysqli_close($connection) ?>