<?php 

include "structuralAdminPage.php";

// mysqli_report(MYSQLI_REPORT_STRICT);
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
  /* letter-spacing: 0.4rem; */
  width: 13rem;
  cursor: pointer;
  /* transform: scale(1.5); */
}
.view-td:hover{
  transform: scale(1.2);
  transition: 0.5s ease;
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
                   $select_courses = mysqli_query($conn, "SELECT * FROM courses ");
                   $courses_count = mysqli_num_rows($select_courses);



                   echo '
                        <div class="recentOrders scroll">
                            
                            <div class="cardHeader" style="margin:2.5rem 0 ; justify-self: left; place-items: center;">
                                <a href="courses_Management.php" style="display: flex; place-items: center; ">
                                    <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                                    <h2 style="margin: 0 20px;">Courses</h2>
                                </a>

                            </div>
        
                            <table >
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    
                                    <td>Name</td>
                                    <td>Category</td>
                                    <!--
                                    <td>Description</td>
                                    -->
                                    <td>Creator</td>
                                    <td>Fees</td>
                                    <td>View</td>
                                    <!--- 
                                    ---!>
                                     
                                    
                                </tr>

                                </thead>
                   ';


                   if ($courses_count >0) {
                ?>

                        <!-- Search Bar -->
                        
                        <tbody id="containerpendingROW">
                            
                                <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                    <i class="fa fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="" id="search-item" placeholder="Search By courses Name" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
                                </div>




                            <form action="" method="post">
                        <?php
                                $number = 0;
                             
                                while ($fetch_pending_companies = mysqli_fetch_assoc($select_courses)) {
                                    $number +=1; 
                                    $course_id = $fetch_pending_companies['course_ID'];

                                    
                        ?>
                            <tr id="singleROW">
                                <td><?= $number ?></td>
                                <td class="companyName">
                                    <p>
                                        <?= $fetch_pending_companies['course_Name']; ?>
                                </p>
                                </td>
                                <td><?= $fetch_pending_companies['course_Category']; ?></td>
                                <!-- <td>< $fetch_pending_companies['course_Description']; ?></td> -->
                                <td><?= $fetch_pending_companies['course_Creator']; ?></td>
                                <td><?= $fetch_pending_companies['course_Fees']; ?>$</td>

                                <td class="view-td">
                                    <a href="viewCourse.php?course_id=<?= $course_id; ?>" class="foods-btn" target="_blank">View</a>
                                </td>
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
                    No Courses Yet!
                </p>';
                }
            ?>
                
            </div>
        </div>
    </div>












</div>
    <title>Courses</title>
    <script>
        document.getElementById("CourseManagement-LeftBar").classList.add("actived");
    </script>
    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>

</body>

</html>