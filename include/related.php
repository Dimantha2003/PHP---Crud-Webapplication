<?php 

    if(!isset($connection))
    {
        include('include/connection.php');        
    }

    $query = "SELECT * FROM product WHERE isDeleted = 'no' ORDER BY id DESC LIMIT 4";
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
    
    echo $tag;
?>





    
    
    
    
   





