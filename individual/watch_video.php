<?php 
    include "structural_IndividualPage.php";

    if(isset($_GET['video_id'])){
        $video_id = $_GET['video_id'];
    }else{
        $video_id = '';
        header('location: videos.php');
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
         while(($fetch_video = mysqli_fetch_assoc($select_videos))){

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
   
            if (!$count >0) {
               $select_course_Creator = mysqli_query($conn,
               "SELECT * FROM courses 
               INNER JOIN universities ON universities.university_Name  = courses.course_Creator
               
               WHERE video_ID = $video_id"
               );

            }


            $fetch_course_Creator = mysqli_fetch_assoc($select_course_Creator)
   ?>

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

      <div class="tutor">
         <img src="../images/companies_universities_images/<?= $fetch_course_Creator['company_Logo']; ?>" alt="">
         <div>
            <h3><?= $fetch_course_Creator['course_Creator']; ?></h3>
         </div>
      </div>

      <form action="" method="post" class="flex">
         <input type="hidden" name="video_id" value="<?= $video_id; ?>">
         <a href="viewCourse.php?course_id=<?= $fetch_video['course_ID']; ?>&LOGO=<?= $fetch_course_Creator['company_Logo']; ?>" class="inline-btn">View Course</a>

      </form>
      <div class="description"><p><?= $fetch_video['video_Description']; ?></p></div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>


   <div class="comments">
      <h3>Comments</h3>
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
