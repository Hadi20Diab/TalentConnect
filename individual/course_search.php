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


        <div class="SelectRow">
            <input type="text" name="jobPosition" id="" placeholder="Job Name">

            <label for="jobType">Job Type:</label>

            <select id="select-state" name="jobType">
              <option value="">All</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
            </select>
            
        </div>

        <div class="SelectRow">

            <label for="category">category:</label>
            <select id="select-state" name="category" >
                <option value="">All Category</option>
          
              <?php
                      $select_categories = mysqli_query($conn, "SELECT category_name FROM `categories`");
                          
                      while ($select_categoy = mysqli_fetch_assoc($select_categories)) {
                          echo"
                              <option value=" . $select_categoy['category_name'] . " > " .$select_categoy['category_name']. " </option>
                          ";
                      }
                      echo'
                      </select>';
              ?>
        </div>


        <div class="SelectRow">

            <label for="country">country:</label>
            <select id="select-state" name="job_Country">
              <option value="">All</option>
              <?php
                      $select_countries = mysqli_query($conn, "SELECT country_name FROM `country`");
                          
                      while ($select_country = mysqli_fetch_assoc($select_countries)) {
                          echo"
                              <option value=" . $select_country['country_name'] . " > " .$select_country['country_name']. " </option>
                          ";
                      }
                      echo'
                      </select>';
              ?>
          
          
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
        $category = $_GET['category'];
        $job_Country = $_GET['job_Country'];

        $sql="SELECT * FROM jobs INNER JOIN company ON deliveredBy = company_Name WHERE "; // we join 2 table together 
        $conditions = array();


        // if (!empty($search)) {
        //     $conditions[] = "company_name LIKE '%$search%'";
        // }

        if(!empty($jobPosition)){
            $conditions[] = "position LIKE '%$jobPosition%' ";
            
        }
        if(!empty($jobType)){
            $conditions[] = "jobType = '$jobType' ";
        }

        if(!empty($job_Country)){
            $conditions[] = "job_Country = '$job_Country' ";
        }

        if(!empty($category)){
            $conditions[] = "industry = '$category' ";
        }



        if (!empty($conditions)) {
            $sql .= implode(" AND ", $conditions);
        } else {
            $sql .= "1"; // Return all records if no conditions are specified
        }

      
        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        }
        

        while ($fetch_jobs = mysqli_fetch_assoc($result)) {

            echo'

                <div class="classjobCard">
                    <div class="row">
                        <a class="companyTitle" href="viewCompanyProfile.php?vcid= '.$fetch_jobs['company_id'].' &cname= '.$fetch_jobs['company_Name'].' " target="_blank">
                            <img src="'. $fetch_jobs['company_Logo'] .'" alt="">
                            <h3>'. $fetch_jobs['company_Name'] .'</h3>
                        </a>
                        <i class="fa-regular fa-bookmark fa-xl"></i>
                    
                    </div>
                    <div class="row">
                        <h4>'. $fetch_jobs['position'] .' - '. $fetch_jobs['jobType'] .' - '. $fetch_jobs['job_Country'] .'</h4>
                        <h4>Dead Line: '. $fetch_jobs['applicationDeadline'] .'</h4>
                    </div>

                </div>

';
}
}
?>

</div>

<style>
   #jobList{
    width:90%;
    margin:5%;
   }
   .classjobCard{
        margin: 5% 1%;
        padding: 2%;
        height: 100px;
        background-color: gray;
        border-radius: 25px;
   }
   
   .row{
        display: flex;
        justify-content: space-between;
        align-items: center;
   }
    /* .SelectRow{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
    } */
   .companyTitle{
        align-items: center;
        display: flex;
        text-decoration: none;
        color: blue;
   }
   .companyTitle img{
        width: 65px;
        border-radius: 50%;
        margin-right: 20px;
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
    </script>

</body>

</html>