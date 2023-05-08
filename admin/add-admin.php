<?php include('components/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>

        <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    
        ?>
        <br>
        <br>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('components/footer.php') ?>

<?php

if(isset($_POST['submit']))
{
    // 1. get data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with md5

    // 2.SQL query
    $sql = "INSERT INTO admin SET
        name='$name',
        username='$username',
        password='$password'
    ";

    // 3.executiong query and save data to DB
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // 4.check
    if($res==TRUE){
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.<div>";

        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin. Try Again Later.<div>";

        header("location:".SITEURL.'admin/add-admin.php');
    
    }

}

?>