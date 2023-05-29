<?php
// Assuming you have a database connection established
include "../connection.php";
if (isset($_GET['jobID']) && isset($_GET['user_ID'])&& isset($_GET['status'])) {
    // Get the job ID from the AJAX request
    $user_ID = $_GET['user_ID'];
    $jobID = $_GET['jobID'];
    $status = $_GET['status'];


    if($status=="add"){
        // Perform the SQL query to insert the job ID into the bookmark database
        $query = "INSERT INTO bookmarks (user_ID,user_role,job_ID) VALUES ('$user_ID','individual','$jobID')";
    }
    else {
        $query = "DELETE FROM bookmarks WHERE job_ID = $jobID AND user_ID = $user_ID";
    }
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // close window
        echo '
        <script>
            window.close();
        </script>
        ';
        // Return a success message or any other response if needed
    } else {
        // Handle the error if the query failed
        echo "Error inserting job into bookmarks: " . mysqli_error($conn);
    }
} else {
    // Handle the case if the job ID is not provided
    echo "Job ID not provided";
}
?>
