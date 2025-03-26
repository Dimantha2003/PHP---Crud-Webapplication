<?php include('include/connection.php'); include('include/usercheck.php');?>

<?php
    $pagetitle = '';
    if(!isset($_GET['pid'])) $_GET['pid'] = 1;         //if $_GET is not set default is 1
    
    $id = mysqli_real_escape_string($connection,$_GET['pid']);
    $query = "SELECT * FROM product WHERE id={$id}";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        $user = mysqli_fetch_assoc($result);        
        $title = $user['title']; 
        $nick = $user['nickName'];
        $descr = $user['descript']; 
        $price = $user['price']; 
        $img = $user['img']; 
        $stock = $user['stock'];            
        $descArray = explode("*", $descr);   
        
        
        $pagetitle = $title;
    }

    $availability = '<span class="';  //in-stock">In Stock</span>';
    if($stock>0) $availability .= 'in-stock">In Stock</span>';
    else $availability .= 'outof-stock" style="color: rgb(152, 10, 10);font-weight: bold;">Out Of Stock</span>';
    
    
?>
<!-- cart -->
<?php

if(isset($_POST['add-cart']))
{
    if(isset($_SESSION['cart']))
    {
        $count = count($_SESSION['cart']);
        $_SESSION['cart'][$count] = array('iid'=>$id,'name' => $nick,'price' => $price, 'qtty'=> $_POST['qtty']);
    }
    else
    {
        $_SESSION['cart'][0] = array('iid'=>$id,'name' => $nick,'price' => $price, 'qtty'=> $_POST['qtty']);
    }
}
?>


    <!-- Include header  -->
    <?php include('include/header.php'); ?>  

    <main>
    <div class="product Spider-Man">
        <div class="product-image">
            <img src=<?php echo $img ?> alt="" style="width:30vw;border: 1px solid grey;padding: 20px;border-radius: 20px;">
        </div>
            <div class="product-info">
                <h2><?php echo $title ?></h2>
                <p class="availability">Availability: <?php echo $availability; ?></p><hr>
                
                <!-- To display Description points  -->
                <?php
                   
                   $list = ''; 
                        foreach($descArray as $i)
                        {
                            $list .= "<li> {$i} </li>";
                        }
                    
                    
                    ?>
                    <uL>
                        <?php echo $list; ?>                    
                    </uL>
                <form action="product.php?pid=<?=$id ?>" method='post'>
                    <p class="product-price"><?php echo number_format($price) ?> LKR</p>
                    <div class="add-to-cart">
                        <input type="number" value="1" max="<?php echo $stock ?>" min="1" name="qtty">
                        <button type='submit' name='add-cart'>Add to cart</button>
                    </div>
                </form>
            </div>
        </div> 
        <div class="container related-products">
            <h2>Related Products</h2><hr>
            <!-- Related product contain  -->
            <div class="product-container">
                <div class="product-list">
                    <!-- sadasd  -->
                    <?php include('include/related.php'); ?>
                </div>
            </div>
        </div>
    </div>   
    </main>

    <!-- Include footer  -->
    <?php include('include/footer.php'); ?> 
    



<?php mysqli_close($connection)  ?>