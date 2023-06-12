<?php
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentType = $_POST['contentType'];
    $offset = $_POST['offset'];
    $individual_ID = $_POST['individual_ID'];


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
        }
    }
    elseif ($contentType === 'courses') {

    }
    elseif ($contentType === 'jobs') {
        
    }
}
?>
