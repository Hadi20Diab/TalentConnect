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
      $course_ID=$fetch_video['course_ID'];

      $select_course = mysqli_query($conn,"SELECT course_Fees FROM `courses` WHERE course_ID = $course_ID");
      $fetch_course = mysqli_fetch_assoc($select_course);

      $course_Fees=$fetch_course['course_Fees'];



      // // check the user if have progress on this course or not (update or insert progress)
      // $select_progress = mysqli_query($conn,"SELECT course_progress_ID, last_watched_video  FROM `course_progress` WHERE individual_ID = $individual_ID AND course_ID ={$fetch_video['course_ID']}" );

      // if (mysqli_num_rows($select_progress) > 0) {
      //    $sql = "UPDATE `course_progress` SET `last_watched_video` ='$video_id'
      //             WHERE individual_ID= $individual_ID AND course_ID= ". $fetch_video['course_ID'];
      //    $result = mysqli_query($conn, $sql);
      //    mysqli_error($conn);
      // }
  }
?>

<!-- check the individual is watch the previous video or not  -->

<?php
// Query the course_progress table to get the last watched video ID for the individual and course
$select_progress = mysqli_query($conn, "SELECT last_watched_video FROM course_progress WHERE individual_ID = $individual_ID AND course_ID = $course_ID");
$fetch_progress = mysqli_fetch_assoc($select_progress);
if($fetch_progress ){
   $lastWatchedVideoID = $fetch_progress['last_watched_video'];
}

// Query the course_videos table to get the video order for the current video
$select_video = mysqli_query($conn, "SELECT video_Order FROM course_videos WHERE video_ID = $video_id");
$fetch_video = mysqli_fetch_assoc($select_video);
$currentVideoOrder = $fetch_video['video_Order'];

// Check if the individual has watched the previous video
if (!empty($lastWatchedVideoID) && $lastWatchedVideoID != $video_id) {
    // Query the course_videos table to get the video order for the last watched video
    $select_last_watched_video = mysqli_query($conn, "SELECT video_Order FROM course_videos WHERE video_ID = $lastWatchedVideoID");
    $fetch_last_watched_video = mysqli_fetch_assoc($select_last_watched_video);
    $lastWatchedVideoOrder = $fetch_last_watched_video['video_Order'];

    // Check if the last watched video order is less than the current video order
    if ($lastWatchedVideoOrder < $currentVideoOrder) {
        // Get the video order of the last watched video
        $lastVideoOrder = $lastWatchedVideoOrder;

        // Query the course_videos table to get the video ID of the last watched video
        $select_last_video = mysqli_query($conn, "SELECT video_ID FROM course_videos WHERE course_ID = $course_ID AND video_Order = $lastVideoOrder");
        $fetch_last_video = mysqli_fetch_assoc($select_last_video);

        // Check if the last watched video exists
        if ($fetch_last_video) {
            $lastVideoID = $fetch_last_video['video_ID'];

            // Redirecting to the last watched video
            echo '<div class="popup " id="popup" style="     background-color: #c2ffd4;">
                     <img src="assets/imgs/pending.png" >
                     <h2>Continue from Last Watched Video</h2>
                     <p>You can resume watching from where you left off.</p>
                     <button>
                        <a href="watch_video.php?video_id=' . $lastVideoID . '">OK</a>
                     </button>
                  </div>
             ';
             exit();  // to stop loading  the page 
        }
    }
}
else if(empty($lastWatchedVideoID) && $course_Fees == 0){ // if the user is the first time he view the video and he doesn't have any record on this course before (that's happpen when join free courses)
   
   // Query the course_videos table to get the video ID of the first video in the course
   $select_first_video = mysqli_query($conn, "SELECT video_ID FROM course_videos WHERE course_ID = $course_ID ORDER BY video_Order ASC LIMIT 1");
   $fetch_first_video = mysqli_fetch_assoc($select_first_video);
   
   // Check if the first video exists
   if ($fetch_first_video) {
       $firstVideoID = $fetch_first_video['video_ID'];
       // enroll individual in this course
       $sql = "INSERT INTO `course_progress`(individual_ID, course_ID, last_watched_video, course_Status)
                                     VALUES('$individual_ID', '$course_ID', '$firstVideoID', 'under-progress') ";
       $result = mysqli_query($conn, $sql);

       if($video_id!=$firstVideoID){
          // Redirecting to  the link to the first video
          echo '<div class="popup " id="popup" style="     background-color: #c2ffd4;">
                  <img src="assets/imgs/pending.png" >
                  <h2>Start Over</h2>
                  <p>You have not watched any videos in this course. <br>
                  You can start the course from the beginning.
                  </p>
                  <button>
                     <a href="watch_video.php?video_id=' . $firstVideoID . '">Start from Beginning</a>
                  </button>
               </div>
            ';
            exit();  // to stop loading  the page 
       }
   }
}
else if(!empty($lastWatchedVideoID) && $lastWatchedVideoID == $video_id){ // if this  
}
else{
   echo '<div class="popup " id="popup" style="     background-color: #c2ffd4;">
            <img src="assets/imgs/error.png" >
            <h2>Not Enrolled</h2>
            <p>You are not enrolled in this course. Please enroll in the course to access the videos.</p>
            <button>
            <a href="viewCourse.php?course_id=' . $course_ID . '">You are n\'t enrollment on this course</a>
            </button>
         </div>
         ';
   exit();  // to stop loading  the page 
}

