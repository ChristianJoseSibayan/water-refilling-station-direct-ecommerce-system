<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atlastis Water Refilling Station</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>

        <br>

        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            
            if(isset($_SESSION['not-login-message'])){
                echo $_SESSION['not-login-message'];
                unset($_SESSION['not-login-message']);
            }

        ?>
        

        <!-- Login form starts here -->

        <form action="" method="POST" class="text-center">
            <br>
            Username: 
            <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>

        <!-- Login form ends here -->
    </div>
</body>
</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //Process  for login
        //1. Get the data from log in form
        //secured the code from sql injection using mysqli_real_escape_string() build in function
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the use exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //user available
            $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
            $_SESSION['user'] = $username; //to check whether the user is log on or not, and logout will unset it

            //redirect to Home page or dashboard
            header('location:'.SITEURL.'admin/');
        }
        else{
            //user not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //redirect to Home page or dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>

