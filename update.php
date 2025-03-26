<?php include('include/connection.php');include('include/admincheck.php'); ?>
<?php
    
    $title = '';
    $price = '';
    $descr = '';
    $cat = '';
    $nicknamename = '';
    $stock = '';
    $isdeleted = '';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = mysqli_real_escape_string($connection,$_GET['pid']);

        $query = "SELECT * FROM product WHERE id='{$id}' LIMIT 1";
        $result = mysqli_query($connection,$query);
        if($result)
        {
            $data = mysqli_fetch_assoc($result);
            $id = $data['id'];
            $title = $data['title'];
            $price = $data['price'];
            $descr = strip_tags($data['descript']);
            $nicknamename = $data['nickName'];
            $stock = $data['stock'];
            $isdeleted = $data['isDeleted'];

            
        }
}
?>
<?php

    if(isset($_POST['update']))
    {
            $title = mysqli_real_escape_string($connection,$_POST['title']);
            $price = mysqli_real_escape_string($connection,$_POST['price']);
            $descr = mysqli_real_escape_string($connection,$_POST['description']);
            $id = mysqli_real_escape_string($connection,$_POST['id']);
            $isdeleted = mysqli_real_escape_string($connection,$_POST['isdelete']);
            
            
            $nickname = mysqli_real_escape_string($connection,$_POST['nickname']);
            $stock = mysqli_real_escape_string($connection,$_POST['stock']);

            $query = "UPDATE product SET title='{$title}', price='{$price}', descript='{$descr}', nickName='{$nickname}', stock='{$stock}',isDeleted='{$isdeleted}' WHERE id='{$id}' LIMIT 1 ";
            $result = mysqli_query($connection,$query);
            if($result)echo "Query Update Success";
            else echo "Not Updated";
    }
?>


<?php $pagetitle="Update";include('include/header.php'); ?>
<body>
    <div class="container">

        

        <form action="update.php" method="POST" enctype="multipart/form-data" class="container">
                <h1>Update Product</h1>

                <p><label>Product ID</label><input type="text" name="id" class="d-block" value="<?php if(!empty(trim($id))) echo $id; else echo 0  ?>" readonly></p>
                <p><label>Title</label><input type="text" placeholder="title" name="title" class="d-block" value="<?php echo $title  ?>"></p>
                <p><label>Price</label><input type="text" placeholder="price" name="price" class="d-block" value="<?php echo $price  ?>"></p>
                <p><label>Nick Name</label><input type="text" placeholder="nickname" name="nickname" class="d-block" value="<?php echo $nicknamename  ?>"></p>
                <p><label>Stock</label><input type="text" placeholder="stock" name="stock" class="d-block" value="<?php echo $stock  ?>"></p>
                <p><label>Description</label><textarea  name="description" rows="10" cols="80" class="d-block"><?php echo $descr  ?></textarea></p>  
                
                <div style="display: flex; gap: 25px; align-items: center;">
                    <label>Do you want Delete Item:</label>
                    <label for="yes">Yes</label>
                    <input type="radio" name="isdelete" id="yes" value="yes" <?php if ($isdeleted === 'yes') echo 'checked'; ?>>
                    <label for="no">No</label>
                    <input type="radio" name="isdelete" id="no" value="no" <?php if ($isdeleted === 'no') echo 'checked'; ?>>
                </div>
           
                <input type="submit" type="submit" name="update" value="Update" class="d-block"><br>
                <a href="admin.php" style="float:left;"><h4>Back to admin panel</h4></a>
                
                
        </form>
       
        

    </div>
    
<?php include('include/footer.php'); ?>


<?php mysqli_close($connection); ?>