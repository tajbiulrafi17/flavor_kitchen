<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Flavor Kitchen</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <form action="" method="POST" class="text-center">
                 Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>  
            </form>
            <br><br> 
            <p  class="text-center">Developed By - <a href="#">Tajbiul</a>, <a href="#">Sadman</a>, <a href="#">Sazzad</a></p>
        </div>
    </body>
</html>

<?php 

    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1){
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            header('location:'.SITEURL.'admin/');
        }else{
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";

            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>