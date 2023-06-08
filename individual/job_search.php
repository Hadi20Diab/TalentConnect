<?php 
  include "structural_IndividualPage.php";

?>
<head>
    <!-- Search Select javascript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/selectize.min.js"></script>
    <link rel="stylesheet" href="../js/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

</head>



<div class="filter-container">

    <form action="#" method="GET" style="margin: 4% 0;">
    <!-- <form action="#" method="GET" style="display: flex;     flex-direction: row;     justify-content: space-around;    flex-wrap: wrap;     margin: 4% 0;"> -->

<?php

?>


<input type="text" name="jobPosition" id="" placeholder="Job Position" value="<?= isset($_GET['jobPosition']) ? $_GET['jobPosition'] : '' ?>">          <!-- set job position selected before -->
    <div class="SelectRow">
        <label for="jobType">Job Type:</label>

        <select id="select-state" name="jobType">
            <option value="">All</option>
            <option value="Full-time" <?php echo (isset($_GET['jobType']) && $_GET['jobType'] == 'Full-time') ? 'selected' : ''; ?>>Full-time</option>
            <option value="Part-time" <?php echo (isset($_GET['jobType']) && $_GET['jobType'] == 'Part-time') ? 'selected' : ''; ?>>Part-time</option>
        </select>

    </div>


    <div class="SelectRow">
        <label for="jobWorkPlace">Job WorkPlace:</label>

        <select id="select-state" name="jobWorkPlace">
            <option value="">All</option>
            <option value="On-site" <?php echo (isset($_GET['jobWorkPlace']) && $_GET['jobWorkPlace'] == 'On-site') ? 'selected' : ''; ?>>On-site</option>
            <option value="Remote" <?php echo (isset($_GET['jobWorkPlace']) && $_GET['jobWorkPlace'] == 'Remote') ? 'selected' : ''; ?>>Remote</option>
            <option value="Hybrid" <?php echo (isset($_GET['jobWorkPlace']) && $_GET['jobWorkPlace'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
        </select>

    </div>

    <div class="SelectRow">
        <label for="category">Category:</label>
        <select id="select-state" name="category[]" multiple>
            <option value="">All Category</option>
            <?php
            $select_categories = mysqli_query($conn, "SELECT category_name FROM `categories`");
            
            while ($select_category = mysqli_fetch_assoc($select_categories)) {
                $selected = (in_array($select_category['category_name'], $_GET['category'])) ? 'selected' : '';
                echo "<option value='" . $select_category['category_name'] . "' $selected >" . $select_category['category_name'] . "</option>";
            }
            ?>
        </select>
    </div>




    <div class="SelectRow">
        <label for="country">Country:</label>
        <select id="select-state" name="job_Country[]" multiple>
            <option value="">All</option>
            <?php
            $select_countries = mysqli_query($conn, "SELECT country_name FROM `country`");
            
            while ($select_country = mysqli_fetch_assoc($select_countries)) {
                $selected = (in_array($select_country['country_name'], $_GET['job_Country'])) ? 'selected' : '';
                echo "<option value='" . $select_country['country_name'] . "' $selected >" . $select_country['country_name'] . "</option>";
            }
            ?>
        </select>
    </div>




        <a href="filter.php">
            <button>Filter</button>
        </a>         


   
      </div>

      </form>


<div id="jobList">
  <!-- Job listings will be dynamically added here -->
    <h4 id="loding"></h4>

<?php
    // addmin DELELT 
    if(isset($_GET['jobType'])){
        
        $jobPosition = $_GET['jobPosition'];
        $jobType = $_GET['jobType'];
        $jobWorkPlace = isset($_GET['jobWorkPlace']) ? $_GET['jobWorkPlace'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : array();
        $job_Country = isset($_GET['job_Country']) ? $_GET['job_Country'] : array();
        
        $sql = "SELECT DISTINCT jobs.*, company.*, universities.*
                FROM jobs 
                    LEFT JOIN company ON deliveredBy = company_Name
                    LEFT JOIN universities ON universities.university_Name = jobs.deliveredBy
                    LEFT JOIN job_fields ON jobs.job_ID = job_fields.job_ID
                    WHERE ";
        $conditions = array();
        
        if (!empty($jobPosition)) {
            $conditions[] = "position LIKE '%$jobPosition%'";
        }
        
        if (!empty($jobType)) {
            $conditions[] = "jobType = '$jobType'";
        }

        if (!empty($jobWorkPlace)) {
            $conditions[] = "jobs.job_WorkPlace = '$jobWorkPlace'";
        }
        
        if (!empty($job_Country)) {
            if (!is_array($job_Country)) {
                $job_Country = array($job_Country); // Convert to array if it's not already
            }
            $conditions[] = "job_Country IN ('" . implode("', '", $job_Country) . "')";
        }
        
        

        if (!empty($category)) {
            if (!is_array($category)) {
                $category = array($category); // Convert to array if it's not already
            }
            $conditions[] = "job_fields.job_field_Name IN ('" . implode("', '", $category) . "')";
        }
        
        
        if (!empty($conditions)) {
            $sql .= implode(" AND ", $conditions);
        } else {
            $sql .= "1"; // Return all records if no conditions are specified
        }
        
        $result = mysqli_query($conn, $sql);
        

        // Check for errors
        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        }
        
        $jobs_count = mysqli_num_rows($result);
    

   

        if ($jobs_count >0) {
    
            echo'
                <section class="PostContainer">
            ';
    
            while ($fetch_job = mysqli_fetch_assoc($result)) {
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
        
    }
    ?>
</div>

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
<link rel="stylesheet" href="../css/all_icon.css">

<script>
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
          });
       });
</script>







    </div>
    <title>Search Jobs</title>
    <script>
        document.getElementById("Job-LeftBar").classList.add("actived");

        //  script for Bookmarks add-remove 

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

</body>

</html>