?>






<?php


// add comment 

    if(isset($_POST['add_comment'])){

 
         $comment_box = $_POST['comment_box'];
         $comment_box = filter_var($comment_box, FILTER_SANITIZE_STRING);  //to sanitize the string by removing any tags and encoding special characters.
         $course_ID = $_POST['course_ID'];
         // $course_ID = filter_var($course_ID, FILTER_SANITIZE_STRING);
         $video_id = $_POST['video_id'];
         // $video_id = filter_var($video_id, FILTER_SANITIZE_STRING);
         $individual_ID = $_POST['individual_ID'];
         // $individual_Name = filter_var($individual_Name, FILTER_SANITIZE_STRING);


         $sql = "INSERT INTO `videos_comments`(video_ID, course_ID, comment, individual_ID) VALUES('$video_id', '$course_ID', '$comment_box', '$individual_ID') ";
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
      <!-- check if it's company or unviersity to put the image for it and redrection to company/ unviersty  -->
      <div class="tutor">
            <?php if ($role== "company") {
                  ?>
                  <a href="../viewCompanyProfile.php?company_id=<?= $fetch_course_Creator['company_id']; ?>" style="text-decoration: none; display: flex;     align-items: center;" target="_blank">
                     <img src="../images/companies_universities_images/<?= $fetch_course_Creator['company_Logo']; ?>" alt="">
                     <h3><?= $fetch_course_Creator['course_Creator']; ?></h3>   
                  </a>
            <?php }else {
                  ?>
                  <a href="../viewUniversityProfile.php?university_id=<?= $fetch_course_Creator['university_ID']; ?>" style="text-decoration: none; display: flex;     align-items: center;  " target="_blank">

                     <img src="../images/companies_universities_images/<?= $fetch_course_Creator['university_Logo']; ?>" alt="">
                     <h3><?= $fetch_course_Creator['course_Creator']; ?></h3>
                  </a>
            <?php
                  } 
            ?>

         
         <a href="viewCourse.php?course_id=<?= $fetch_video['course_ID']; ?>" class="inline-btn" style="    background-color: var(--nav-main);     padding: 1rem;     border-radius: 25px;     color: var(--white);"> <i class="fa-solid fa-book" style="margin-right:5px"></i>View Course</a>
           
      </div>

      <h3 class="title" style="margin: 0 2rem;">
         <i class="fa-solid fa-video" style="color: var(--nav-main);"></i>
         <?= $fetch_video['video_Name']; ?>
      </h3>




      <div  class="DIVvideo" style="margin: 20px;">
         <video id="my-video" class="video" poster="../images/courses/<?= $fetch_video['video_Picture']; ?>" controls>
            <source src="../images/courses/<?= $fetch_video['video_Position_Name']; ?>">
         </video>
      </div>
      <!-- script for video -->
      <script> 
         const player = new Plyr('#my-video');
      </script> 


<!-- check if the indivdual have a progress on this video to coutinue watching from the leaving time-->
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
         const videos =document.getElementById("my-video");

         setInterval(function() {
            const currentTime = Math.floor(videos.currentTime);

               // Send the updated time to the server using a PHP script
               const xhr = new XMLHttpRequest();
               xhr.open('GET', 'update_course_progress.php?individual_ID=' + <?= $individual_ID ?> + '&videoID=' + <?= $video_id ?> + '&time=' + currentTime);
               xhr.send();
         }, 20000); // 20 seconds (in milliseconds)
      </script>

      <!-- script to update the course progess to end  -->
      <script>
         videos.addEventListener('ended', function() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_course_progress.php?individual_ID=' + <?= $individual_ID ?> + '&course_ID=' + <?= $course_ID  ?> + '&video_ID=' + <?= $video_id ?>);
            xhr.send();
         });

      </script>


      <div class="description">
         <h3 class="title">
            <i class="fa-regular fa-memo-circle-info" style="    color: var(--nav-main);"></i>
            Description
         </h3>
         <p><?= $fetch_video['video_Description']; ?></p>
      </div>


      <div class="next-previousVideo">
         <?php // previous video
            if( $fetch_video['video_Order']!=1){
               $previousVideo=$fetch_video['video_Order']-1;

               $select_previousVideo = mysqli_query($conn,"SELECT video_ID, video_Name FROM `course_videos` WHERE course_ID = $course_ID AND video_Order = $previousVideo");
               if(mysqli_num_rows($select_previousVideo) > 0){
                  $fetch_previousVideo = mysqli_fetch_assoc($select_previousVideo);

                  echo'
                     <a href="watch_video.php?video_id='. $fetch_previousVideo['video_ID'].'"  class="a-btn"><i class="fa-solid fa-video" style="margin-right:5px;"></i>'. $fetch_previousVideo['video_Name'].'</a>
                  ';
               }
            }
            else{
               echo'
                  <p  class="a-btn" style="     background-color: gray; ">This is the first video</p>
               ';
            }
            
         ?>

         <!-- next video -->
         <?php
            $select_VideosCount = mysqli_query($conn,"SELECT video_ID FROM `course_videos` WHERE course_ID = $course_ID");

            if( $fetch_video['video_Order']!= mysqli_num_rows($select_VideosCount)){
               $nextVideo=$fetch_video['video_Order']+1;
               $select_nextVideo = mysqli_query($conn,"SELECT video_ID, video_Name FROM `course_videos` WHERE course_ID = $course_ID AND video_Order =$nextVideo");
               if(mysqli_num_rows($select_nextVideo) > 0){
                  $fetch_nextVideo = mysqli_fetch_assoc($select_nextVideo);

                  echo'
                     <a href="watch_video.php?video_id='. $fetch_nextVideo['video_ID'].'" class="a-btn"><i class="fa-solid fa-video" style="margin-right:5px"></i>'. $fetch_nextVideo['video_Name'].'</a>
                  ';
               }
            }
            else{
               echo'
                  <a href="generateCertificate.php?course_ID'. $course_ID .'&indvidual_ID='. $individual_ID.'"  class="a-btn"><i class="fa-regular fa-file-certificate" style="margin-right:5px"></i>Downlead Certificate</a>
               ';
            }
            
         ?>
      </div>
   </div>
   <?php
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>


   <div class="comments">
      <h3 class="title">Comments<i class="fa-regular fa-comments-question-check fa-lg" style="    color: var(--nav-main);     margin-left: 10px;"></i></h3>
      <div class="addComment">
         <form action="#" method="post" class="add-comment">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <input type="hidden" name="course_ID" value="<?= $course_ID; ?>">
            <input type="hidden" name="individual_ID" value="<?= $individual_ID ?>">
            <textarea name="comment_box" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
            <!-- add comment -->
            <button type="submit" name="add_comment" value="add comment" class="inline-btn" style="    position: absolute;     bottom: 2rem;     right: 2rem;     transform: scale(1.7);     color: var(--nav-main);     border: none;     background-color: transparent;     cursor: pointer;">
               <i class="fa-regular fa-paper-plane-top"></i>
            </button>

         </form>
      </div>



      </form>

