<?php 
  include "structural_IndividualPage.php";

?>
<head>
    <!-- Search Select javascript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/selectize.min.js"></script>
    <link rel="stylesheet" href="../js/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

</head>



<h2 style="margin: 1rem 2rem;">
    Search 
    <i class="fa-solid fa-magnifying-glass fa-lg" style="color: var(--nav-main);margin-left: 10px;" ></i>
</h2>

<style>
    
.SelectRow {
    width: 25rem;
}
.row{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap
}
</style>

<div class="filter-container">

    <form action="#" method="GET" style="margin: 4% 2rem;     text-align: -webkit-center;">
    <!-- <form action="#" method="GET" style="display: flex;     flex-direction: row;     justify-content: space-around;    flex-wrap: wrap;     margin: 4% 0;"> -->

<?php

?>

    <div class="row">
        <input type="text" name="internship_Title" id="" placeholder="Internship Position" value="<?= isset($_GET['internship_Title']) ? $_GET['internship_Title'] : '' ?>" style="width: 25rem;      height: 2rem;   margin: 1.6rem 0 10px ;    border-radius: 5px;     border: solid 0.5px gray; ">          <!-- set job position selected before -->
    
        <div class="SelectRow">
            <label for="yearOfExperiance">Experiance Year:</label>
    
            <input type="number" name="yearOfExperiance" id="" placeholder="Experiance Year"  value="<?= isset($_GET['yearOfExperiance']) ? $_GET['yearOfExperiance'] : '' ?>" style="width: 25rem;      height: 2rem;   margin: 10px 0;    border-radius: 5px;     border: solid 0.5px gray; ">          <!-- set job position selected before -->
            <!-- maxlength="2" -->
        </div>
    </div>


    <div class="row">

        <div class="SelectRow">
            <label for="work">Internship Type:</label>
    
            <select id="select-state" name="work">
                <option value="">All</option>
                <option value="Full-time" <?php echo (isset($_GET['work']) && $_GET['work'] == 'Full-time') ? 'selected' : ''; ?>>Full-time</option>
                <option value="Part-time" <?php echo (isset($_GET['work']) && $_GET['work'] == 'Part-time') ? 'selected' : ''; ?>>Part-time</option>
            </select>
    
        </div>
    
    
        <div class="SelectRow">
            <label for="commitment">Internship WorkPlace:</label>
    
            <select id="select-state" name="commitment">
                <option value="">All</option>
                <option value="On-site" <?php echo (isset($_GET['commitment']) && $_GET['commitment'] == 'On-site') ? 'selected' : ''; ?>>On-site</option>
                <option value="Remote" <?php echo (isset($_GET['commitment']) && $_GET['commitment'] == 'Remote') ? 'selected' : ''; ?>>Remote</option>
                <option value="Hybrid" <?php echo (isset($_GET['commitment']) && $_GET['commitment'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
            </select>
    
        </div>
    </div>

    <div class="row">

        <!-- <div class="SelectRow">
            <label for="category">Category:</label>
            <select id="select-state" name="category[]" multiple>
                <option value="">All Category</option>
                <?php
                // $select_categories = mysqli_query($conn, "SELECT category_name FROM `categories`");
                
                // while ($select_category = mysqli_fetch_assoc($select_categories)) {
                //     $selected = (in_array($select_category['category_name'], $_GET['category'])) ? 'selected' : '';
                //     echo "<option value='" . $select_category['category_name'] . "' $selected >" . $select_category['category_name'] . "</option>";
                // }
                ?>
            </select>
        </div> -->
    
    
    
    
        <div class="SelectRow">
            <label for="country">Country:</label>
            <select id="select-state" name="internship_Country[]" multiple>
                <option value="">All</option>
                <?php
                $select_countries = mysqli_query($conn, "SELECT country_name FROM `country`");
                
                while ($select_country = mysqli_fetch_assoc($select_countries)) {
                    $selected = (in_array($select_country['country_name'], $_GET['internship_Country'])) ? 'selected' : '';
                    echo "<option value='" . $select_country['country_name'] . "' $selected >" . $select_country['country_name'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>




        <a href="filter.php" style="     width: 10rem;     margin-left: 1.2rem;     height: 2rem;">
            <button style="     height: 2rem;     width: 200px;     margin: 10px 0;">
                Filter
            </button>
        </a>         


   
      </div>




      </form>

      <?php
// Job Postion is set?

if(isset($_GET['internship_Title'])){
    echo'
    <h2 style="margin: -20px 2rem;">
        Search Result 
        <i class="fa-solid fa-briefcase fa-lg" style="color: var(--nav-main);margin-left: 10px;" ></i>
    </h2>
    ';

}
?>

<div id="jobList">
  <!-- Job listings will be dynamically added here -->

<?php
    // addmin DELELT 
    if(isset($_GET['work'])){
        
        $internship_Title = $_GET['internship_Title'];
        $yearOfExperiance = $_GET['yearOfExperiance'];
        $work = $_GET['work'];
        $commitment = isset($_GET['commitment']) ? $_GET['commitment'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : array();
        $internship_Country = isset($_GET['internship_Country']) ? $_GET['internship_Country'] : array();
        
        $sql = "SELECT DISTINCT internship.*, company.company_id ,company_Name,company_Logo,
                                        universities.university_ID ,university_Name,university_Logo
                FROM internship 
                    LEFT JOIN company ON publisher_Id = company_id
                    LEFT JOIN universities ON universities.university_ID = internship.publisher_Id
                    WHERE ";
                    // LEFT JOIN interenship_fields ON internship.job_ID = job_fields.job_ID
        $conditions = array();
        
        if (!empty($internship_Title)) {
            $conditions[] = "internship_Title LIKE '%$internship_Title%'";
        }

        if (!empty($yearOfExperiance)) {
            $conditions[] = "yearOfExperiance <= '$yearOfExperiance'";
        }
        
        if (!empty($work)) {
            $conditions[] = "work = '$work'";
        }

        if (!empty($commitment)) {
            $conditions[] = "internship.commitment = '$commitment'";
        }
        
        if (!empty($internship_Country)) {
            if (!is_array($internship_Country)) {
                $internship_Country = array($internship_Country); // Convert to array if it's not already
            }
            $conditions[] = "internship_Country IN ('" . implode("', '", $internship_Country) . "')";
        }
        
        

        // if (!empty($category)) {
        //     if (!is_array($category)) {
        //         $category = array($category); // Convert to array if it's not already
        //     }
        //     $conditions[] = "job_fields.job_field_Name IN ('" . implode("', '", $category) . "')";
        // }
        
        
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
                <section class="scholarships">
            ';
    
            while ($row = $result->fetch_assoc()) {
                echo "


                <div class=\"stack\" id=\"stack\">
                <a href=\"internshipDetails.php?internshipId=".$row['internship_ID']."\" target='_black'>
                    <div class=\"stack-details\" id=\"stack-details\">
                        <h3>
                            ". $row['internship_Title']." 
                        </h3>
                        <div class=\"work-location\">
                            <span>
                                <i class=\"fa fa-thin fa-briefcase\"></i>
                                ". $row['work']." 
                            </span>
                            <span>
                                <i class=\"fas fa-location-arrow\"></i>
                                ". $row['location']."  
                            </span>
                            <span>
                                <i class=\"fa fa-thin fa-stopwatch\"></i>
                                ". $row['commitment']." 
                            </span>
                            <span>
                              <i class=\"fa fa-solid fa-hourglass\"></i>
                              ".$row['period']."
                        </span>
                        </div>
                        <span class=\"see-details\">See Details</span>
                    </div>
                </a>

                
                ";

                //bookmark
                $internship_ID= $row['internship_ID'];
                $bookmarkSql = "SELECT * FROM bookmarks WHERE user_ID = $individual_ID AND user_role = 'individual' AND internship_ID = " . $internship_ID ;

                // $bookmarkSql="SELECT * FROM bookmarks WHERE user_ID=$individual_ID AND user_role='individual' AND job_ID=$fetch_course['company_id'] ";
                $bookmarkResult = mysqli_query($conn, $bookmarkSql);
                $bookmarkCount=mysqli_num_rows($bookmarkResult);


                    if(!$bookmarkCount>0){ //is not saved before 
                        echo'
                            <a  class="addBookmark" href="../addRemoveBookmark.php?internship_ID='. $internship_ID .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                <i class="fa-regular fa-bookmark fa-2xl" ></i>
                            </a>
                            <a class="removeBookmark hide" href="../addRemoveBookmark.php?internship_ID='. $internship_ID .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                <i class="fas fa-bookmark fa-2xl" ></i>
                            </a>
                        ';
                    }
                    else{ // is saved before 
                        echo'
                            <a  class="addBookmark hide" href="../addRemoveBookmark.php?internship_ID='. $internship_ID .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                <i class="fa-regular fa-bookmark fa-2xl" ></i>
                            </a>
                            <a class="removeBookmark" href="../addRemoveBookmark.php?internship_ID='. $internship_ID .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                <i class="fas fa-bookmark fa-2xl" ></i>
                            </a>
                        ';
                    }

                // close stack div
                echo"
                </div> 
                ";
                                


            }// end while loop
            echo"</section>";
        } 
        else {
            echo '<p class="empty" style="margin: 5% 25%; width: 50%;">No results found for the selected Internship filter.</p>';
        } 
        
    }
    else{
        echo '<p class="empty" style="margin: 5% 25%; width: 50%;">You must select a filter category to perform the Internship search.</p>';

    }
    ?>
</div>

<style>
   /* .scholarships{
        width: 80%;
        margin:3% 10%;
   }  */
   /* .Post{
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
    } */
    .stack{
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




    
/*  */
.scholarships{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 20px;
    margin-top: 30px;
}
.stack {
    width: 240px;
    padding: 25px 25px 10px 25px;
    border-radius: 5px;
    background-color: #eee;
    transition: 0.5s;
}
.stack-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
    color: black;
}
.stack-details h3 {
    /* margin-bottom: 30px; */
    line-height: 30px;
    height: 100px;
    height: 80px;
}
.see-details {
    align-self: end;
    margin-bottom: 8px;
}
.work-location {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.work-location span {
    display: flex;
    align-items: center;
    gap: 10px;
}
.stack-details .fees,
.stack-details .date {
    width: -moz-fit-content;
    width: fit-content;
    padding: 6px 14px;
    transition: 0.5s;
    border-radius: 20px;
    outline: 1px solid #4444;
    margin-bottom: 8px;
}

 .stack:hover{
  transform: translate3d(-5px, -12px, 0px);
  box-shadow: 1px 1px 0 1px #f9f9fb, 0px -35px 19px 0px rgba(34, 33, 81, 0.01), 31px 34px 43px -10px rgba(34, 33, 81, 0.15);

}
.stack:hover .see-details {
    text-decoration: underline;
}
/*  */


        /* .container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
} */

h1 {
  color: #333;
}

.scholarships-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

/* .scholarship-card {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
} */

h2 {
  color: #333;
}

p {
  color: #666;
}

/* a {
  display: inline-block;
  margin-top: 10px;
  background-color: #3366cc;
  color: #fff;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
} */

/* a:hover {
  background-color: #204b99;
} */







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
    <title>Search Internships</title>
    <script>
        document.getElementById("InternshipManagement-LeftBar").classList.add("actived");

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