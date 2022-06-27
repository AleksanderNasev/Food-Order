<?php 
    //include constant page
    include('../config/constants.php');

    //echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
        //echo "Process to Delete";

        //1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available
        //check whether the image is available or not and deleete only if available
        if($image_name != "")
        {
            //It has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check whether the image is removed or not 
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //redirect to Manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process of deleting food
                die();
            }
        }

        //3. Delete food from DB
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        //4. Redirect to manage food with session message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //redirect to Manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            //redirect to Manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unautorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>