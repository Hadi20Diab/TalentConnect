<?php 

require_once "structuralAdminPage.php";

// addmin DELELT 
if(isset($_GET['aaid'])){
    $aid = $_GET['aaid'];
    $delete_admin = mysqli_query($conn, "DELETE FROM `admin` WHERE admin_id='$aid'");
    // print("$delete_admin");
    // header("location:admins.php");

}

if(isset($_GET['aid']) && isset($_GET['aname'])){
    $aid = $_GET['aid'];
    $aname = $_GET['aname'];
    
    echo ' 
        <div class="popup"  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
            <img src="assets/imgs/question.jpg" >
            <h2 style="color:var(--nav-main);">Question</h2>
            <p style="margin-bottom:3rem;">Are you sure you want to delete '.$aname.'?</p>
            
            
            <a href="admins.php?aaid='.$aid.'" class="choice-btn yes">yes</a>
            <a href="admins.php" class="choice-btn no">No</a>

        </div>

    ';
}



?>
               
                
            

            
            <!-- ================ Admins List Container================= -->
            <div class="details">
            <?php 
             $select_admins= mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id != '$admin_id' ORDER BY admin_id ");
             $admins_count = mysqli_num_rows($select_admins);



            // ADD ADMIN

             if(isset($_POST['submit'])){
   

                $name = mysqli_real_escape_string($conn,$_POST['name']);
                $email = mysqli_real_escape_string($conn,$_POST['email'] );
                $pass =mysqli_real_escape_string($conn, $_POST['pass'] );     
                $cpass = mysqli_real_escape_string($conn, $_POST['cpass'] );
                $adminRole = mysqli_real_escape_string($conn, $_POST['adminRole'] );
                
                 
                $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email'");
                
                if(mysqli_num_rows($select_admin) > 0){
                    
                    echo '
                        <div class="popup " id="popup">
                            <img src="assets/imgs/error.jpg" >
                            <h2>Warning!</h2>
                            <p>Email already exists!</br> Register with new email!</p>
                            <button type="button" onclick="closePopup()">OK</button>
                        </div>
                 ';
                }else{
                    if($pass != $cpass){
                        echo '
                            <div class="popup " id="popup">
                                <img src="assets/imgs/error.jpg" >
                                <h2>Warning!</h2>
                                <p>confirm password not matched!</br> Try again!</p>
                                <button type="button" onclick="closePopup()">OK</button>
                            </div>
                         ';
                    }else{
                        $encrypt_password=md5($pass);//we use md5 to encrypt the password
                        $insert_admin = mysqli_query($conn, "INSERT INTO `users`(user_Role) VALUES('$adminRole')");
                        $user_ID = mysqli_insert_id($conn); // Get the last inserted ID
                        
                        $insert_admin = mysqli_query($conn, "INSERT INTO `admin`(admin_id, admin_Name, email, password, role) VALUES('$user_ID', '$name', '$email', '$encrypt_password', '$adminRole')");
                        // $insert_admin = mysqli_query($conn, "INSERT INTO `admin`(admin_Name,email, password, role) VALUES('$name', '$email', '$encrypt_password', '$adminRole')");
                        
                        echo '
                            <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
                                <img src="assets/imgs/tick.png" >
                                <h2 style="color:green;">Thank you!</h2>
                                <p >new admin registered successfully!</p>
                                
                                <a href="admins.php" >
                                    <button type="button" style="background: #6fd649;" onclick="closePopup()">OK</button>
                                
                                </a>

                            </div>
                      ';
                        
                    }
                }
                 
            
            
                
            }
            




             echo '
             
             <div class="recentOrders">
                 <!-- <form action="" method="POST"> -->
                 <div class="cardHeader" >
                     <h2 >Admins</h2>
                     <!-- <button href="admins.php" >Add admin</a> -->
                     <button id="addAdminBtn" class="btn" onclick=showHideAddAdminSection()>Add admin</button>
                 </div>



                 <!-- ================ Add Admins ================ -->

                 <script>
                     
                     function showHideAddAdminSection() {
                         var addAdminBtn=document.getElementById("addAdminBtn");
                         var addAdminSection=document.getElementById("addAdminSection");
                         var addAdminBtnSubmit=document.getElementById("addADMINbtn");

                         if (addAdminSection.classList[1] == "addAdminSectionShow"){
                             addAdminSection.classList.remove("addAdminSectionShow");
             
                         }
                         else{
                             addAdminSection.classList.add("addAdminSectionShow");
     
                         }
                         
                     }


                     addAdminSubmit.onclick=function(){
                         showAddAdminSection();
                     }
                     addAdminBtn.onclick=function(){
                         hideAddAdminSection();
                     }

              
                 </script>
                 <link rel="stylesheet" href="assets/css/add-admin.css">


                 <section class="addAdminSection" id="addAdminSection">
                     <form action="" method="post">
                        <h3 class="titleHeader">register new admin</h3>
                        <input type="text" style="color: black;" name="name" required placeholder="Enter Name" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                        
                        <input type="email" style="color: black;"  pattern="/^[a-zA-Z0-9.!#$%&"*+-/=?\^_"{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" name="email" required placeholder="enter email" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                        
                        <input type="password" style="color: black;" name="pass" required placeholder="enter password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                        <input type="password" style="color: black;" name="cpass" required placeholder="confirm password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                         
                        <div>
                            <h4>Role:</h4>
                            <div style="     display: flex;     justify-content: space-around;     margin-bottom: 1rem; " >
                                <div>
                                    <input type="radio" name="adminRole" value="host" id="hostRole" required>
                                    <label for="hostRole">Host</label>
                                </div>
                                <div>
                                    <input type="radio" name="adminRole" value="moderator" id="moderatorRole" required>
                                    <label for="moderatorRole">Moderator</label>
                                </div>
                            </div>
                        </div>
                         
                        <div class="button">
                            <input type="submit" value="register now" id="addADMINbtn" name="submit">
                        </div>
                     </form>

                 </section>
             ';
             if ($admins_count >0) { ?>

                    <!-- </form> -->
                    <!-- ================ Admins List ================= -->
                    <section class="adminList">
                        <table>
                            <h3 class="titleHeader">Admin List</h3>
    
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <form action="" method="post">
                            <?php
                            
                               
                                while ($fetch_admins = mysqli_fetch_assoc($select_admins)) {
                               ?>
                            <tr >
                                   <input type="hidden" name="aid" value="<?= $fetch_admins['admin_id']; ?>">
                                   <input type="hidden" name="aname" value="<?= $fetch_admins['admin_Name']; ?>">
                                    <td><?= $fetch_admins['admin_id']; ?></td>
                                    <td><?= $fetch_admins['admin_Name']; ?></td>
                                    <td><?= $fetch_admins['email']; ?></td>
                                    
                                    <!--<td><input type="submit" class="delete-btn" name="delete-btn"  value="Delete"></td> -->
                                    <td><a href="admins.php?aid=<?= $fetch_admins['admin_id']; ?>&aname=<?= $fetch_admins['admin_Name']; ?>"  class="delete-btn">Delete</a></td>
                                </tr>
                                <?php
                           }
                    
                        ?>  
                           </form>
                            </tbody>
                        </table>
                    </section>
                </div>

                <?php }
            else{
                echo '<p class="empty">no admins added yet!</p>';
            } ?>
                            
                
                
            </div>
        </div>
    </div>


    <!-- main div closes tag -->
    </div>


    <title>Admins</title>
    <script>
        document.getElementById("admins-LeftBar").classList.add("actived");
        
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>
</body>

</html>
<!-- class="actived" -->
