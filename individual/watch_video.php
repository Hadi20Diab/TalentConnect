<?php 
    include "structural_IndividualPage.php";

    if(isset($_GET['video_id'])){
        $video_id = $_GET['video_id'];
    }else{
        $video_id = '';
        header('location: videos.php');
    }

//course_progress
// to update or insert the last_watched_video 
   $select_videos = mysqli_query($conn,"SELECT * FROM `course_videos` WHERE video_ID = $video_id");
   if(mysqli_num_rows($select_videos) > 0){
      $fetch_video = mysqli_fetch_assoc($select_videos);

      // check the user if have progress on this course or not (update or insert progress)
      $select_progress = mysqli_query($conn,"SELECT course_progress_ID  FROM `course_progress` WHERE individual_ID = $individual_ID AND course_ID ={$fetch_video['course_ID']}" );

      if (mysqli_num_rows($select_progress) > 0) {
         $sql = "UPDATE `course_progress` SET `last_watched_video` ='$video_id'
                  WHERE individual_ID= $individual_ID AND course_ID= ". $fetch_video['course_ID'];
         $result = mysqli_query($conn, $sql);
         mysqli_error($conn);
      }
      else{ // course is free 
         $sql = "INSERT INTO `course_progress`(individual_ID, course_ID, last_watched_video, course_Status) VALUES('$individual_ID', '{$fetch_video['course_ID']}', '$video_id', 'under-progress') ";
         $result = mysqli_query($conn, $sql);
      }
  }




    if(isset($_POST['add_comment'])){

 
         $comment_box = $_POST['comment_box'];
         $comment_box = filter_var($comment_box, FILTER_SANITIZE_STRING);
         $course_ID = $_POST['course_ID'];
         $course_ID = filter_var($course_ID, FILTER_SANITIZE_STRING);
         $video_id = $_POST['video_id'];
         $video_id = filter_var($video_id, FILTER_SANITIZE_STRING);
         $individual_Name = $_POST['individual_Name'];
         $individual_Name = filter_var($individual_Name, FILTER_SANITIZE_STRING);


         $sql = "INSERT INTO `videos_comments`(video_ID, course_ID, comment, Commented_by) VALUES('$video_id', '$course_ID', '$comment_box', '$individual_Name') ";
         $result = mysqli_query($conn, $sql);

   }





    ?>


<!-- watch video section starts  -->

