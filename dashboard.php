<?php include('include/connection.php');include('include/admincheck.php'); ?>

<!-- ADD Product  -->
<?php
    if(isset($_POST['submit-add']))
    {
        
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

            $query = "INSERT INTO product(title,descript,price,img,isDeleted,catName,nickName,stock) VALUES('{$title}','{$descr}','{$price}','{$img}','no','{$cat}','{$nickname}','{$stock}')";
            $result = mysqli_query($connection,$query);
            if($result)
            {
                $suc[] = "Query added Successfully";
            }
            else{
                $errors[] =  "Query Failed". mysqli_error($connection);;
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
                    //product-image
                    $codtable .= '<tr><td><img src="'.$rec['img'].'" style="width:3vw;height:auto;"></td>';
                    $codtable .= '<td>'.$rec['nickName'].'</td>';
                    $codtable .= '<td><a href="updateform.php?pid='.$rec['id'].'">Update</a></td>';
                    $codtable .= '</tr>';


                
                }
            }
        }
    }
?>

<!-- past orders  -->
<?php    
    $orderTableCode = '';
    $query = "SELECT * FROM userorder WHERE isConfirmed=1";
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
            $orderTableCode .= "</tr>";
        }
    }
?>

<!-- show item which are not confirmed  -->
<?php    
    $orderTableCode2 = '';
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



            $orderTableCode2 .= "<tr>";
            $orderTableCode2 .= "<td>".$rec['orderID']."</td>";
            $orderTableCode2 .= "<td>".$rec['nickname']."</td>";
            $orderTableCode2 .= "<td>Rs. ".$rec['price'].".00</td>";
            $orderTableCode2 .= "<td>".$rec['quantity']."</td>";
            $orderTableCode2 .= "<td>".$rec2['userName'].'<br>'.$rec2['address'].'<br>'.$rec2['tp']."</td>";
            $orderTableCode2 .= '<td><a href="dashboard.php?oid='.$rec['orderID'].'&qtty='.$rec['quantity'].'&iid='.$item.'">Confirm</a></td>';
            $orderTableCode2 .= "</tr>";
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

            header('Location: dashboard.php');
        }
    }
?>
 





<!-- ********************************************************************HTML******************************************************************** -->









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <style>
        body {
          background-image: url("images/admin.jpg");
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
        </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-section dashboard-title">
                <h2>Admin Dashboard  Arcade Alley</h2>
            </div>
            <button class="sidebar-section product-management" onclick="showSection('product-management')">
                <h3>Product Management</h3>
            </button>
            <button class="sidebar-section order-management" onclick="showSection('order-management')">
                <h3>Order Management</h3>
            </button>
        </aside>
        <main class="main-content">
            <section id="product-management" class="card section-content">

            <!-- Add Product -->

                <h4><a href="myaccount.php" style="color:black;float:right;">My Account</a></h4>

                <!-- show errors and success  -->
                <div>
                    <?php

                        if(!empty($errors))
                        {
                            foreach($errors as $e)
                            {
                                echo "<p style='color:red;'>$e</p>";
                            }
                        }
                        if(!empty($suc))
                        {
                            foreach($suc as $e)
                            {
                                echo "<p style='color:green;'>$e</p>";
                            }
                        }

                    ?>
                </div>

                <h3>Add a Product</h3>
                <form method="POST" action="dashboard.php" enctype="multipart/form-data">
                    <label for="product-name">Product title:</label>
                    <input type="text" id="product-name" name="title" required>
                    
                    <label for="product-name">Product nickname:</label>
                    <input type="text" id="product-name" name="nickname" required>
                    
                    <label for="product-category">Product Category:</label>
                    <select name="cat" id="" style="width:40%;padding:10px;">
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
                    
                    
                    <label for="product-quantity">Product Quantity:</label>
                    <input type="number" id="product-quantity" name="stock" required>
                    
                    <label for="product-price">Product Price:</label>
                    <input type="text" id="product-price" name="price" required>

                    <label for="product-image">Product Image:</label>
                    <input type="file" id="product-image" name="imag">

                    <label for="desc">Description:</label>
                    <textarea  name="description" rows="10" cols="80" class="d-block" style="width:140%;"></textarea>
                    

                    <hr>
                    <button type="submit" name="submit-add">Add Product</button>
                </form>
                <!-- add catergery  -->
                    
                    <form action="dashboard.php" method="post">

                        <h3>Add Product Category</h3>
                        <label for="pro-category">Category:</label>
                        <input type="text" id="pro-category" name="catName">
                        <button type="submit" name="catSubmit">Add Product Category</button>
                    </form>
                    <hr>

                    <form action="dashboard.php" method="post">
                        <div class="update-products">
                            <h3>Update Products</h3>
                            <div class="search-bar">
                                <input type="text" placeholder="Search Products..." name="keywrd">
                                <button type="submit" name="upSubmit">Search</button>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <!-- <td><img src="spiderman2.jpg" alt="Product Image" class="product-image"></td> -->
                                        <?php 
                                            echo $codtable;
                                        ?>
                                    
                                </tbody>
                            </table>
                        </div>
                </form>
            </section>
            <section id="order-management" class="card section-content hidden">
                <h3>Order Management</h3>
                <div class="order-list">
                    <h4>Past Orders</h4>
                    <table>
                        <?=$orderTableCode;?>
                    </table>
                </div>
                <div class="order-list">
                    <h4>Pending Orders</h4>
                    <table>
                        <?=$orderTableCode2?>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                if (section.id === sectionId) {
                    section.classList.remove('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>

<?php mysqli_close($connection); ?>
