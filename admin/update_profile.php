<?php 

require_once "structuralAdminPage.php";


// when click update
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
 
 
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass_database = $_POST['prev_pass_database'];
    $old_pass = md5($_POST['old_pass']);
    
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = md5($_POST['confirm_pass']);
    
 
    if($old_pass != $prev_pass_database){

        //echo "<script> openPopup(); </script>";
        echo '<div class="popup " id="popup">
    <img src="assets/imgs/error.jpg" >
    <h2>Warning!</h2>
    <p>old password not matched!</br> Try again!</p>
    <button type="button" onclick="closePopup()">OK</button>
</div>
';
       
    }elseif($new_pass != $confirm_pass){
        //echo "<script> openPopup(); </script>";
        echo '<div class="popup " id="popup">
    <img src="assets/imgs/error.jpg" >
    <h2>Warning!</h2>
    <p>confirm password not matched!</br> Try again!</p>
    <button type="button" onclick="closePopup()">OK</button>
</div>

    
     ';
       
    }else{
        // $update_profile_name = mysqli_query($conn, "UPDATE `admin` SET username = '$name' WHERE admin_id  = '$admin_id'");
        $update_profile_email = mysqli_query($conn, "UPDATE `admin` SET email = '$email' WHERE admin_id  = '$admin_id'");
        $update_admin_pass = mysqli_query($conn, "UPDATE `admin` SET password = '$confirm_pass' WHERE admin_id  = '$admin_id'");
          
          //echo "<script> openPopup(); </script>";
          echo '
          <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
            <img src="assets/imgs/tick.png" >
            <h2 style="color:green;">Thank you!</h2>
            <p >profile updated successfully! Thanks!</p>
            <button type="button" style="background: #6fd649;" onclick="closePopup()">OK</button>
        </div>
          ';
    }
    
 }
?>
         <?php
            $select_profile = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id = '$admin_id'");
            
            $fetch_profile = mysqli_fetch_assoc($select_profile)
         ?>

            <div class="details">
                <section class="form-container" style="margin-top: 5rem;">

                <form action="" method="post">
                    <h3>update profile</h3>
                    <input type="hidden" name="prev_pass_database" value="<?= $fetch_profile['password']; ?>">
                    <h3 style="color:black ;" name="name" class="box">--> <?= $fetch_profile['username']; ?> <--</h2>
                    <input type="email" required pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' style="color:black ;" name="email"  value="<?= $fetch_profile['email']; ?>" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                    <input type="password" required style="color:black ;" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                    <input type="password" required style="color:black ;" name="new_pass" placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                    <input type="password" required style="color:black ;" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                    <div class="button">
                        <input type="submit" value="update now"  name="submit">
                    </div>
                </form>

                </section>
            </div>
            

        </div>
    </div>




    
    
    
    
    <link rel="stylesheet" href="assets/css/add-admin.css">
    
</body>
<title>Update Profile</title>
<script>
    function closePopup(){
        var popup = document.getElementById("popup");
        popup.classList.add("open-popup");
    } 
</script>

</html>