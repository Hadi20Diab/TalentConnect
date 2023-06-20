<?php
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted data
    $courseId = $_POST['course_id'];
    $individual_ID = $_POST['individual_ID'];
    $rating = $_POST['rating'];

    // Save the rating in the database
    $sql = "UPDATE course_progress SET course_Rate = $rating WHERE course_ID = $courseId AND individual_ID = $individual_ID";
    $result = mysqli_query($conn, $sql);
}
?>
