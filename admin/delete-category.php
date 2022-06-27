<?php 
    //include Constant file
    include('../config/constants.php');
    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //image is Available. So remove it
            $path = "../images/category/".$image_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove image then add an error mesage and stop the process
            if($remove==false)
            {
                //Set the Session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to menage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the proicess
                die();
            }
        }

        //Delete Data from DB
        //SQL query to Delete Data from DB
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from DB or not
        if($res==true)
        {
            //Set Success Message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to Manage Category Page 
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>