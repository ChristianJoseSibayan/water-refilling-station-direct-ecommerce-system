<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>

        <?php 
            //1. get the ID of selected admin
            $id=$_GET['id'];
            //2. create sql query to get the details  
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res=mysqli_query($conn, $sql);

            //check whether the quey is executed or not
            if($res==TRUE){
                //Check whether the data is availbale or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1){
                    //Get details    
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    //Redirect to manage admin  
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class=tbl-30>
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name='full_name' value='<?php echo $full_name; ?>'>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name='username' value='<?php echo $username; ?>'>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get all the values from forms to update
        $id = $_POST['id'];
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);

        //create sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not
        if($res==TRUE){
            //query exectuted and admin 
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php');?>