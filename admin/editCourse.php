<?php
    if(isset($_GET['course_ID']) && isset($_GET['admin_id']))
        $course_ID = $_GET['course_ID'];
    elseif (isset($_SESSION['course_ID']) && isset($_GET['admin_id']))
        $course_ID = $_SESSION['course_ID'];
    else{
        $course_ID = '';
        exit();
    }
?>


<?php
include "structuralAdminPage.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Retrieve the submitted course information
  $course_ID = $_GET['course_ID'];

  
  $query = "SELECT * FROM courses WHERE course_ID = $course_ID";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $course = mysqli_fetch_assoc($result);

    // Retrieve the course information
    $course_ID = $course['course_ID'];
    $courseName = $course['course_Name'];
    $courseDescription = $course['course_Description'];
    $courseCreator = $course['course_Creator'];
    $courseFees = $course['course_Fees'];
    $courseStatus = $course['course_Status'];
    $courseLaunchDate = $course['course_Launch_Date'];
  }

    // Update course information in the database
    if (isset($_GET['course_name'])) {
        $course_ID = $_GET['course_ID'];
        $courseName = $_GET['course_name'];
        $courseDescription = $_GET['course_description'];
        $courseFees = $_GET['course_fees'];
        $courseStatus = $_GET['course_status'];
        

        
        $updateCourseQuery = "UPDATE courses SET course_Name = ?, course_Description = ?, course_Fees = ?, course_Status = ? WHERE course_ID = ?";
        $stmt = mysqli_prepare($conn, $updateCourseQuery);
        mysqli_stmt_bind_param($stmt, "ssdsi", $courseName, $courseDescription, $courseFees, $courseStatus, $course_ID);
        mysqli_stmt_execute($stmt);
    
        // Retrieve the submitted video order
        $videoOrder = $_GET['video_order'];
    
        // Update video order in the database
        foreach ($videoOrder as $videoID => $order) {
        $updateVideoOrderQuery = "UPDATE course_videos SET video_Order = ? WHERE video_ID = ?";
        $stmt = mysqli_prepare($conn, $updateVideoOrderQuery);
        mysqli_stmt_bind_param($stmt, "ii", $order, $videoID);
        mysqli_stmt_execute($stmt);
        }




           // Delete existing fields for the course
    $deleteFieldsQuery = "DELETE FROM courses_fields WHERE course_ID = ?";
    $stmt = mysqli_prepare($conn, $deleteFieldsQuery);
    mysqli_stmt_bind_param($stmt, "i", $course_ID);
    mysqli_stmt_execute($stmt);

    // Insert the selected fields for the course
    if (isset($_GET['selected_fields'])) {
        $selectedFields = $_GET['selected_fields'];
        $insertFieldsQuery = "INSERT INTO courses_fields (course_ID, course_field_Name) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertFieldsQuery);
        mysqli_stmt_bind_param($stmt, "is", $course_ID, $fieldName);

        foreach ($selectedFields as $fieldName) {
            mysqli_stmt_execute($stmt);
        }
    }



        // echo '
        // <script>
        //     function closePopup(){
        //         popup.classList.add("open-popup");
        //     } 
        // </script>
        //     <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
        //         <img src="assets/imgs/tick.png" >
        //         <h2 style="color:green;">Thank you!</h2>
        //         <p >Course Information Update Successfully!</p>
        //         <button type="button" style="background: #6fd649;"  onclick="closePopup()">OK</button>
        //     </div>

        // ';
    
        // Redirect back to the course page or display a success message
        echo '<script>window.location.href = "viewCourse.php?course_id='.$course_ID.'";</script>';
    }
}
?>









