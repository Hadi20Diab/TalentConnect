<?php
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentType = $_POST['contentType'];
    $offset = $_POST['offset'];
	if($_POST['individual_ID']){
		$individual_ID = $_POST['individual_ID'];
	}
	else{
		$admin="";
	}
 
    if ($contentType === 'comment') {

        $videoID = $_POST['videoID'];

        // Retrieve the next 10 comments based on the video ID and offset
        $select_comments = mysqli_query($conn, "SELECT * FROM videos_comments WHERE video_ID = $videoID ORDER BY comment_Date DESC LIMIT $offset, 10");

        if (mysqli_num_rows($select_comments) > 0) {
            while ($fetch_comment = mysqli_fetch_assoc($select_comments)) {
                $select_commentor = mysqli_query($conn, "SELECT * FROM individuals WHERE individual_ID = {$fetch_comment['individual_ID']}");
                $fetch_commentor = mysqli_fetch_assoc($select_commentor);
                ?>
                <div class="SingleComment">
                    <!-- Comment content here -->
                    <div class="commentHeader">
                        <a href="../viewIndividualsProfile.php?individual_ID=<?= $fetch_commentor['individual_ID'] ?>" target="black">
                            <img src="../images/individuals_images/<?= $fetch_commentor['individual_photo'] ?>" alt="" style="width: 5rem; height: 5rem; border-radius: 50%; margin-right: 1rem;">
                        </a>
                    <div>
                        <h4><?= $fetch_commentor['individual_Name'] ?></h4>
                        <h4><?= $fetch_comment['comment_Date'] ?></h4>
                    </div>
                    <?php
                    if ($fetch_commentor['individual_ID'] == $individual_ID || isset($admin)) {
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
        }
    }
    elseif ($contentType === 'courses') {

        // Get the number of courses to load per request
        $limit = $_POST['limit'];
        // Query to retrieve courses based on user interests and limit the result
            // select Courses according to the user interest and excluded under-progress and done courses

        $sql = "SELECT DISTINCT c.*
                FROM courses c
                INNER JOIN individuals i
                LEFT JOIN courses_fields cf ON c.course_ID = cf.course_ID
                LEFT JOIN individual_intrested_field ii ON i.individual_ID = ii.individual_ID 
                LEFT JOIN course_progress cp ON c.course_ID = cp.course_ID AND i.individual_ID = cp.individual_ID
                WHERE c.course_Status = 'active'
                    AND cf.course_field_Name = ii.field_Name
                    AND i.individual_ID = $individual_ID
                    AND (cp.course_Status IS NULL OR cp.course_Status NOT IN ('under-progress', 'done'))
                ORDER BY c.course_Launch_Date DESC
                LIMIT $limit OFFSET $offset";

        $select_courses = mysqli_query($conn, $sql);
        // echo "btata".mysqli_num_rows($select_courses);
        if(mysqli_num_rows($select_courses) > 0) {
            while($fetch_course = mysqli_fetch_assoc($select_courses)) {
                // Display the course details here
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
        }
    }
    elseif ($contentType === 'jobs') {
        
    }
}
?>
