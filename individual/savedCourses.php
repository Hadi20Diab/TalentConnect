<?php 
  include "structural_IndividualPage.php";

?>

<section class="courses">
    <h1 class="heading">
        <!-- back button -->
        <a href="courses.php"> 
            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: var(--nav-main);"></i>
        </a>
        Saved Courses
    </h1>

    <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
        <i class="fa fa-solid fa-magnifying-glass"></i>
        <input type="text" name="" id="search-item" placeholder="Search By Course Name" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
    </div>

    <div class="box-container">
        



<?php
    $sql="SELECT * FROM bookmarks 
    LEFT JOIN courses ON bookmarks.course_ID = courses.course_ID
    
    WHERE bookmarks.user_ID = $individual_ID AND bookmarks.user_role='individual' AND bookmarks.course_ID != 0";


    $select_courses = mysqli_query($conn, $sql);
    if (!$select_courses) {
        die(mysqli_error($conn));
    }
    
    if(!mysqli_num_rows($select_courses)>0){
        echo"<p class='empty'>No saved Courses Yet!</p>";
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


            <div class="box" id="box">
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

    .empty{
        position: absolute;
        top: 30%;
        left: 20%;
        width: 30%;
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

    <!-- Script Search Bar -->

    <script type="text/javascript">
        function pendingCompanySearch() {
            let filter = document.getElementById('search-item').value.toUpperCase();
            let singleROW = document.querySelectorAll('#box');
            let l = document.getElementsByTagName('h3'); // courseName
            
            for(var i = 0; i<=l.length ;i++){
                let match=singleROW[i].getElementsByTagName('h3')[0];
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