<style>
  .UpdateCourseForm {
    max-width: 40rem;
    margin: 2rem auto;
    padding: 20px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  .UpdateCourseForm a{
    text-decoration: none;
    background-color: var(--nav-main);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  h2 {
    margin-top: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  input[type="text"],
  textarea,
  select,
  input[type="number"],
  input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  textarea{
    resize: vertical;
    min-height:180px;
  }
  .UpdateCourseForm button[type="submit"] {
    background-color: var(--nav-main);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  .video-order-label {
    font-weight: bold;
    /* margin-top: 15px; */
  }

  .video-order-input {
    width: 50px;
    margin-bottom: 5px;
  }
</style>



<?php
// Fetch available fields from the categories table
$availableFieldsQuery = "SELECT * FROM categories";
$availableFieldsResult = mysqli_query($conn, $availableFieldsQuery);

// Fetch selected fields for the course from the courses_fields table
$selectedFieldsQuery = "SELECT course_field_Name FROM courses_fields WHERE course_ID = ?";
$stmt = mysqli_prepare($conn, $selectedFieldsQuery);
mysqli_stmt_bind_param($stmt, "i", $course_ID);
mysqli_stmt_execute($stmt);
$selectedFieldsResult = mysqli_stmt_get_result($stmt);

// Store the selected field names in an array
$selectedFields = [];
while ($row = mysqli_fetch_assoc($selectedFieldsResult)) {
    $selectedFields[] = $row['course_field_Name'];
}
?>






<!-- For Select (search) -->
<head>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/selectize.min.js"></script>
    <link rel="stylesheet" href="../js/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <script>
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
    </script>
</head>



<form action="#" method="GET" class="UpdateCourseForm">
  <h2 style="     display: flex;     flex-wrap: nowrap;     align-items: center;     justify-content: space-between;">
    Update Course Information
    <a href="viewCourse.php?course_id=<?= $course_ID?>" target="_black" > <i class="fa-solid fa-book" style="margin-right:5px"></i> View Course</a>
  </h2>

  <input type="hidden" id="course_ID" name="course_ID" value="<?php echo $course_ID; ?>">
  <input type="hidden" id="course_ID" name="admin_id" value="<?php echo $_GET['admin_id']; ?>">
  <!-- Course Information -->
  <label for="course_name">Course Name:</label>
  <input type="text" id="course_name" name="course_name" value="<?php echo $courseName; ?>" required>

  <label for="course_description"><i class="fa-solid fa-audio-description"style="color: var(--nav-main);"></i> Course Description:</label>
  <textarea id="course_description" name="course_description" required><?php echo $courseDescription; ?></textarea>

  <label for="course_creator"><i class="fa-solid fa-building"style="color: var(--nav-main);"></i>Course Creator:</label>
  <input type="text" id="course_creator" name="course_creator" value="<?php echo $courseCreator; ?>" required disabled>

  <label for="course_fees"> <i class="fa-solid fa-money-bill" style="color: var(--nav-main);"></i> Course Fees (in $):</label>
  <input type="number" id="course_fees" name="course_fees" value="<?php echo $courseFees; ?>" required>

  <label for="course_status"><i class="fa-solid fa-circle-info" style="color: var(--nav-main);"></i> Course Status: </label>
  <select id="course_status" name="course_status" required>
    <option value="active" <?php if ($courseStatus == 'active') echo 'selected'; ?>>active</option>
    <option value="Inactive" <?php if ($courseStatus == 'Inactive') echo 'selected'; ?>>Inactive</option>
  </select>

    <!-- Display the available fields and mark the selected ones -->
    <label for="selected_fields">Select Fields:</label>
    <select id="selected_fields" name="selected_fields[]" multiple>
        <?php while ($row = mysqli_fetch_assoc($availableFieldsResult)) {
            $fieldName = $row['category_name'];
            $selected = in_array($fieldName, $selectedFields) ? 'selected' : '';
            echo '<option value="' . $fieldName . '" ' . $selected . '>' . $fieldName . '</option>';
        } ?>
    </select>


  <label for="course_launch_date"><i class="fas fa-calendar" style="color: var(--nav-main);"></i> Course Launch Date:</label>
  <input type="date" id="course_launch_date" name="course_launch_date" value="<?php echo $courseLaunchDate; ?>" required disabled>

  <!-- Video Order -->
  <h2>Update Video Order <i class="fa-solid fa-video" style="margin-right:5px; color: var(--nav-main);"></i></h2>
  
  <p>Enter the order for each video: </p>
  <?php
    // Fetch videos for the course from the database
    $course_ID = $_GET['course_ID']; // Assuming you get the course ID from the URL or any other method
    $videosQuery = mysqli_query($conn, "SELECT * FROM course_videos WHERE course_ID = $course_ID ORDER BY video_Order ASC");
    while ($row = mysqli_fetch_assoc($videosQuery)) {
      $videoID = $row['video_ID'];
      $videoName = $row['video_Name'];
      $videoOrder = $row['video_Order'];
      echo'
        <div style="     display: flex;     justify-content: space-between;     align-items: center;     margin-top: 15px; ">
            <label class="video-order-label" for="video_order_' . $videoID . '"><i class="fas fa-duotone fa-play" style="color: var(--nav-main);" ></i>' . $videoName . ':</label>
            <a href="watch_video.php?video_id='. $videoID.'" target="_black" ><i class="fa-solid fa-video" style="margin-right:5px;"></i>View Video</a>
        </div>
        ';
      echo '<input class="video-order-input" type="number" id="video_order_' . $videoID . '" name="video_order[' . $videoID . ']" value="' . $videoOrder . '" required>';
    }
  ?>

  <!-- Submit Button -->
  <button type="submit">Update Course</button>
</form>