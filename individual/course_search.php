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
            <input type="text" name="courseName" id="" placeholder="Course Name">
  
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

            <label for="course_Creator">CreatedBy:</label>
            <select id="select-state" name="course_Creator">
              <option value="">All</option>
              <?php
                      $select_course_Creator = mysqli_query($conn, "SELECT course_Creator FROM `courses`");
                          
                      while ($select_Creator = mysqli_fetch_assoc($select_course_Creator)) {
                          echo"
                              <option value=" . $select_Creator['course_Creator'] . " > " .$select_Creator['course_Creator']. " </option>
                          ";
                      }
                      echo'
                      </select>';
              ?>
          
          
        </div>


        <div class="SelectRow">
            <label for="fees">Course Fees:</label>
            <select id="select-state" name="course_fee">
                <option value="">Select Fee</option>
                <option value="0">Free</op]tion>
                <option value="100">$100 or less</option>
                <option value="500">$500 or less</option>
                <option value="1000">$1000 or less</option>
                <option value="5000">$5000 or less</option>
            </select>

        </div>

        <a href="filter.php">
            <button>Filter</button>
        </a>         


   
        
    </form>
</div>



<section class="courses">
    <div class="box-container">



<!-- <div id="jobList"> -->
  <!-- Job listings will be dynamically added here -->

