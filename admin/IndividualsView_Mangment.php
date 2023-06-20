<?php 

include "structuralAdminPage.php";

// mysqli_report(MYSQLI_REPORT_STRICT);


 //alert window for confirm the deletion of a company
//  if(isset($_GET['rid'])){
//     $individual_ID= $_GET['rid'];
 
    
//  $delete_company = mysqli_query($conn, "UPDATE `companies` SET status='rejected' WHERE id='$individual_ID'");
 
//  header("location:companiesView_Mangment.php");

//  }

//  companyblockid
  if(isset($_GET['companyblockid']) && isset($_GET['name'])){
    $cid = $_GET['companyblockid'];
    $name= $_GET['name'];
    echo ' 
    <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
    <img src="assets/imgs/question.jpg" >
    <h2 style="color:var(--nav-main);">Question</h2>
    <p style="margin-bottom:3rem;">Are you sure you want to block <span style="color:var(--nav-main); font-weight:500;">'.$name.'</span>?</p>
    
    
    <a href="companiesView_Mangment.php?cid='.$cid.'" class="choice-btn yes">yes</a>
    <a href="companiesView_Mangment.php" class="choice-btn no">No</a>

    

</div>



';
}



///IF THE ADMIN CLICK ON Pending
if(isset($_GET['companypendingid'])){
    $companypendingid = $_GET['companypendingid'];
    $update_company = mysqli_query($conn, "UPDATE `company` SET company_Status='approved' WHERE individual_ID ='$companypendingid'");
    header("location:companiesView_Mangment.php");

}
///IF THE ADMIN CLICK ON Block
if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
    $update_company = mysqli_query($conn, "UPDATE `company` SET company_Status='blocked' WHERE individual_ID ='$cid'");
    header("location:companiesView_Mangment.php");

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


           
            <!-- ================ pending companies List ================= -->
            <div class="details">
                            <style>
                                /* .scroll{
                                    overflow: scroll;
                                } */
                                .scroll::--webkit-scrollbar{
                                    display:none;
                                }
                            </style>

                <?php
                   $select_individuals = mysqli_query($conn, "SELECT * FROM individuals ");
                   $individuals_count = mysqli_num_rows($select_individuals);



                   echo '
                        <div class="recentOrders scroll">
                            
                            <div class="cardHeader" style="margin:2.5rem 0 ;     justify-self: left;     place-items: center;">
                                <a href="Individuals_Managementy.php" style="display: flex;     place-items: center; ">
                                    <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                                    <h2 style="margin: 0 20px;">Individuals</h2>
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
                                     
                                    
                                </tr>

                                </thead>
                   ';


                   if ($individuals_count >0) {
                ?>

                        <!-- Search Bar -->
                        
                        <tbody id="containerpendingROW">
                            
                                <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                    <i class="fa fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="" id="search-item" placeholder="Search By Individual Name" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
                                </div>




                            <form action="" method="post">
                        <?php
                                $number = 0;
                             
                                while ($fetch_individuals = mysqli_fetch_assoc($select_individuals)) {
                                    $number +=1; 
                                    $individual_ID = $fetch_individuals['individual_ID'];

                                    
                        ?>
                            <tr id="singleROW">
                                <td><?= $number ?></td>
                                <td width="60px">
                                    <div class="imgBx" style="width: 60px ; height:60px; border-radius:0;">
                                        <?php
                                            if($fetch_individuals['individual_photo'] != ""){
                                                echo '
                                                    <img src="../images/individuals_images/'. $fetch_individuals['individual_photo'] .'" alt="">
                                                ';
                                            }
                                            else{
                                                echo '
                                                    <img src="../images/individuals_images/default_Image.png" alt="">
                                                ';
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td class="companyName">
                                    <p>
                                        <?= $fetch_individuals['individual_Name']; ?>
                                    </p>
                                </td>
                                <td><?= $fetch_individuals['individual_Email']; ?></td>
                                <td><?= $fetch_individuals['individual_Country']; ?></td>

                                <td><a href="../viewIndividualsProfile.php?individual_ID=<?= $individual_ID; ?>" class="foods-btn" target="_blank">View</a></td>
                            </tr>

                            <!-- Script Search Bar -->

                            <script type="text/javascript">
                                function pendingCompanySearch() {
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
                    No Companies Yet!
                </p>';
                }
            ?>
                
            </div>
        </div>
    </div>












</div>
    <title>Individuals</title>

    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>

</body>

</html>