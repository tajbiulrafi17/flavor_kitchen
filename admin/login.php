<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Flavor Kitchen</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h2 class="text-center">Flavor Kitchen Admin Panel</h2>
            <br><br>
            <h1 class="text-center">Login</h1>
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
                <input type="text" name="username" value="<?php if (isset($_COOKIE["user"])){
                    
                    $encryptedUsername = $_COOKIE["user"];
                    // Store cipher method - AES-128-CTR/BF-CBC
                    $ciphering = "AES-128-CTR";
                    $decryption_key = "user";
                    $decryptedUsername = openssl_decrypt ($encryptedUsername, $ciphering, $decryption_key);

                    echo $decryptedUsername;
                
                }?>" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" value="<?php if (isset($_COOKIE["pass"])){
                    
                    $encryptedPassword = $_COOKIE["pass"];
                    // Store cipher method
                    $ciphering = "AES-128-CTR";

                    $decryption_key = "pass";
                    // Descrypt the string
                    $decryptedPassword = openssl_decrypt ($encryptedPassword, $ciphering, $decryption_key);

                    echo $decryptedPassword;
                    
                }?>" placeholder="Enter Password"><br><br>

                <label><input type="checkbox" name="remember" <?php if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){ echo "checked";}?>> Remember me </label>
                <br><br> 
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

            $row=mysqli_fetch_array($res);
             
            if (isset($_POST['remember'])){

                $username = $_POST['username']; 
                $password = $_POST['password'];      

                $ciphering = "AES-128-CTR";
                $encryption_key_u = "user";
                $encryption_key_p = "pass";

                $encryptedUsername = openssl_encrypt($username, $ciphering, $encryption_key_u);
                $encryptedPassword = openssl_encrypt($password, $ciphering, $encryption_key_p);

                //set up cookie
                setcookie("user", $encryptedUsername, time() + (60 * 60 * 24 * 1)); 
                setcookie("pass", $encryptedPassword, time() + (60 * 60 * 24 * 1)); 

            }else{

                if (isset($_COOKIE["user"]) AND isset($_COOKIE["pass"])){
                    setcookie("user", '', time() - (3600));
                    setcookie("pass", '', time() - (3600));
                }

            }

            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            header('location:'.SITEURL.'admin/');
        }else{
 
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";

            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>