<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";

?>



<div class="cardBox">

  <a href="course_search.php">

      <div class="card">
              <div>
                  <div class="cardName">Search</div>
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






<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">All Courses</h1>

   <div class="box-container">

    <?php


        // $select_courses = mysqli_query($conn, "SELECT * FROM `courses` WHERE course_Status = 'active' ORDER BY course_Launch_Date DESC");
        
        
        // select Courses according to the user interest
        $sql = "SELECT DISTINCT c.* FROM courses c
        INNER JOIN individuals i
        LEFT JOIN courses_fields cf ON c.course_ID = cf.course_ID
        LEFT JOIN individual_intrested_field ii ON i.individual_ID = ii.individual_ID 
        WHERE c.course_Status = 'active' AND cf.course_field_Name = ii.field_Name AND i.individual_ID = " . $individual_ID . " 
        ORDER BY c.course_Launch_Date DESC"; // order by post date to dispaly the new post first

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



            // } 
        // }
            ?>



                <div class="box">
                    <div class="course_Creator">

                        <?php if ($fetch_company && $fetch_company['company_Logo']) :
                            $LogoName=$fetch_company['company_Logo'];
                            ?>
                                <img src="../images/companies_universities_images/<?= $fetch_company['company_Logo']; ?>" alt="">
                        <?php else : ?>
                                <img src="../images/companies_universities_images/default_logo.jpg" alt="">
                        <?php endif; ?>


                        <div>
                            <h3><?= $fetch_course['course_Creator'] ?></h3>
                            <span><?= $fetch_course['course_Launch_Date']; ?></span>
                        </div>
                    </div>
                    <img src="../images/courses/<?= $fetch_course['course_Picture']; ?>" class="coursePhoto" alt="">
                    <h3 class="title"><?= $fetch_course['course_Name']; ?></h3>
                    <a href="viewCourse.php?course_id=<?= $course_id; ?> " class="viewCourseBtn">view Course</a>
                </div>
                <?php
            }  
      }else{
         echo '<p class="empty">no courses added yet!</p>';
      }
      ?>

   </div>

</section>

<!-- courses section ends -->
























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
</style>








    </div>
    <title>Courses</title>
    <script>
        document.getElementById("Courses-LeftBar").classList.add("actived");
    </script>

</body>

</html>