<section class="watch-video">

   <?php
      $select_videos = mysqli_query($conn,"SELECT * FROM `course_videos` WHERE video_ID = $video_id");
      if(mysqli_num_rows($select_videos) > 0){
         // while(($fetch_video = mysqli_fetch_assoc($select_videos))){
         $fetch_video = mysqli_fetch_assoc($select_videos);
            
            // $video_id = $fetch_video['video_ID'];

            // $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE video_id = ?");
            // $select_likes->execute([$video_id]);
            // $total_likes = $select_likes->rowCount();  

            // $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE individual_ID = ? AND video_id = ?");
            // $verify_likes->execute([$individual_ID, $video_id]);

            // $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ? LIMIT 1");
            // $select_tutor->execute([$fetch_video['tutor_id']]);
            // $fetch_course_Creator = $select_tutor->fetch(PDO::FETCH_ASSOC);

            $select_course_Creator = mysqli_query($conn,
               "SELECT * FROM courses 
               INNER JOIN course_videos ON courses.course_ID = course_videos.course_ID
               INNER JOIN company ON company.company_Name  = courses.course_Creator
               
               WHERE video_ID = $video_id"
            );

            $count = mysqli_num_rows($select_course_Creator);
            $role="company";
   
            if (!$count >0) {
               $select_course_Creator = mysqli_query($conn,
               "SELECT * FROM courses 
               INNER JOIN universities ON universities.university_Name  = courses.course_Creator
               
               WHERE video_ID = $video_id"
               );

               $role="university";

            }


            $fetch_course_Creator = mysqli_fetch_assoc($select_course_Creator);
   ?>

<title>
   <?= $fetch_video['video_Name']; ?>
</title>

<!-- style and script for video -->
<!-- <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css">
<script src="https://cdn.plyr.io/3.6.8/plyr.js"></script> -->
<link rel="stylesheet" href="../css/plyr.css">
<script src="../js/plyr.js"></script>


   <div class="video-details">
      <div  class="DIVvideo" style="margin: 20px;">
         <video id="my-video" class="video" poster="../images/courses/<?= $fetch_video['video_Picture']; ?>" controls>
            <source src="../images/courses/<?= $fetch_video['video_Position_Name']; ?>">
         </video>
      </div>
      <!-- script for video -->
      <script> 
         const player = new Plyr('#my-video');
      </script> 


      <?php
         $select_video_progress = mysqli_query($conn,"SELECT watched_time	FROM video_progress
                                             WHERE video_ID = $video_id AND individual_ID=$individual_ID");
         
         // If the user have Watched the video before 
         if(mysqli_num_rows($select_video_progress) > 0){
            $fetch_video_progress = mysqli_fetch_assoc($select_video_progress);
            $watchedTime=$fetch_video_progress["watched_time"];
          ?>
            <script> 
               // Get the watched time from the database
               const watchedTime = <?= $watchedTime ?>;

               // Play the video from the watched time
               const videos =document.getElementById("my-video");
               videos.currentTime = watchedTime;
               // videos.play();

            </script>

          <?php  
         }
      ?>

      <script> //script to update or insert watching time on database 
         // Update the watching time every 20 seconds
         setInterval(function() {
            const currentTime = Math.floor(videos.currentTime);

               // Send the updated time to the server using a PHP script
               const xhr = new XMLHttpRequest();
               xhr.open('GET', 'update_watching_time.php?individual_ID=' + <?= $individual_ID ?> + '&videoID=' + <?= $video_id ?> + '&time=' + currentTime);
               xhr.send();
         }, 20000); // 20 seconds (in milliseconds)
      </script>


      <h3 class="title"><?= $fetch_video['video_Name']; ?></h3>
      <!-- check if it's company or unviersity to put the image for it and redrection to company/ unviersty  -->
      <div class="tutor">
            <?php if ($role== "company") {
                  ?>
                  <a href="../viewCompanyProfile.php?company_id=<?= $fetch_course_Creator['company_id']; ?>" style="text-decoration: none;" target="_blank">
                     <img src="../images/companies_universities_images/<?= $fetch_course_Creator['company_Logo']; ?>" alt="">
                     <h3><?= $fetch_course_Creator['course_Creator']; ?></h3>   
                  </a>
            <?php }else {
                  ?>
                  <a href="../viewUniversityProfile.php?university_id=<?= $fetch_course_Creator['university_ID']; ?>" style="text-decoration: none;" target="_blank">

                     <img src="../images/companies_universities_images/<?= $fetch_course_Creator['university_Logo']; ?>" alt="">
                     <h3><?= $fetch_course_Creator['course_Creator']; ?></h3>
                  </a>
            <?php
                  } 
            ?>

         
           
      </div>

         <a href="viewCourse.php?course_id=<?= $fetch_video['course_ID']; ?>" class="inline-btn">View Course</a>

      <div class="description"><p><?= $fetch_video['video_Description']; ?></p></div>
   </div>
   <?php
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>


   <div class="comments">
      <h3>Comments<i class="fa-regular fa-comments-question-check fa-lg" style="    color: var(--nav-main);     margin-left: 10px;"></i></h3>
      <div class="addComment">
         <form action="" method="post" class="add-comment">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <input type="hidden" name="course_ID" value="<?= $course_ID; ?>">
            <input type="hidden" name="individual_Name" value="<?= $fetch_profile['individual_Name']; ?>">
            <textarea name="comment_box" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" value="add comment" name="add_comment" class="inline-btn">
         </form>
      </div>



      </form>


      <?php
         $select_comments = mysqli_query($conn,"SELECT * FROM videos_comments WHERE video_ID=$video_id ");
         if(mysqli_num_rows($select_comments) > 0){

            while($fetch_comment = mysqli_fetch_assoc($select_comments)){

?>



      <div class="SingleComment">
         <div class="commentHeader">
            <img src="" alt="">
            <div>
               <h4><?= $fetch_comment['Commented_by'] ?></h4>
               <h4><?= $fetch_comment['comment_Data'] ?></h4>
            </div>
         </div>

         <p class="commentText">
            <?= $fetch_comment['comment'] ?>
         </p>
      </div>
<?php
   }
}
else{
   echo'
      <p>NO comments Yet</p>
   ';
}
?>
   </div>

</section>

<!-- watch video section ends -->



<style>
   
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

.comments .add-comment{
   background-color: var(--white);
   border-radius: .5rem;
   margin-bottom: 3rem;
   padding: 2rem;
}

.comments .add-comment textarea{
   border-radius: .5rem;
   padding: 1rem;
   width: 100%;
   height: 10rem;
   background-color: var(--light-bg);
   resize: vertical;
   font-size: 1.8rem;
   color: var(--black);
   min-height: 71px;
}

.comments .show-comments{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   display: grid;
   gap: 2.5rem;
}

.comments .show-comments .user{
   display: flex;
   align-items: center;
   gap: 1.5rem;
   margin-bottom: 2rem;
}

.comments .show-comments .user img{
   height: 5rem;
   width: 5rem;
   border-radius: 50%;
   object-fit: cover;
}

.comments .show-comments .user h3{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .2rem;
}

.comments .show-comments .user span{
   color: var(--light-color);
   font-size: 1.5rem;
}

.comments .show-comments .content{
   margin-bottom: 2rem;
}

.comments .show-comments .content p{
   font-size: 2rem;
   color: var(--black);
   padding: 0 1rem;
   display: inline-block;
}

.comments .show-comments .content span{
   font-size: 1.7rem;
   color: var(--light-color);
}

.comments .show-comments .content a{
   color: var(--main-color);
   font-size: 1.8rem;
}

.comments .show-comments .content a:hover{
   text-decoration: underline;
}

.comments .show-comments .text{
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 1rem 1.5rem;
   color: var(--black);
   margin: .5rem 0;
   position: relative;
   z-index: 0;
   white-space: pre-line;
   font-size: 1.8rem;
}

.comments .show-comments .text::before{
   content: '';
   position: absolute;
   top: -1rem; left: 1.5rem;
   height: 1.2rem;
   width: 2rem;
   background-color: var(--light-bg);
   clip-path: polygon(50% 0%, 0% 100%, 100% 100%); 
}

.edit-comment form{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
}

.edit-comment form .box{
   width: 100%;
   border-radius: .5rem;
   padding: 1.4rem;
   font-size: 1.8rem;
   color: var(--black);
   background-color: var(--light-bg);
   resize: none;
   height: 20rem;
}

</style>