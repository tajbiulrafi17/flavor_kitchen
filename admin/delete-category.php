<?php 

    include('../config/constants.php');


    //Check whether the id and image value is set or not
    if(isset($_GET['id']) AND isset($_GET['image']))
    {
        $id = $_GET['id'];
        $image = $_GET['image'];

        //Remove the physical image file is available
        if($image != "")
        {
            $path = "../images/category/".$image;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";

                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the Process
                die();
            }
        }

        $sql = "DELETE FROM category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>