<?php
include "../connection.php";
session_start();

// Retrieve the values from the URL query parameters
if (isset($_GET['individual_ID']) && isset($_GET['videoID']) && isset($_GET['time'])) {

    $individualID = $_GET['individual_ID'];
    $videoID = $_GET['videoID'];
    $time = $_GET['time'];

    //------------
    $select_video_progress = mysqli_query($conn, "SELECT watched_time FROM video_progress
        WHERE video_ID = $videoID AND individual_ID=$individualID");

    // If the user has watched the video before
    if (mysqli_num_rows($select_video_progress) > 0) {
        $fetch_video_progress = mysqli_fetch_assoc($select_video_progress);
        $watchedTime = $fetch_video_progress["watched_time"];

        // Update will be done if watchedTime (on the database) doesn't equal the user's current watching time
        // to reduce the load on the server
        if ($watchedTime != $time) {
            // Update the watched_time value in the database
            $sql = "UPDATE video_progress SET watched_time = '$time' WHERE individual_ID = $individualID AND video_ID = $videoID";
            // Apply the query
            mysqli_query($conn, $sql);
        }
    } else { // If the user is watching the video for the first time
        echo"adfsdf";
        $sql = "INSERT INTO video_progress (individual_ID, video_ID, watched_time) VALUES ('$individualID','$videoID','$time')";
        // Apply the query
        mysqli_query($conn, $sql);
    }
}

// Close the database connection
mysqli_close($conn);
?>
