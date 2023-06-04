<?php 
  include "structural_IndividualPage.php";

?>



<div class="cardBox">

  <a href="job_search.php">

      <div class="card">
              <div>
                  <div class="cardName">Search </div>
              </div>

              <div class="iconBx">
                  <i class="fa fa-solid fa-magnifying-glass"></i>
                  <!-- <img src="https://cdn-icons-png.flaticon.com/512/4300/4300058.png" class="cardImgIcon" alt=""> -->
                  <!-- <ion-icon name="" class="fa-thin fa-buildings"></ion-icon> -->
              </div>
      </div>

  </a>

  <a href="savedJob.php">
      <div class="card">

          <div>
              <div class="cardName">Saved</div>
          </div>

          <div class="iconBx">
            <i class="fa fa-duotone fa-bookmark"></i>
            <!-- <ion-icon name="storefront-outline"></ion-icon> -->
          </div>
      </div>

  </a>



</div>
<?php
// select jobs according to the user interest
$sql = "SELECT DISTINCT j.* FROM jobs j
        INNER JOIN individuals i ON j.job_Country = i.individual_Country OR j.job_Country IS NULL
        LEFT JOIN job_fields jf ON j.job_id = jf.job_ID
        LEFT JOIN individual_intrested_field ii ON i.individual_ID = ii.individual_ID 
        WHERE j.jobStatus = 'Open' AND jf.job_field_Name = ii.field_Name AND i.individual_ID = " . $individual_ID . " 
        ORDER BY j.postedDate DESC"; // order by post date to dispaly the new post first



$select_jobs = mysqli_query($conn, $sql);

$jobs_count = mysqli_num_rows($select_jobs);
    

   

    if ($jobs_count >0) {

        echo'
            <section class="PostContainer">
        ';

        while ($fetch_job = mysqli_fetch_assoc($select_jobs)) {
            $job_id = $fetch_job["job_id"];
            
            $deliveredBy = $fetch_job["deliveredBy"];
            
            // $company_id = $fetch_job["company_id"];
            


            $select_deliveredBy = mysqli_query($conn,
                "SELECT * FROM jobs 
                INNER JOIN company ON company.company_Name  = jobs.deliveredBy
                WHERE jobs.job_id  = $job_id"
            );
            $role="company";
            $count = mysqli_num_rows($select_deliveredBy);
        
         if (!$count >0) { // course creator not company so it's univeristy 
            $select_deliveredBy = mysqli_query($conn,
            "SELECT * FROM jobs 
            INNER JOIN universities ON universities.university_Name  = jobs.deliveredBy
            
            WHERE jobs.job_id  = $job_id"
            );
            $role="univeristy";

         }
        
         $fetch_job_Creator = mysqli_fetch_assoc($select_deliveredBy);
         
         if(!$fetch_job_Creator){
            echo mysqli_error($conn);
         }
        

        
         if($role=="company"){
        
            $company_id=$fetch_job_Creator['company_id'];
            $deliveredByLOGO=$fetch_job_Creator['company_Logo'];
         }
         else{
            $university_id=$fetch_job_Creator['university_ID'];
            $deliveredByLOGO=$fetch_job_Creator['university_Logo'];
         }
        






            
            
            ?>
                <div class="Post">
                    <div class="postHeader">
                        <div class="postTitle">
                            
        <!--  go to creator  job profile either company or university -->
<?php
         if($role=="company"){
            echo '
            <a href="../viewCompanyProfile.php?vcid=' . $company_id . '&cname=' . $deliveredBy . '" class="row" style="text-decoration: none;" target="_blank">
            ';
            
        }
        else{
            echo'
                <a href="../viewUniversityProfile.php?vcid=' . $university_id . '&cname=' . $deliveredBy . '" class="row" style="text-decoration: none;" target="_blank">
            ';
        }
?>

                                <img src="../images/companies_universities_images/<?= $deliveredByLOGO ?>" alt="">
                            
                            </a>
                
                            <div>
                                <h3>
                                    <?= $fetch_job['position']; ?>
                                </h3>
                                <br>
                                <h4>
                                    <?= $fetch_job['deliveredBy']; ?>
                                </h4>
                            </div>
                        </div>
            
                        <h4 class="deadline">
                            <?= $fetch_job['applicationDeadline']; ?>
                        </h4>
                    </div>
                    

                    <div class="postDetails">
                        <h5><?= $fetch_job['job_Country']; ?> - <?= $fetch_job['jobType']; ?> - <?= $fetch_job['job_WorkPlace']; ?></h5>
                        <a href="../viewJob.php?job_id=<?= $job_id; ?>" target="_blank">Read Details</a>
                            
                    </div>

<?php

$bookmarkSql = "SELECT * FROM bookmarks WHERE user_ID = $individual_ID AND user_role = 'individual' AND job_ID = " . $fetch_job['job_id'];

            // $bookmarkSql="SELECT * FROM bookmarks WHERE user_ID=$individual_ID AND user_role='individual' AND job_ID=$fetch_job['company_id'] ";
            $bookmarkResult = mysqli_query($conn, $bookmarkSql);
            $bookmarkCount=mysqli_num_rows($bookmarkResult);

                if(!$bookmarkCount>0){ //is not saved before 
                    echo'
                        <a  class="addBookmark" href="../addRemoveBookmark.php?job_ID='. $fetch_job['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=add" target="_black">

                            <i class="fa-regular fa-bookmark fa-2xl" ></i>
                        </a>
                        <a class="removeBookmark hide" href="../addRemoveBookmark.php?job_ID='. $fetch_job['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=remove" target="_black">
    
                            <i class="fas fa-bookmark fa-2xl" ></i>
                        </a>
                    ';
                }
                else{ // is saved before 
                    echo'
                    <a  class="addBookmark hide" href="../addRemoveBookmark.php?job_ID='. $fetch_job['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=add" target="_black">

                        <i class="fa-regular fa-bookmark fa-2xl" ></i>
                    </a>
                    <a class="removeBookmark" href="../addRemoveBookmark.php?job_ID='. $fetch_job['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=remove" target="_black">

                        <i class="fas fa-bookmark fa-2xl" ></i>
                    </a>
                ';
                }
// close post DIV
            echo'
                </div>
            ';

        }
        echo"</section>";
    }    
