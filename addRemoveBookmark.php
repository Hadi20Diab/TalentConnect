<?php
// Assuming you have a database connection established
// include "../connection.php";
// if (isset($_GET['jobID']) && isset($_GET['user_ID'])&& isset($_GET['status'])&& isset($_GET['user_role'])) {
//     // Get the job ID from the AJAX request
//     $user_ID = $_GET['user_ID'];
//     $user_role = $_GET['user_role'];
//     $jobID = $_GET['jobID'];
//     $status = $_GET['status'];


//     if($status=="add"){
//         // Perform the SQL query to insert the job ID into the bookmark database
//         $query = "INSERT INTO bookmarks (user_ID,user_role,job_ID) VALUES ('$user_ID','$user_role','$jobID')";
//     }
//     else {
//         $query = "DELETE FROM bookmarks WHERE job_ID = $jobID AND user_ID = $user_ID";
//     }
//     $result = mysqli_query($conn, $query);

//     // Check if the query was successful
//     if ($result) {
//         // close window
//         echo '
//         <script>
//             window.close();
//         </script>
//         ';
//         // Return a success message or any other response if needed
//     } else {
//         // Handle the error if the query failed
//         echo "Error inserting job into bookmarks: " . mysqli_error($conn);
//     }
// } else {
//     // Handle the case if the job ID is not provided
//     echo "Job ID not provided";
// }
?>


<?php
// Assuming you have a database connection established
include "connection.php";
if (isset($_GET['user_ID']) && isset($_GET['user_role'])) {
    // Get the parameters from request
    $user_ID = $_GET['user_ID'];
    $user_role = $_GET['user_role'];
    // check if set so will be store the data on the variable to be store it on database, other whise value Null 
    $course_ID = isset($_GET['course_id']) ? $_GET['course_id'] : null;
    $job_ID = isset($_GET['job_ID']) ? $_GET['job_ID'] : null;
    $internship_ID = isset($_GET['internship_ID']) ? $_GET['internship_ID'] : null;
    $scholarships_ID = isset($_GET['scholarships_ID']) ? $_GET['scholarships_ID'] : null;

    if ($user_ID && $user_role) {
        // Check if the bookmark exists
        $existingBookmark = mysqli_query($conn, "SELECT * FROM bookmarks WHERE
        
            user_ID = '$user_ID' AND 
            user_role = '$user_role' AND 
            course_ID = '$course_ID' AND 
            job_ID = '$job_ID' AND 
            internship_ID = '$internship_ID' AND 
            scholarships_ID = '$scholarships_ID' 
        ");
        if ($existingBookmark && mysqli_num_rows($existingBookmark) > 0) {
            // Bookmark exists, perform delete operation
            $query = "DELETE FROM bookmarks WHERE
                     user_ID = '$user_ID' AND 
                     user_role = '$user_role' AND 
                     course_ID = '$course_ID' AND 
                     job_ID = '$job_ID' AND 
                     internship_ID = '$internship_ID' AND 
                     scholarships_ID = '$scholarships_ID' 
            ";
        } else {
            // Bookmark does not exist, perform insert operation
            $query = "INSERT INTO bookmarks (user_ID, user_role, course_ID, job_ID, internship_ID, scholarships_ID)
                        VALUES ('$user_ID', '$user_role', '$course_ID', '$job_ID', '$internship_ID', '$scholarships_ID')";
        }

        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Return a success message
            echo "Bookmark operation performed successfully";
            
            // close window
            echo '
            <script>
                window.close();
            </script>
            ';
        } else {
            // Handle the error if the query failed
            echo "Error performing bookmark operation: " . mysqli_error($conn);
        }
    } else {
        // Handle the case if the required parameters are not provided
        echo "Required parameters not provided";
    }
} else {
    // Handle the case if the required parameters are not provided
    echo "Required parameters not provided";
}
?>

