<?php include('include/connection.php');include('include/admincheck.php'); ?>

<!-- ADD Product  -->
<?php
    if(isset($_POST['submit-add']))
    {
        echo $_POST['cat'];
        $errors = array();
        $suc = array();        

        $keyword = array('title','description','price','nickname','stock');
        foreach($keyword as $key)
        {
            if(empty(trim($_POST[$key])))
            {
                $errors[] = "{$key} is not set";                
            }
        }

        if (isset($_FILES['imag'])) {
            $file_name = $_FILES['imag']['name'];
            $file_tmp = $_FILES['imag']['tmp_name'];
            if (move_uploaded_file($file_tmp, 'images/' . $file_name)) {
                $img = 'images/'. $file_name;
                
            } else {
                $errors[] = "Failed to upload file.";

            }
        }
        if(empty($errors))
        {
            $title = mysqli_real_escape_string($connection,$_POST['title']);
            $price = mysqli_real_escape_string($connection,$_POST['price']);
            $descr = mysqli_real_escape_string($connection,$_POST['description']);
            $cat = mysqli_real_escape_string($connection,$_POST['cat']);
            $nickname = mysqli_real_escape_string($connection,$_POST['nickname']);
            $stock = mysqli_real_escape_string($connection,$_POST['stock']);

            $query = "INSERT INTO product(title,descript,price,img,isDeleted,catName,nickName,stock) VALUES('{$title}','{$descr}','{$price}','{$img}',0,'{$cat}','{$nickname}','{$stock}')";
            $result = mysqli_query($connection,$query);
            if($result){
                $suc[] = "Query added Successfully";
            }
            else{
                $errors[] = "Query Failed";
            }
        }
    }
?>

<!-- Add Categorie   -->
<?php

    if(isset($_POST['catSubmit']))
    {
        $catName = '';
        if(!empty(trim($_POST['catName']))) 
        {
            $catName = mysqli_real_escape_string($connection,$_POST['catName']);   
                

            $query = "SELECT * FROM categorie WHERE catName='{$catName}'";
            $result = mysqli_query($connection,$query);
            if($result)
            {
                if(mysqli_num_rows($result)==0)
                {
                    $query = "INSERT INTO categorie(catName) VALUES('{$catName}')";
                    $result = mysqli_query($connection,$query);
                    if($result)
                    {
                        $suc[] = "categorie added Successfuly";
                    }
                     
                }
                else $errors[] = "The Catergorie name already exist"; 
            }
            else $errors[] = "cat search query failed";

        }
        else $errors[] = "Categorie name not set";
    }
?>

<!-- Update Product  -->
<?php 
    $codtable = '';
    if(isset($_POST['upSubmit']))
    {
        if(!empty(trim($_POST['keywrd'])))
        {
            $keywrd = mysqli_real_escape_string($connection,$_POST['keywrd']);
            
            $query = "SELECT * FROM product WHERE (title LIKE '%{$keywrd}%') ";
            $result = mysqli_query($connection,$query);
            if($result)
            {
                
                while($rec = mysqli_fetch_assoc($result))
                {
                    $codtable .= '<tr><td><img src="'.$rec['img'].'" style="width:3vw;height:auto;"></td>';
                    $codtable .= '<td>'.$rec['nickName'].'</td>';
                    $codtable .= '<td><a href="update.php?pid='.$rec['id'].'">Update</a></td>';
                    $codtable .= '</tr>';


                
                }
            }
        }
    }
?>
<!-- logout  -->
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



<?php $pagetitle="Admin Pannel";//include('include/header.php'); ?>

<body style="">
    <div class="container">
        <?php
                if(!empty($errors))
                {
                    foreach($errors as $error)
                    {
                        echo "<p> {$error} </p>";
                    }
                
                }
                if(!empty($suc))
                {
                    foreach($suc as $i)
                    {
                        echo "<p> {$i} </p>";
                    }            
                }
                ?>

                <!-- html for add product  -->
            <form action="admin.php" method="POST" enctype="multipart/form-data" class="container">
                <h1>Add Product</h1>
            <div style="display:flex;flex-direction:column;gap:4px;width:50%;">
                <input type="text" placeholder="title" name="title" class="d-block">
                <input type="text" placeholder="price" name="price" class="d-block">
                <input type="text" placeholder="nickname" name="nickname" class="d-block">
                <input type="text" placeholder="stock" name="stock" class="d-block">
                
                <select name="cat" id="" style="width:40%;">
                    <?php 
                        $query = "SELECT * FROM categorie";
                        $result = mysqli_query($connection,$query);
                        if($result)
                        {                        
                            $code = '';
                            while($dataset = mysqli_fetch_assoc($result))
                            {
                                $code .= '<option value="'.$dataset['catName'].'">'.$dataset['catName'].'</option>';
                            }
                        }
                        else "cant get cat menu";
                        echo $code;
                    ?>
                </select>
                <input type="file" placeholder="img" name="imag" class="d-block">
                <textarea  name="description" rows="10" cols="80" class="d-block" style="width:140%;"></textarea>            
                <input type="submit" type="submit" name="submit-add" value="Submit" class="d-block btn btn-dark" style="width:140%;" >
            </div>    
            </form>
            <hr>

            <!-- html for add category  -->
            <form action="admin.php" method="POST">
                <h1>Add Categorie</h1>
                <div style="margin-bottom:24px;display:flex;gap:10px;">             
                    <input type="text" placeholder="Categorie Name" name="catName">
                    <input type="submit" type="submit" name="catSubmit" value="Submit">
                </div>
            </form>
            <hr>

        <!-- html for update product  -->
            <form action="admin.php" method="POST">
                <h1>Update Product</h1>     
                <div style="margin-bottom:24px;display:flex;gap:10px;">       
                    <input type="text" placeholder="Search Item" name="keywrd" >
                    <input type="submit" type="submit" name="upSubmit" value="Search" ><br>
                </div>
                <table class="table">
                    <tr><th>image</th><th>Name</th><th>Update</th></tr>
                    <?php 
                        echo $codtable;
                    ?>
                </table>
            </form>

        <!-- link to order page  -->
            <hr>
            <a href="order.php"><h1 style="color:black;">Order List >>></h1></a>
            <hr>

        <!-- Logout  -->
        <form action="user.php" method='post'>
            <input type="submit" value="LOG OUT" name='logout'>
            <a href="user.php"><button>Go to My Account</button></a>
        </form>
        <hr>
        

    </div>
    <?php include('include/footer.php'); ?>


<?php mysqli_close($connection) ?>