?>




<!-- script for Bookmarks add-remove -->
<script>

        var addBookmarks = document.querySelectorAll('.addBookmark');
        var removeBookmarks = document.querySelectorAll('.removeBookmark');

        // Add event listener for each addBookmark button
        addBookmarks.forEach(function(addBookmark) {
        addBookmark.addEventListener('click', function() {
            var parent = this.parentElement;
            var removeBookmark = parent.querySelector('.removeBookmark');

            removeBookmark.style.display = 'block'; // Show the removeBookmark element
            this.style.display = 'none'; // Hide the addBookmark element
        });
        });

        // Add event listener for each removeBookmark button
        removeBookmarks.forEach(function(removeBookmark) {
        removeBookmark.addEventListener('click', function() {
            var parent = this.parentElement;
            var addBookmark = parent.querySelector('.addBookmark');

            addBookmark.style.display = 'block'; // Show the addBookmark element
            this.style.display = 'none'; // Hide the removeBookmark element
        });
        });

    </script>






<style>
   .PostContainer{
        width: 80%;
        margin:3% 10%;
   } 
   .Post{
        padding: 15px;
        border-radius: 25px;
        background-color: #f3f2ef;
        box-shadow: 7px 7px 10px rgb(0 0 0 / 15%);
        margin: 30px 0px;

    }
   .postHeader , .postDetails{
        justify-content: space-between;
   }
   .postHeader, .postTitle, .postDetails{
        display: flex;
        flex-direction: row;
        align-items: center;
   }
   
   .postTitle img{
        width: 100px;
        margin-right: 15px;
    }

   .postDetails{
        margin: 20px 0px;
   }
   .postDetails a{
        background-color: var(--nav-main);
        color: white;
        padding: 5px;
        border-radius: 25px;
        transition: 0.5s ease-in-out;
    }
   .postDetails a:hover{
        scale: 1.15;
    }

   .Post{
    position: relative;
   }
   .addBookmark, .removeBookmark{
    position: absolute;
    top: 1px;
    right: 5%;
    display: block;
    background-color: transparent;
    color: var(--nav-main);
    padding: 5px;
   }
   .hide{
    display:none;
   }
</style>



    </div>
    <title>Jobs</title>
    <script>
        document.getElementById("Job-LeftBar").classList.add("actived");
    </script>

</body>

</html>