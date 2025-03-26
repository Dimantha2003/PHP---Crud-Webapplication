<?php include('include/connection.php');include('include/admincheck.php'); ?>
<?php
    
    $title = '';
    $price = '';
    $descr = '';
    $cat = '';
    $nicknamename = '';
    $stock = '';
    $isdeleted = '';
    $id ='';

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
            if($result)
            {
                echo "Query Update Success";
                header('Location: updateform.php?pid=1');
            }
            else echo "Not Updated";
    }
?>



















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/updateform.css">
    <link rel="icon" type="image/png" href="images/favicon.png"> 
    <style>
        body {
          background-image: url("images/update.jpg");
          background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        </style>
</head>
<body>
    <div class="container">
        <h1>Update Product</h1>
        <form action="updateform.php" method="post">
            <label for="product-id">Product ID</label>
            <input type="text" id="product-id" name="id" value="<?php if(!empty(trim($id))) echo $id; else echo 0  ?>" readonly>

            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?php echo $title  ?>" required>

            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="<?php echo $price  ?>"  required>

            <label for="nick-name">Nick Name</label>
            <input type="text" id="nick-name" name="nickname" value="<?php echo $nicknamename  ?>" required>

            <label for="stock">Stock</label>
            <input type="number" id="stock"  name="stock"  value="<?php echo $stock  ?>" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="6" required><?php echo $descr  ?></textarea>

            <div style="display: flex; gap: 25px; align-items: center;">
                    <label>Do you want Delete Item:</label>
                    <label for="yes">Yes</label>
                    <input type="radio" name="isdelete" id="yes" value="yes" <?php if ($isdeleted === 'yes') echo 'checked'; ?>>
                    <label for="no">No</label>
                    <input type="radio" name="isdelete" id="no" value="no" <?php if ($isdeleted === 'no') echo 'checked'; ?>>
                </div>

            <button type="submit" class="btn" name="update">Update</button>
        </form>
        <a href="dashboard.php" class="admin-link">Back to admin panel</a>
    </div>
</body>
</html>

<?php mysqli_close($connection); ?>