<!-- comment's part -->
      <?php
// Retrieve the first 10 comments
$select_comments = mysqli_query($conn, "SELECT * FROM videos_comments WHERE video_ID = $video_id ORDER BY comment_Date DESC LIMIT 10");

if (mysqli_num_rows($select_comments) > 0) {
    while ($fetch_comment = mysqli_fetch_assoc($select_comments)) {
        $select_commentor = mysqli_query($conn, "SELECT * FROM individuals WHERE individual_ID = {$fetch_comment['individual_ID']}");
        $fetch_commentor = mysqli_fetch_assoc($select_commentor);
        ?>
        <div class="SingleComment">
        <div class="commentHeader">
            <a href="../viewIndividualsProfile.php?individual_ID=<?= $fetch_commentor['individual_ID'] ?>" target="black">
               <img src="../images/individuals_images/<?= $fetch_commentor['individual_photo'] ?>" alt="" style="width: 5rem; height: 5rem; border-radius: 50%; margin-right: 1rem;">
            </a>
            <div>
               <h4><?= $fetch_commentor['individual_Name'] ?></h4>
               <h4><?= $fetch_comment['comment_Date'] ?></h4>
            </div>
            <?php
            if ($fetch_commentor['individual_ID'] == $individual_ID) {
               echo '<button class="removeButton fa-solid fa-trash fa-lg" data-comment-id="' . $fetch_comment['comment_ID'] . '" style="border: none;     color: var(--nav-main);     position: absolute;     right: 2rem;     top: 2.5rem; cursor: pointer;"></button>';
            }
            ?>
            </div>
            <p class="commentText">
               <i class="fa-regular fa-comment" style="color: var(--nav-main);"></i>
               <?= $fetch_comment['comment'] ?>
            </p>
            <hr style="     margin: 15px 0; ">

         </div>
        <?php
    }
} else {
    echo '<p class="empty">No comments Yet</p>';
}
?>

