<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Old Password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder="OLd Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">;
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td>
                            <input type="passowrd" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            
            </form>
        </div>
</div>

<?php

                //check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";

                    //1-Get the data from form
                    $_id=$_POST['id'];
                    $current_password=md5($_POST['current_password']);
                    $new_password=md5($_POST['new_password']);
                    $confirm_password=md5($_POST['confirm_password']);

                    //2-check whether the user with current id and current password or not
                   $sql= "SELECT*  FROM tbl_admin WHERE id=$id AND password='$current_password'";
                    
                   //execute the query
                   $res=mysqli_query($conn,$sql);
                   if($res==true)
                   {
                       $count=mysqli_num_rows($res);
                       if($count==1)
                       {
                           //user exists and password and can be changed
                           //echo "User found";
                           //check whether the new password and confirm password match or not
                           if($new_password==$confirm_password)
                            {
                                //update password
                                $sql2="UPDATE tbl_admin SET
                                    password='$new_password'
                                    WHERE id=$id
                                
                                ";
                                
            
                            }
                            else{
                                //redirect to manage admin page with error
                                $_SESSION['pwd-not-match']="<div class='error'>Password did not Match.</div>";
                                header('location:'.SITEURL.'admin/manage_admin.php');
                            }
                       }
                       else{
                           //user doesn't exist set message and redirect
                           $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                           //redirecting the user
                           header('location:'.SITEURL.'admin/manage_admin.php'); 
                       }
                   }

                    //3-check whether the new password and confirm password match or not

                    //4-Change Passwrod if all above is true
                }
?>



<?php include('partials/footer.php');?>