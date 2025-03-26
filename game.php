<?php include('include/connection.php');$title="Product List"; ?>





<?php include('include/header.php'); ?>

 <div class="container row" style="margin-top:40px;margin-bottom:40px;color:black;">                         <!--  card div  -->
<?php 

if(!isset($connection))
{
    include('include/connection.php');        
}

$query = "SELECT * FROM product WHERE isDeleted = 'no' ORDER BY id ";
$result = mysqli_query($connection,$query);
if($result){

    
    $tag = '';

    while($product = mysqli_fetch_assoc($result))
    {
        $id = $product['id']; 
        $title = $product['nickName'];
        $img = $product['img'];
        $price = $product['price'];
        
        
        // $tag .= '<div class="product-item col-md-3" style="color:black;">';
        $tag .= '<div class="product-item col-12 col-sm-8 col-md-3" style="color:black;">';
        $tag .= '<a href="/crud/product.php?pid='.$id.'">';
        $tag .= '<p class="product-name" style="color:black;">'.$title.'</p>';
        $tag .= '<img src="'.$img.'" alt="">';
        $tag .= '<p style="color:#636663;">'.$price.'.00 LKR</p>';
        $tag .= '</a>';
        $tag .= '</div>';

    }
}

echo $tag;
?>
</div>





<?php include('include/footer.php'); ?>


<?php mysqli_close($connection); ?>