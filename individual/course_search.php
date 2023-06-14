<?php 
  include "structural_IndividualPage.php";

?>
<head>
    <!-- Search Select javascript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/selectize.min.js"></script>
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../js/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>



<div class="filter-container">

    <form action="#" method="GET" style="margin: 4% 0;">
    <!-- <form action="#" method="GET" style="display: flex;     flex-direction: row;     justify-content: space-around;    flex-wrap: wrap;     margin: 4% 0;"> -->


        <div class="SelectRow">
            <input type="text" name="courseName" id="" placeholder="Course Name" value="<?= isset($_GET['courseName']) ? $_GET['courseName'] : '' ?>">
            
  
        </div>




        <div class="SelectRow">
            <label for="category">Category:</label>
            <select id="select-state" name="category[]" multiple>
                <option value="">All Category</option>
                <?php
                $select_categories = mysqli_query($conn, "SELECT category_name FROM `categories`");

                $selectedCategories = isset($_GET['category']) ? $_GET['category'] : array(); // Get the selected categories form the previous filter 

                while ($select_category = mysqli_fetch_assoc($select_categories)) {
                    $categoryName = $select_category["category_name"];
                    $selected = in_array($categoryName, $selectedCategories) ? 'selected' : ''; // Check if the category is selected
                    echo '<option value="'.$categoryName.'" '.$selected.'>'.$categoryName.'</option>';
                }
                ?>
            </select>
        </div>



        <div class="SelectRow">
            <label for="course_Creator">CreatedBy:</label>
            <select id="select-state" name="course_Creator[]" multiple>
                <option value="">All</option>
                <?php
                $select_course_Creator = mysqli_query($conn, "SELECT course_Creator FROM `courses`");

                while ($select_Creator = mysqli_fetch_assoc($select_course_Creator)) {
                    $courseCreator = $select_Creator["course_Creator"];
                    $selected = in_array($courseCreator, $_GET['course_Creator']) ? 'selected' : '';
                    
                    echo '<option value="' . $courseCreator . '" ' . $selected . ' > ' . $courseCreator . ' </option>';
                }
                ?>
            </select>
        </div>



        <div class="SelectRow">
            <label for="fees">Course Fees:</label>
            <select id="select-state" name="course_fee">
                <option value="">Select Fee</option>
                <option value="0" <?php echo ($_GET['course_fee'] == '0') ? 'selected' : ''; ?>>Free</option>
                <option value="100" <?php echo ($_GET['course_fee'] == '100') ? 'selected' : ''; ?>>$100 or less</option>
                <option value="500" <?php echo ($_GET['course_fee'] == '500') ? 'selected' : ''; ?>>$500 or less</option>
                <option value="1000" <?php echo ($_GET['course_fee'] == '1000') ? 'selected' : ''; ?>>$1000 or less</option>
                <option value="5000" <?php echo ($_GET['course_fee'] == '5000') ? 'selected' : ''; ?>>$5000 or less</option>
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
        
        
        $sql = "SELECT DISTINCT  c.* FROM courses c 
        INNER JOIN courses_fields cf ON c.course_ID = cf.course_ID 

        LEFT JOIN company ON company_Name=course_Creator
        LEFT JOIN universities ON university_Name=course_Creator

        WHERE c.course_Status = 'active'

        ";


        // Check if course name is provided
        if(isset($_GET['courseName']) && !empty($_GET['courseName'])){
            $courseName = $_GET['courseName'];
            // Add course name condition to the query
            $sql .= " AND c.course_Name LIKE '%$courseName%'";
        }

        // Check if categories are selected
        if(isset($_GET['category']) && is_array($_GET['category']) && !empty($_GET['category'])){
            $categories = $_GET['category'];
            // Convert the array of categories to a comma-separated string
            $categoryList = implode("','", $categories);
            // Add category condition to the query
            $sql .= " AND cf.course_field_Name IN ('$categoryList')";
        }

        // Check if creators are selected
        if(isset($_GET['course_Creator']) && is_array($_GET['course_Creator']) && !empty($_GET['course_Creator'])){
            $creators = $_GET['course_Creator'];
            // Convert the array of creators to a comma-separated string
            $creatorList = implode("','", $creators);
            // Add creator condition to the query
            $sql .= " AND c.course_Creator IN ('$creatorList')";
        }

        // Check if course fees are provided
        if(isset(($_GET['course_fee'])) && !empty($_GET['course_fee']) || ($_GET['course_fee'] ==0 && $_GET['course_fee'] !="" )){
            $course_fee = $_GET['course_fee'];
            // Add course fees condition to the query
            $sql .= " AND c.course_Fees <= $course_fee";
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
                            <a href="../viewCompanyProfile.php?company_id=<?= $fetch_company['company_id']; ?>" class="row" style="text-decoration: none;" target="_blank">
                            <img src="../images/companies_universities_images/<?= $fetch_company['company_Logo']; ?>" alt="">
                            
                    <?php }else {
                        ?>
                            <a href="../viewUniversityProfile.php?university_id=<?= $fetch_university['university_ID']; ?>" class="row" style="text-decoration: none;" target="_blank">

                            <img src="../images/companies_universities_images/<?= $fetch_university['university_Logo']; ?>" alt="">
                    <?php
                        } 
                    ?>
                            </a>
                    <div>
                        <h4><?= $fetch_course['course_Creator'] ?></h4>
                        <span><?= $fetch_course['course_Launch_Date']; ?></span>
                    </div>
                </div>
                <img src="../images/courses/<?= $fetch_course['course_Picture']; ?>" class="coursePhoto" alt="">
                <h3 class="title"><?= $fetch_course['course_Name']; ?></h3>
                <div style="     display: flex;     align-items: center;     justify-content: space-between;     flex-direction: row; margin-top: 1rem; ">
                    <a href="viewCourse.php?course_id=<?= $course_id; ?> " class="viewCourseBtn">view Course</a>
                    <h4 style="font-size: larger;">
                        <?= $fetch_course['course_Fees']; ?>$</h4>
                </div>
            

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
    echo '<p class="empty" style="margin: -25% -50%;">You must select a filter category to perform the course search.</p>';
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
        /* margin-top: 1rem; */
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