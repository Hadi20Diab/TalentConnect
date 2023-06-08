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
   
   <!-- <div class="row"> -->
      <h1 class="heading" style="     padding: 45px 45px 0px; ">
         <!-- back button -->
         <a href="courses.php"> 
             <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: var(--nav-main);"></i>
         </a>
         
         Course Details
      </h1>
   <!-- </div> -->
   <div class="row">

   <?php
         $select_course =  mysqli_query($conn,"SELECT * FROM `courses`
         INNER JOIN company ON company.company_Name  = courses.course_Creator
         WHERE course_ID = $course_id and course_Status = 'active' LIMIT 1");


         if(mysqli_num_rows($select_course) > 0){
            $fetch_course = mysqli_fetch_assoc($select_course);
            $role="company";
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
               $role="university";
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

      <title>
         <?= $fetch_course['course_Name']; ?>
      </title>

      <!-- bookmark -->
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

      ?>
      <!-- end bookmark -->

      <!-- course data -->


      <div class="col">
         <div style="     display: flex;     align-items: center;     justify-content: space-between;     flex-wrap: wrap; ">
            <div class="tutor">
               
               <?php if ($role== "company") {
                     ?>
                        <a href="../viewCompanyProfile.php?vcid=<?= $fetch_course['company_id']; ?>&cname=<?= $fetch_course['company_Name']; ?>" class="row" style="text-decoration: none;" target="_blank">
                        <img src="../images/companies_universities_images/<?= $fetch_course['company_Logo']; ?>" alt="">
                        
               <?php }else {
                     ?>
                        <a href="../viewUniversityProfile.php?vcid=<?= $fetch_course['university_ID']; ?>&cname=<?= $fetch_course['university_Name']; ?>" class="row" style="text-decoration: none;" target="_blank">
   
                        <img src="../images/companies_universities_images/<?= $fetch_course['university_Logo']; ?>" alt="">
               <?php
                     } 
               ?>
                        </a>
   
               <div>
                  <h3><?= $fetch_course['course_Creator'];  ?></h3>
               </div>
            </div>



            <?php
               $courseProgress_sql = "SELECT * FROM course_progress 
                                       WHERE individual_ID = $individual_ID AND course_ID = " . $fetch_course['course_ID'];

               $courseProgress_result = mysqli_query($conn, $courseProgress_sql);

               if ($courseProgress_result) {
                  $courseProgress = mysqli_fetch_assoc($courseProgress_result);
                  if (mysqli_num_rows($courseProgress_result) > 0) {
                     if ($courseProgress['course_Status']=="under-progress") {
                        echo '<a href="watch_video.php?video_id=' . $courseProgress['last_watched_video'] . '"
                        style="     background-color: var(--nav-main);     padding: 1rem;     border-radius: 25px;     color: var(--white); ">Resume Course</a>';
                     }
                     else if ($courseProgress['course_Status']=="done") {
                        echo '<a href="courses.php" style="     background-color: var(--nav-main);     padding: 1rem;     border-radius: 25px;     color: var(--white); ">
                                 Already Finshied! <br>
                                 Look For New Course
                              </a>'
                        ;
                     }
                  }
                  else {
                     echo '<a href=""style="     background-color: var(--nav-main);     padding: 1rem;     border-radius: 25px;     color: var(--white); ">
                              Enroll Course
                           </a>'
                     ;
                  }
               } else {
                  echo mysqli_error($conn); // Print any MySQL errors for debugging purposes
               }

            ?>



         </div>
         <div class="details">
            <h3>
               <i class="fas fa-regular fa-book" style="margin-right: 10px; color: var(--nav-main);"></i>
               <?= $fetch_course['course_Name']; ?>
            </h3>
            <p><?= $fetch_course['course_Description']; ?></p>
            <div style="display: flex;     justify-content: space-between;     align-items: center;">
               <div class="date"><i class="fas fa-calendar" style="color: var(--nav-main);"></i><span><?= $fetch_course['course_Launch_Date']; ?></span></div>
               <div> <h3>
                        <i class="fa-solid fa-money-bill" style="color: var(--nav-main);"></i>
                        <?= $fetch_course['course_Fees']; ?>$
                     </h3></div>
               </div>
            </div>
         </div>

      <div class="col">
         <div class="thumb">
            <a href="#videos-container" id="scroll-link">
               <span style="z-index: 1;"><?= $total_videos; ?> videos</span>
            </a>
            <!-- for video -->
            <link rel="stylesheet" href="../css/plyr.css">
            <script src="../js/plyr.js"></script>
            <div  class="DIVvideo" style="margin: 20px;">
               <video id="my-video" class="video" poster="../images/courses/<?= $fetch_course['course_Picture']; ?>" controls>
                  <source src="../images/courses/<?= $fetch_course['course_overall_Video']; ?>">
               </video>
            </div>
               <!-- script for video -->
               <script> 
                  const player = new Plyr('#my-video');
               </script>


            <!-- <img src="../images/courses/   $fetch_course['course_Picture'];  " alt=""> -->
         </div>
      </div>


      <?php
         }else{
            echo '<p class="empty">this Course was not found!</p>';
         }  
      ?>

   </div>

</section>

<!-- playlist section ends -->


<!-- videos container section starts  -->

<section id="videos-container" class="videos-container">

   <h1 class="heading" style="margin: 10px 5px 30px;"> 
      <i class="fa-solid fa-video" style="color: var(--nav-main);"></i>
      Course Videos   
   </h1>

   <div class="box-container">

      <?php // select video in asending order
         $select_content = mysqli_query($conn,"SELECT * FROM `course_videos` WHERE course_ID = $course_id ORDER BY `video_Order` ASC");
         if(mysqli_num_rows($select_content) > 0){
            while($fetch_content = mysqli_fetch_assoc($select_content)){
      ?>
               <a href="watch_video.php?video_id=<?= $fetch_content['video_ID']; ?>" class="box">
                  <i class="fa fas fa-play"></i>
                  <img src="../images/courses/<?= $fetch_content['video_Picture']; ?>" alt="">
                  <h3>
                     <?= $fetch_content['video_Order']; ?>.  <?= $fetch_content['video_Name']; ?>
                  </h3>
               </a>
            <?php
            }
            ?>
   </div>

         <?php
         }else{
            echo '<p class="empty">no videos added yet!</p>';
         }
         ?>
</section>


<!-- videos container section ends -->










<style>

.empty{
   margin: -90px 0%;
   width: fit-content;
   padding: 3rem 1rem;
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
    margin: 2rem;

    background-color: #eee;
      border-radius: 25px;
      position: relative;
}
.playlist .row{
   display: flex;
   align-items: flex-start;
   gap:2.5rem;
   flex-wrap: wrap;
   padding: 2rem;
   /* background:var(--white); */
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
   height: auto;
}

.playlist .row .col .thumb span{
   position: absolute;
   top: 1rem; left: 2rem;
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
   /* gap: 1.7rem; */
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
   /* margin-bottom: .2rem; */
}

.playlist .row .col .tutor span{
   color: var(--main-color);
   font-size: 1.5rem;
}

.playlist .row .col .details{
   padding-top: 1.5rem;
}

.playlist .row .col .details h3{
   font-size: 1.3rem;
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



.details{
   display: inherit;
}

.playlist .row .col .details p {
   font-size: large;
   white-space: pre-line;

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


<!-- style for video  -->

<style>
section.videos-container {
    background: #eee;
    width: 94%;
    margin: 2% 3%;
    border-radius: 25px;
    padding: 25px;
}


   .videos-container .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 27rem);
   gap: 1.5rem;
   align-items: flex-start;
   justify-content: center;
}

.videos-container .box-container .box{
   position: relative;
   border-radius: .5rem;
   padding: 2rem;
   background-color: var(--white);
}

.videos-container .box-container .box img{
   height: 15rem;
   width: 100%;
   border-radius: .5rem;
   object-fit: unset;
}

.videos-container .box-container .box i{
   position: absolute;
   top: 2rem; left: 2rem; right: 2rem;
   height: 15rem;
   background-color: rgba(0,0,0,.3);
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 4rem;
   color: #fff;
   border-radius: .5rem;
   display: none;
}

.videos-container .box-container .box:hover i{
   display: flex;
}

.videos-container .box-container .box h3{
   font-size: larger;
   color: var(--black);
   margin-top: 1rem;
}

.videos-container .box-container .box:hover h3{
   color: var(--main-color);
}

.watch-video .video-details{
   background-color: var(--white);
   padding: 2rem;
   border-radius: .5rem;
}

.watch-video .video-details .video{
   width: 100%;
   border-radius: .5rem;
   background: #000;
   height: 50rem;
}

.watch-video .video-details .title{
   font-size: 2rem;
   color: var(--black);
   padding: 1.5rem 0;
}

.watch-video .video-details .info{
   display: flex;
   gap: 2rem;
   padding-bottom: 1.5rem;
   border-bottom: var(--border);
}

.watch-video .video-details .info p{
   font-size:1.6rem;
}

.watch-video .video-details .info p i{
   margin-right: 1rem;
   color: var(--main-color);
}

.watch-video .video-details .info p span{
   color: var(--light-color);
}

.watch-video .video-details .tutor{
   padding: 2rem 0;
   display: flex;
   align-items: center;
   gap: 2rem;
}

.watch-video .video-details .tutor img{
   height: 7rem;
   width: 7rem;
   border-radius: 50%;
   object-fit: cover;
}

.watch-video .video-details .tutor h3{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .2rem;
}

.watch-video .video-details .tutor span{
   color: var(--light-color);
   font-size: 1.5rem;
}

.watch-video .video-details .flex{
   display: flex;
   align-items: center;
   gap: 1.5rem;
   justify-content: space-between;
}

.watch-video .video-details .flex a{
   margin-top: 0;
}

.watch-video .video-details .flex button{
   background-color: var(--light-bg);
   cursor: pointer;
   padding: 1rem 2.5rem;
   font-size: 2rem;
   border-radius: .5rem;
}

.watch-video .video-details .flex button i{
   color: var(--black);
   margin-right: 1rem;
}

.watch-video .video-details .flex button span{
   color: var(--light-color);
}

.watch-video .video-details .flex button:hover{
   background-color: var(--black);
}

.watch-video .video-details .flex button:hover i{
   color: var(--white);
}

.watch-video .video-details .flex button:hover span{
   color: var(--white);
}

.watch-video .video-details .description{
   padding-top: 2rem;
}

.watch-video .video-details .description p{
   line-height: 1.5;
   font-size: 1.7rem;
   color: var(--light-color);
   white-space: pre-line;
}

</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
  var scrollLink = document.getElementById('scroll-link');
  var videosContainer = document.getElementById('videos-container');
  
  scrollLink.addEventListener('click', function(event) {
    event.preventDefault();
    
    var containerTop = videosContainer.offsetTop;
    
    window.scrollTo({
      top: containerTop,
      behavior: 'smooth'
    });
  });
});
</script>