<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";

?>



<div class="cardBox">

  <a href="course_search.php">

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

  <a href="savedCourses.php">
      <div class="card">

          <div>
              <div class="cardName">Saved </div>
          </div>

          <div class="iconBx">
            <i class="fa fa-bookmark"></i>
            <!-- <ion-icon name="storefront-outline"></ion-icon> -->
          </div>
      </div>

  </a>

  <a href="enrolledCourses.php">
      <div class="card">

          <div>
              <div class="cardName">Registered </div>
          </div>

          <div class="iconBx">
              <i class="fa-solid fa-registered"></i>
          </div>
      </div>

  </a>

  <a href="finishedCourses.php">
      <div class="card">

          <div>
              <div class="cardName">Finished </div>
          </div>
          
          <div class="iconBx">
            <i class="fa-solid fa-flag-checkered"></i>
          </div>
      </div>

  </a>


</div>






<!-- courses section starts  -->

<section class="courses">

   <div style="     display: flex;     align-items: center;     margin: 0 1rem; ">
                <!-- <i class="fa fa-book fa-xl" style="     color: var(--nav-main);  margin-right: 10px;"></i> -->
                <i class="fa fa-book-copy fa-xl" style="     color: var(--nav-main);  margin-right: 10px;"></i>
                <h2>Discover Courses Suited to Your Interests</h2>
    </div>


    <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
        <i class="fa fa-solid fa-magnifying-glass"></i>
        <input type="text" name="" id="search-item" placeholder="Search By Course Name" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
    </div>









   <div id="coursesList" class="box-container">

    <?php


        // select Courses according to the user interest and excluded under-progress and done courses

        $sql = "SELECT DISTINCT c.*FROM courses c
        INNER JOIN individuals i
        LEFT JOIN courses_fields cf ON c.course_ID = cf.course_ID
        LEFT JOIN individual_intrested_field ii ON i.individual_ID = ii.individual_ID 
        LEFT JOIN course_progress cp ON c.course_ID = cp.course_ID AND i.individual_ID = cp.individual_ID
        WHERE c.course_Status = 'active'
            AND cf.course_field_Name = ii.field_Name
            AND i.individual_ID = $individual_ID
            AND (cp.course_Status IS NULL OR cp.course_Status NOT IN ('under-progress', 'done'))
        ORDER BY c.course_Launch_Date DESC
        LIMIT 6";// order by post date to dispaly the 6 post first

        $select_courses = mysqli_query($conn, $sql);

      

        if(mysqli_num_rows($select_courses) > 0){ 

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
                            <i class="fa-solid fa-money-bill" style="color: var(--nav-main);"></i>
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
        }else{
            echo '<p class="empty">No courses matched your interests yet.<br>
                                
                </p>';
      }
      ?>

   </div>

    <div id="loadMoreButton" style="    text-align: center;">
        <button class="loadMoreButton a-btn">
            <i class="fa-solid fa-download" style="margin-right: 5px;"></i>
            Load More
        </button>
    </div>
</section>

<!-- courses section ends -->


<!-- script for load more button -->

<script>
$(document).ready(function() {
    var offset = 6;
    var limit = 6;

    // Function to load more courses
    function loadMoreCourses() {
        $.ajax({
            url: "load_more.php",
            type: "POST",
            data: {
                offset: offset,
                limit: limit,
                individual_ID: <?= $individual_ID ?>,
                contentType: 'courses',
            },
            success: function(response) {
                // Append the newly loaded courses to the courses list
                $("#coursesList").append(response);

                // Check if the response contains any new courses
                if ($.trim(response) === "") {
                    // Hide the "Load More" button if there are no more courses to load
                    $("#loadMoreButton").remove();
                } else {
                    // Increment the offset by the limit for the next load more request
                    offset += limit;
                }
            },
            error: function() {
                // Handle the error case
                alert("Error occurred while loading more courses.");
            }
        });
    }

    // Load more courses when the "Load More" button is clicked
    $("#loadMoreButton").on("click", function() {
        loadMoreCourses();
    });

    // Initial load more on page load
    // loadMoreCourses();
});
</script>



















<style>
.a-btn{
   background-color: var(--nav-main);
   padding: 1rem;
   border-radius: 25px;
   color: var(--white);
   width: 20%;
   font-size:1rem;
}
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
    
    .addBookmark, .removeBookmark{
        position: absolute;
        top: 5px;
        right: 5%;
        background-color: transparent;
        color: var(--nav-main);
    }
    .hide{
        display: none;
    }

</style>








    </div>





    <title>Courses</title>
    <script>
        document.getElementById("Courses-LeftBar").classList.add("actived");
    </script>


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
</body>

</html>