<!-- Load More button -->
<div id="loadMoreComments" style="    text-align: center;">
    <button class="loadMoreButton a-btn">Load More</button>
</div>

<!-- Script to handle Load More button -->
<script>
    $(document).ready(function() {
        var offset = 10; // Starting offset for loading more comments
        
        $('.loadMoreButton').on('click', function() {
            var button = $(this); // Store the button reference
            
            // Send an AJAX request to fetch additional comments
            $.ajax({
                url: 'load_more.php',
                type: 'POST',
                data: {
                    videoID: <?= $video_id; ?>,
                    individual_ID: <?= $individual_ID; ?>,
                    contentType: 'comment',
                    offset: offset
                },
                beforeSend: function() {
                    // Disable the Load More button temporarily
                    button.attr('disabled', 'disabled').html('<i class="fa-duotone fa-loader fa-spin-pulse"></i> Loading...');
                },
                success: function(response) {
                    // Append the new comments to the comment section
                    $('.SingleComment:last').after(response);
                    
                    // Increment the offset for the next load
                    offset += 10;
                    
                    // Re-enable the Load More button
                    button.removeAttr('disabled').text('Load More');
                    
                    // Hide the Load More button if there are no more comments
                    if ($.trim(response) === '') {
                        $('#loadMoreComments').hide();
                    }
                }
            });
        });
    });
</script>


</section>

<!-- watch video section ends -->


<!-- script to remove comment -->
<script>
$(document).ready(function() {
   $(document).on('click', '.removeButton', function() {
      var commentID = $(this).data('comment-id');
      var button = $(this); // Store the button reference

      // Send an AJAX request to delete the comment on the same page
      $.ajax({
         url: window.location.href,
         type: 'POST',
         data: { deleteCommentID: commentID },
         success: function(response) {
            // If the comment was successfully deleted, slide up and remove the corresponding SingleComment div
            // console.log(response);
            if (response) {
               button.closest('.SingleComment').slideUp(function() {
                  $(this).remove(); // Use the button reference
               });
            }  
         }
      });
   });
});

</script>

<?php
if (isset($_POST['deleteCommentID'])) {
   $commentID = $_POST['deleteCommentID'];

   // Perform the delete query to remove the comment from the database
   $sql = "DELETE FROM videos_comments WHERE comment_ID = $commentID";
   $result = mysqli_query($conn, $sql);

   // if ($result) {
   //    echo 'success'; // Return success message to the AJAX request
   //    exit;
   // }
}
?>


<style>
   
.watch-video .video-details .title{
   font-size: 1.7rem;
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
   font-size:1.4rem;
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
   justify-content: space-between;
   gap: 2rem;
   margin: 0 2rem;
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
   padding: 2rem;
}

.watch-video .video-details .description p{
   line-height: 1.5;
   font-size: 1.4rem;
   color: var(--light-color);
   white-space: pre-line;
}

.comments{
   margin:0 2rem;
}

.comments .add-comment{
   background-color: var(--white);
   border-radius: .5rem;
   /* margin-bottom: 1rem; */
   padding: 1rem;
   position: relative;
}

.comments .add-comment textarea{
   border-radius: .5rem;
   padding: 1rem;
   width: 100%;
   height: 8rem;
   background-color: var(--light-bg);
   resize: vertical;
   font-size: 1.5rem;
   color: var(--black);
   min-height: 70px;
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

.next-previousVideo{
   display: flex;
   justify-content: space-between;     
   align-items: center;     
   flex-wrap: wrap;
   margin: 0 2rem 1rem;
}
.a-btn{
   background-color: var(--nav-main);
   padding: 1rem;
   border-radius: 25px;
   color: var(--white);
}
.commentHeader{
   display: flex;
   align-items: center;
   position: relative;
}
.commentText{
   margin-left: 6rem;
}


</style>