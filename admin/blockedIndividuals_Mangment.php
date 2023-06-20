<?php 

include "structuralAdminPage.php";


if(isset($_GET['IndividualsApprovedId']) && isset($_GET['name'])){
    $individual_ID = $_GET['IndividualsApprovedId'];
    $name= $_GET['name'];
    echo ' 
        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
            <img src="assets/imgs/question.jpg" >
            <h2 style="color:var(--nav-main);">Question</h2>
            <p style="margin-bottom:3rem;">Are you sure you want to Approve <span style="color:red; font-weight:500;">'.$name.'</span>?</p>
            
            
            <a href="blockedIndividuals_Mangment.php?individual_ID='.$individual_ID.'" class="choice-btn yes">yes</a>
            <a href="blockedIndividuals_Mangment.php" class="choice-btn no">No</a>
        </div>
    ';
}



///IF THE ADMIN CLICK ON Pending
if(isset($_GET['IndividualsPendingId'])){
    $IndividualsPendingId = $_GET['IndividualsPendingId'];
    $update_company = mysqli_query($conn, "UPDATE `individuals` SET individual_Status='pending' WHERE individual_ID ='$IndividualsPendingId'");
    echo '<script>window.location.href = "blockedIndividuals_Mangment.php";</script>';

}
///IF THE ADMIN CLICK ON Block
if(isset($_GET['individual_ID'])){
    $individual_ID = $_GET['individual_ID'];
    $update_company = mysqli_query($conn, "UPDATE `individuals` SET individual_Status='approved' WHERE individual_ID ='$individual_ID'");
    echo '<script>window.location.href = "blockedIndividuals_Mangment.php";</script>';
}

?>


<head>
    <style>
     .empty{
  
  color: var(--black);
  
  background-image: linear-gradient(to bottom, var(--nav-main), rgb(255, 255, 255));
   
  
 }  
.choice-btn{
    padding: 0.7rem;
    width: 30px;
    border-radius: 10px;
    color: #fff;
    font-weight: 400;
    font-size: large;
    background-color: var(--nav-main);
    
    transition: 1s ease;
    margin-left:2rem;
    box-shadow: 0 5px 10px rgba(0,0,0,0.7);
}
.yes:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: #39ff14;
}
.no:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: red;
}


       .details{
        
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        width: 100%;
      }
      .foods-btn{
  background-color:#ffd700;
  color: var(--white);
  border-radius: 10px;
  text-decoration: none;
  
  width: 11rem;

  padding: 0.7rem;
    
    
    
    font-weight: 400;
    font-size: large;
    
    border: none;
    transition: 0.5s ease;
  

}
.foods-btn:hover{
  
  letter-spacing: 0.4rem;
  width: 13rem;
  cursor: pointer;

}
.navigation ul li a.actived::before,
.navigation ul li a.actived::before{
  content: "";
  position: absolute;
  right: 0;
  top: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px 35px 0 10px var(--white);
  pointer-events: none;
}
.navigation ul li a.actived::after,
.navigation ul li a.actived::after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px -35px 0 10px var(--white);
  pointer-events: none;
}

.navigation ul li a.actived {
  color: var(--nav-main);
  background-color: var(--white);
}

       
    </style>
</head>

                            <style>
                                .scroll{
                                    overflow: scroll;
                                }
                                .scroll::--webkit-scrollbar{
                                    display:none;
                                }
                            </style>
           
            <!-- ================ Blocked Individuals List ================= -->
            <div class="details">
                <?php
                   $select_blocked_Individuals = mysqli_query($conn, "SELECT * FROM `individuals` WHERE individual_Status='blocked' ");
                   $blocked_companies_count = mysqli_num_rows($select_blocked_Individuals);



                   echo '                   
                        <div class="recentOrders scroll">
                            <div class="cardHeader" style="margin:2.5rem 0 ;     justify-self: left;     place-items: center;">
                                <a href="Individuals_Managementy.php" style="display: flex;     place-items: center;">
                                    <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                                    <h2 style="margin: 0 20px;">Blocked Individuals</h2>
                                </a>
                                
                            </div>
        
                            <table >
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>image</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Country</td>
                                    <td>View Profile</td>
                                    <td>Edit</td>
                                    
                                    
                                </tr>

                                </thead>
                   ';


                   if ($blocked_companies_count >0) {
                ?>

                        <!-- Search Bar -->
                        
                        <tbody id="containerApprovedROW">
                            
                                <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                    <i class="fa fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="" id="search-item" placeholder="Search By Company Name" onkeyup="blockedCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
                                </div>




                            <form action="" method="post">
                        <?php
                             $number = 0;
                             
                                while ($fetch_blocked_Individuals = mysqli_fetch_assoc($select_blocked_Individuals)) {
                                    $number +=1; 
                                    $individual_ID = $fetch_blocked_Individuals['individual_ID'];

                                    
                        ?>
                            <tr id="singleROW">
                                <td><?= $number ?></td>
                                <td width="60px">
                                    <div class="imgBx" style="width: 60px ; height:60px; border-radius:0;">
                                        <img src="../images/individuals_images/<?= $fetch_blocked_Individuals['individual_photo']; ?>" alt="">
                                    </div>
                                </td>
                                <td class="companyName">
                                    <p>
                                        <?= $fetch_blocked_Individuals['individual_Name']; ?>
                                    </p>
                                </td>
                                <td><?= $fetch_blocked_Individuals['individual_Email']; ?></td>
                                <td><?= $fetch_blocked_Individuals['individual_Country']; ?></td>

                                <td><a href="../viewIndividualsProfile.php?individual_ID=<?= $individual_ID; ?>" class="foods-btn" target="_blank">View</a></td>
                                <!--   <td><input type="submit" class="delete-btn"  name="delete-btn"  value="Block"></td> -->
                                <td style="display: flex;  ">
                                    <a href="blockedIndividuals_Mangment.php?IndividualsPendingId=<?= $fetch_blocked_Individuals['individual_ID']; ?>&name=<?= $fetch_blocked_Individuals['individual_Name']; ?>"  class="delete-btn" style="background-color: cadetblue;">Pending</a>
                                
                                    <a href="blockedIndividuals_Mangment.php?IndividualsApprovedId=<?= $fetch_blocked_Individuals['individual_ID']; ?>&name=<?= $fetch_blocked_Individuals['individual_Name']; ?>"  class="delete-btn accept" style="background-color: #39ff14;">Approved</a>
                                </td>
                                
                            </tr>

                            <!-- Script Search Bar -->

                            <script type="text/javascript">
                                function blockedCompanySearch() {
                                    let filter = document.getElementById('search-item').value.toUpperCase();
                                    let singleROW = document.querySelectorAll('#singleROW');
                                    let l = document.getElementsByTagName('p');
                                    
                                    for(var i = 0; i<=l.length ;i++){
                                        let match=singleROW[i].getElementsByTagName('p')[0];
                                        let value=match.innerHTML || match.innerText || match.textContent;
                                        
                                        
                                        if(value.toUpperCase().indexOf(filter) > -1) {
                                            singleROW[i].style.display="";
                                        }
                                        else
                                        {
                                            singleROW[i].style.display="none";
                                        }
                                    }
                                }
                            </script>


                       <?php
                                  }
                                
                             ?>

                            </form>
                        </tbody>
                    </table>
                </div>
            <?php
                }
                else{
                echo '</table>
                <p class="empty" style="width: fit-content; margin-bottom: 19%;">
                    No Blocked Individuals Yet!
                </p>';
                }
            ?>
                
            </div>
        </div>
    </div>












</div>
    <title>Blocked Individuals</title>

    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>

</body>

</html>