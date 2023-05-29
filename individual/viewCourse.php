<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";


  if(isset($_GET['course_id'])  )
     $course_id = $_GET['course_id'];
  elseif (isset($_SESSION['course_id']))
      $course_id = $_SESSION['course_id'];
  else{
      $course_id = '';
      header('location:courses.php');
   }


   // Save or unsaved
 if(isset($_GET['remove_bookmarks'])){
   
    $sql = "DELETE FROM bookmarks
            WHERE user_ID = '$individual_ID'
            AND user_role = 'individual'
            AND course_ID = $course_id;
    ";
    
    // Execute the query
    mysqli_query($conn, $sql);

 }
// $course_id = intval($course_id); // Convert $course_id to integer
// $individual_ID = intval($individual_ID); // Convert $individual_ID to integer



if( isset($_GET['save_bookmarks'])  ){

    
   $sql = "INSERT INTO bookmarks (user_ID, user_role, course_ID) 
            VALUES ('$individual_ID', 'individual', $course_id)";

   // Execute the query
   mysqli_query($conn, $sql);
 }

?>












<!-- Course section starts  -->

<section class="playlist">

   <h1 class="heading">Course Details</h1>

   <div class="row">


   <?php
         $select_course =  mysqli_query($conn,"SELECT * FROM `courses`
         INNER JOIN company ON company.company_Name  = courses.course_Creator
         WHERE course_ID = $course_id and course_Status = 'active' LIMIT 1");


         if(mysqli_num_rows($select_course) > 0){
            $fetch_course = mysqli_fetch_assoc($select_course);
            $LogoName = $fetch_course['company_Logo'];
         }


         $count = mysqli_num_rows($select_course);

         if (!$count >0) { // course creator not company so it's univeristy 
         $select_course = mysqli_query($conn,
         "SELECT * FROM courses 
         INNER JOIN universities ON universities.university_Name  = courses.course_Creator

         WHERE course_ID = $course_id and course_Status = 'active' LIMIT 1");


            if(mysqli_num_rows($select_course) > 0){
               $fetch_course = mysqli_fetch_assoc($select_course);
               $LogoName = $fetch_course['university_Logo'];
            }
         
         }








         if(mysqli_num_rows($select_course) > 0){

            $course_id = $fetch_course['course_ID'];
            $_SESSION['course_id'] =$course_id;
            $select_videos = mysqli_query($conn,"SELECT * FROM `course_Videos` WHERE course_ID = $course_id");
            $total_videos = mysqli_num_rows($select_videos);


            $select_bookmark = mysqli_query($conn,"SELECT * FROM `bookmarks` WHERE user_role='individual' AND user_ID = $individual_ID AND course_ID = $course_id");

      ?>


      <div class="col">
         <form action="viewCourse.php" method="get" class="save-list" id="prospects_form" >
            <input type="hidden" name="list_id" value="<?= $course_id; ?>">
            <?php

               
               if(mysqli_num_rows($select_bookmark) > 0){ // saved course
            ?>
                  <button 
                     type="submit" 
                     name="remove_bookmarks"
                     value="remove_bookmarks"
                  >
                     <i class="fas fa-bookmark"></i>
                     <span>Saved</span>
                  </button>
                 
            <?php
               }else{
            ?>
                  <button 
                  type="submit" 
                  name="save_bookmarks"
                  value="save_bookmarks"
                  >
                     <i class="far fa-bookmark"></i>
                     <span>Save Course</span>
                  </button>
            <?php
               }
            ?>
         </form>
         <div class="thumb">
            <span><?= $total_videos; ?> videos</span>
            <img src="../images/courses/<?= $fetch_course['course_Picture']; ?>" alt="">
         </div>
      </div>

      <div class="col">
         <div class="tutor">
            <img src="../images/companies_universities_images/<?= $LogoName ?>" alt="">
            <div>
               <h3><?= $fetch_course['course_Creator'];  ?></h3>
            </div>
         </div>
         <div class="details">
            <h3><?= $fetch_course['course_Name']; ?></h3>
            <p><?= $fetch_course['course_Description']; ?></p>
            <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_course['course_Launch_Date']; ?></span></div>
         </div>
      </div>

      <?php
         }else{
            echo '<p class="empty">this playlist was not found!</p>';
         }  
      ?>

   </div>

</section>

<!-- playlist section ends -->

<!-- videos container section starts  -->

<section class="videos-container">

   <h1 class="heading">Course Videos</h1>

   <div class="box-container">

      <?php
         $select_content = mysqli_query($conn,"SELECT * FROM `course_videos` WHERE course_ID = $course_id");
         if(mysqli_num_rows($select_content) > 0){
            while($fetch_content = mysqli_fetch_assoc($select_content)){
      ?>
            <a href="watch_video.php?video_id=<?= $fetch_content['video_ID']; ?>" class="box">
                <i class="fas fa-play"></i>
                <img src="../images/courses/<?= $fetch_content['video_Picture']; ?>" alt="">
                <h3><?= $fetch_content['video_Name']; ?></h3>
            </a>

   </div>

</section>
<section class="adsf">

            <?php
                    }
                }else{
                    echo '<p class="empty">no videos added yet!</p>';
                }
            ?>
</section>

<!-- videos container section ends -->










<style>

.empty{
   margin: -90px 15%;
    width: fit-content;
}
    /* .playlist {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .heading {
        padding-bottom: 1.8rem;
        border-bottom: var(--border);
        font-size: 2.5rem;
        color: var(--black);
        text-transform: capitalize;
        margin-bottom: 3rem;
    }
    .playlist .row {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        flex-wrap: wrap;
        padding: 2rem;
        background-color: #eee;
    }
    .playlist .row .col {
        flex: 1 1 40rem;
    }
    .playlist .row .col .thumb {
        position: relative;
        height: 20rem;
    }
 */




 
.playlist{
    padding: 2rem;
    background:#eee;
}

.playlist .row .col .thumb{
    height: 20rem;
}
.playlist .row{
   display: flex;
   align-items: flex-start;
   gap:2.5rem;
   flex-wrap: wrap;
   padding: 2rem;
   background-color: var(--white);
}

.playlist .row .col{
   flex: 1 1 40rem;
}

.playlist .row .col .save-list button{
   font-size: 2rem;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 1.2rem 2.5rem;
   cursor: pointer;
   margin-bottom: 2rem;
}

.playlist .row .col .save-list button i{
   color: var(--black);
   margin-right: 1rem;
}

.playlist .row .col .save-list button span{
   color: var(--light-color);
}

.playlist .row .col .save-list button:hover{
   background-color: var(--black);
}

.playlist .row .col .save-list button:hover i{
   color: var(--white);
}

.playlist .row .col .save-list button:hover span{
   color: var(--white);
}

.playlist .row .col .thumb{
   position: relative;
   height: 30rem;
}

.playlist .row .col .thumb span{
   position: absolute;
   top: 1rem; left: 1rem;
   border-radius: .5rem;
   padding: .5rem 1.5rem;
   font-size: 2rem;
   color: #fff;
   background-color: rgba(0,0,0,.3);
}

.playlist .row .col .thumb img{
   width: 100%;
   height: 14rem;
   border-radius: .5rem;
   object-fit: cover;
}

.playlist .row .col .tutor{
   display: flex;
   align-items: center;
   gap: 1.7rem;
}

.playlist .row .col .tutor img{
   height: 7rem;
   width: 7rem;
   border-radius: 50%;
   object-fit: cover;
}

.playlist .row .col .tutor h3{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .2rem;
}

.playlist .row .col .tutor span{
   color: var(--main-color);
   font-size: 1.5rem;
}

.playlist .row .col .details{
   padding-top: 1.5rem;
}

.playlist .row .col .details h3{
   font-size: 2rem;
   color: var(--black);
}

.playlist .row .col .details p{
   padding: 1rem 0;
   line-height: 2;
   color: var(--light-color);
   font-size: 1.7rem;
}

.playlist .row .col .details .date{
   font-size: 1.7rem; 
   padding-top: .5rem;
}

.playlist .row .col .details .date i{
   color: var(--main-color);
   margin-right: 1rem;
}

.playlist .row .col .details .date span{
   color: var(--light-color);
}




</style>


<!-- <script>
   console.log("asd");
   var form = document.getElementById("myForm");
function handleForm(event) { event.preventDefault(); } 
form.addEventListener('submit', handleForm);
</script> -->



