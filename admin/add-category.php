<?php include('components/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                
                $sql = "INSERT INTO category SET 
                    title='$title',
                    image='',
                    featured='$featured',
                    active='$active'
                ";
                $res = mysqli_query($conn, $sql);

                // get id of this category for name of its image
                $sql = "SELECT * FROM category";
                $res = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                }

                //Check whether the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);
                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    $image = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image != "")
                    {
                        $ext = end(explode('.', $image));

                        $image = "Food_Category_".$id.'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image;

                        $upload = move_uploaded_file($source_path, $destination_path);

                       if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }

                    }
                }
                else
                {
                    $image="";
                }

                $sql = "UPDATE category SET 
                    image='$image'
                    WHERE id=$id
                ";

                $res = mysqli_query($conn, $sql);

                 if($res==true)
                {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";

                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('components/footer.php'); ?>