<?php include('include/connection.php');session_start(); ?>


<!-- user reg  -->
<?php
    $errors = array();
    $suc = array();
    $errors2 = array();
    $suc2 = array();
    if(isset($_POST['loginreg']))
    {
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $pass = mysqli_real_escape_string($connection,$_POST['pass']);
        $hash = sha1($pass);

        $querycheck = "SELECT * FROM user WHERE email='{$email}'";
        $resultcheck = mysqli_query($connection,$querycheck);

        if($resultcheck)
        {
            if(mysqli_num_rows($resultcheck)==0)
            {
                $query = "INSERT INTO user(email,userName,pass,position) VALUES('{$email}','{$username}','{$hash}','user')";
                $result = mysqli_query($connection,$query);
                if($result)$suc[]= 'User Registerd Successfully,<br>Please Login with new credential';
                else echo 'query not added ';
                
            }
            else $errors[]= 'Email Already exist';
            
        }
        else $errors[]= 'querycheck failed';
    }
?>

<!-- user log  -->
 <?php
    
    if(isset($_POST['loginsub']))
    {

        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $pass = mysqli_real_escape_string($connection,$_POST['pass']);
        $hash = sha1($pass);
        

        $query = "SELECT * FROM user WHERE (email='{$email}' && pass='{$hash}') LIMIT 1";
        $result = mysqli_query($connection,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $rec = mysqli_fetch_assoc($result);
                $_SESSION['user'] = $rec['userId'];
                $_SESSION['position'] = $rec['position'];
                if($_SESSION['position'] == "admin")
                    {
                        header('Location: dashboard.php');
                    }
                else header('Location: home.php');
            }
            $errors2[]= 'Login failed';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
body {
    font-family: "Poppins" , sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #ff5353;
}
.container {
    margin-left: 50px;
    display: flex;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form-container {
    flex: 1;
    padding: 60px;
    border-right: 1px solid #ddd;
}
.form-container:last-child {
    border-right: none;
}
h1{
    color: rgb(255, 255, 255);
}
h2 {
    color: rgb(77, 77, 77);
    font-weight: bold;
    margin-left: 0;
    align-items: left;
    margin-bottom: 20px;
    
}
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #7c7c7c;
}
input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 5px;
    margin-bottom: 20px;
    border: 2px solid #ffffff;
    border-bottom: solid#df3939;
    border-radius: 5px;
}
input:focus {
    background-color: #ffffff; /* Change the color here */
    border-color: #df3939; /* Change the border color here */
    outline: none;
}
input[type="checkbox"] {
    margin-right: 10px;
}
.button {
    width: 100%;
    padding: 10px;
    margin: 10px;
    background-color: #df3939;
    border: none;
    border-radius: 15px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}
.button:hover {
    background-color: #680505;
}
.form-footer {
    text-align: center;
    margin-top: 10px;
    color: #666;
}
.form-footer a {
    color: #007bff;
    text-decoration: none;
}
.form-footer a:hover {
    text-decoration: underline;
}
ul {
    list-style: none;
    padding: 0;
}
ul li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}
ul li::before {
    content: '✔';
    margin-right: 10px;
    color: #28a745;
} 
    </style>
</head>
<body>
    <h1>Welcome to Arcade Alley!</h1>
    <div class="container">
        <div class="form-container">
            <?php
            if(!empty($errors2))
                    {
                        $code2 = '<div style="color:red;">';
                        foreach($errors2 as $i)
                        {
                            $code2 .= '<p><b>'.$i.'</b></p>';
                        }
                        $code2 .= '</div>';
                        echo $code2;
                    }
            ?>        
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="login-email">Enter your Email address*</label>
                <input type="email" id="login-email" name="email" required>

                <label for="login-password">Enter your Password *</label>
                <input type="password" id="login-password" name="pass" required>

                <input type="checkbox" id="remember-me" name="remember" >
                <label for="remember-me" style="display: inline;">Remember me</label>

                <button type="submit" class="button" name="loginsub">Log in</button>
            </form>
            <div class="form-footer">
                <a href="#">Lost your password?</a>
            </div>
        </div>
        <div class="form-container">
            <?php 
                if(!empty($errors))
                {
                    $code = '<div style="color:red;">';
                    foreach($errors as $i)
                    {
                        $code .= '<p><b>'.$i.'</b></p>';
                    }
                    $code .= '</div>';
                    echo $code;
                }
                if(!empty($suc))
                {
                    $code = '<div style="color:green;">';
                    foreach($suc as $i)
                    {
                        $code .= '<p><b>'.$i.'</b></p>';
                    }
                    $code .= '</div>';
                    echo $code;
                }
                
            ?>

            <h2>Register</h2>
            <form action="login.php" method="POST">
                <label for="register-name">Name *</label>
                <input type="text" id="register-name" name="username" required>

                <label for="register-email">Email address *</label>
                <input type="email" id="register-email" name="email" required>

                <label for="register-password">Password *</label>
                <input type="password" id="register-password" name="pass" required>

                <button type="submit" class="button" name="loginreg">Register</button>
            </form>
            <div class="form-footer">
                <p>Sign up today and you will be able to:</p>
                <ul>
                    <li>Speed your way through checkout</li>
                    <li>Track your orders easily</li>
                    <li>Keep a record of all your purchases</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>


<?php mysqli_close($connection); ?>