<?php
    // course Name is set?
    if(isset($_GET['courseName'])){
        
        
        $courseName = $_GET['courseName'];
        $category = $_GET['category'];
        $course_Creator = $_GET['course_Creator'];
        $course_fee = $_GET['course_fee'];

        $sql="SELECT * FROM courses
        
        LEFT JOIN company ON company_Name=course_Creator
        LEFT JOIN universities ON university_Name=course_Creator
         WHERE "; // we join 2 table together 
        $conditions = array();


        // if (!empty($search)) {
        //     $conditions[] = "company_name LIKE '%$search%'";
        // }

        if(!empty($courseName)){
            $conditions[] = "course_Name LIKE '%$courseName%' ";
            
        }
        if(!empty($category)){
            $conditions[] = "course_Category = '$category' ";
        }
        if(!empty($course_Creator)){
            $conditions[] = "course_Creator = '$course_Creator' ";
        }
        if(!empty($course_fee)){
            $conditions[] = "course_Fees = '$course_fee' ";
        }





        if (!empty($conditions)) {
            $sql .= implode(" AND ", $conditions);
        } else {
            $sql .= "1"; // Return all records if no conditions are specified
        }

        // Execute the query
        $select_courses = mysqli_query($conn, $sql);

        // Check for errors
        if (!$select_courses) {
            echo "Error: " . mysqli_error($conn);
        }


        while($fetch_course = mysqli_fetch_assoc($select_courses)){
            $course_id = $fetch_course['course_ID'];
            $course_Creator = $fetch_course['course_Creator'];

            $select_company = mysqli_query($conn,"SELECT * FROM company WHERE company_Name = '$course_Creator'");
            // $fetch_company = mysqli_fetch_assoc($select_company);
            
            if ($select_company) {
                $fetch_company = mysqli_fetch_assoc($select_company);
                // Rest of your code here
            } else {
                echo "Error: " . mysqli_error($conn);
            }


            $select_university = mysqli_query($conn,"SELECT * FROM universities WHERE university_Name = '$course_Creator'");
            // $fetch_company = mysqli_fetch_assoc($select_company);
            
            if ($select_university) {
                $fetch_university = mysqli_fetch_assoc($select_university);
            } else {
                echo "Error: " . mysqli_error($conn);
            }



        // } 
    // }
        ?>


            <div class="box">
                <div class="course_Creator">

                    <?php if ($fetch_company && $fetch_company['company_Logo']) {
                            $LogoName=$fetch_company['company_Logo'];
                        ?>
                            <a href="../viewCompanyProfile.php?vcid=<?= $fetch_company['company_id']; ?>&cname=<?= $fetch_company['company_Name']; ?>" class="row" style="text-decoration: none;" target="_blank">
                            <img src="../images/companies_universities_images/<?= $fetch_company['company_Logo']; ?>" alt="">
                            
                    <?php }else {
                        ?>
                            <a href="../viewUniversityProfile.php?vcid=<?= $fetch_university['university_ID']; ?>&cname=<?= $fetch_university['university_Name'] ?>" class="row" style="text-decoration: none;" target="_blank">

                            <img src="../images/companies_universities_images/<?= $fetch_university['university_Logo']; ?>" alt="">
                    <?php
                        } 
                    ?>
                            </a>
                    <div>
                        <h3><?= $fetch_course['course_Creator'] ?></h3>
                        <span><?= $fetch_course['course_Launch_Date']; ?></span>
                    </div>
                </div>
                <img src="../images/courses/<?= $fetch_course['course_Picture']; ?>" class="coursePhoto" alt="">
                <h3 class="title"><?= $fetch_course['course_Name']; ?></h3>
                <a href="viewCourse.php?course_id=<?= $course_id; ?> " class="viewCourseBtn">view Course</a>
            

                <?php


                $bookmarkSql = "SELECT * FROM bookmarks WHERE user_ID = $individual_ID AND user_role = 'individual' AND course_ID = " . $course_id ;

                // $bookmarkSql="SELECT * FROM bookmarks WHERE user_ID=$individual_ID AND user_role='individual' AND job_ID=$fetch_course['company_id'] ";
                $bookmarkResult = mysqli_query($conn, $bookmarkSql);
                $bookmarkCount=mysqli_num_rows($bookmarkResult);


                if(!$bookmarkCount>0){ //is not saved before 
                    echo'
                        <a  class="addBookmark" href="../addRemoveBookmark.php?course_id='. $course_id .'&user_ID='. $individual_ID .'&user_role=individual&status=add" target="_black">

                            <i class="fa-regular fa-bookmark fa-2xl" ></i>
                        </a>
                        <a class="removeBookmark hide" href="../addRemoveBookmark.php?course_id='. $course_id .'&user_ID='. $individual_ID .'&user_role=individual&status=remove" target="_black">
    
                            <i class="fas fa-bookmark fa-2xl" ></i>
                        </a>
                    ';
                }
                else{ // is saved before 
                    echo'
                        <a  class="addBookmark hide" href="../addRemoveBookmark.php?course_id='. $course_id .'&user_ID='. $individual_ID .'&user_role=individual&status=add" target="_black">

                            <i class="fa-regular fa-bookmark fa-2xl" ></i>
                        </a>
                        <a class="removeBookmark" href="../addRemoveBookmark.php?course_id='. $course_id .'&user_ID='. $individual_ID .'&user_role=individual&status=remove" target="_black">

                            <i class="fas fa-bookmark fa-2xl" ></i>
                        </a>
                    ';
                }
                //close Box DIV
                echo'</div>';
                
            }  
            ?>


<!-- close Box contaner     DIV-->
    </div>
</section>

<?php
}else{
    echo '<p class="empty">no courses added yet!</p>';
}
?>
<style>

    .courses{
        padding: 25px;
    }
    .box-container{
        /* display: flex;
        flex-wrap: wrap;
        justify-content: space-between; */

        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, 21.5rem);
        gap: 1.5rem;
        justify-content: center;
        align-items: stretch;
    }
    .box{
        border-radius: 0.5rem;
        background-color: #eee;
        padding: 2rem;
    }
    .box .course_Creator{
        margin-bottom: 0.5rem;
        display: flex;
        align-items: stretch;
        gap: 2rem;
    }
    .box .course_Creator img{

        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.5rem;
    }
    .coursePhoto{
        width: 100%;
        border-radius: 0.5rem;
        height: 10rem;
        object-fit: cover;
        margin-bottom: 1rem;
    }
    .viewCourseBtn{
        background-color: var(--nav-main);
        color: white;
        display: inline-block;
        border-radius: 0.5rem;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        margin-top: 1rem;
        text-transform: capitalize;
        cursor: pointer;
        text-align: center;
    }
    .box{
        position: relative;
    }
    .hide{
        display: none;
    }
    .addBookmark, .removeBookmark{
        position: absolute;
        top: 5px;
        right: 5%;
        background-color: transparent;
        color: var(--nav-main);
    }


</style>
<link rel="stylesheet" href="../css/all_icon.css">
<!-- select search script  -->
<script>
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
          });
       });
</script>







    </div>
    <title>Search courses</title>
    <script>
        document.getElementById("Courses-LeftBar").classList.add("actived");

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