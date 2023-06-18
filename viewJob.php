<?php 

require_once 'connection.php';


if(isset($_GET['job_id']) ){
    $job_id = $_GET['job_id'];

    $selectJob = mysqli_query($conn,"SELECT * FROM jobs WHERE job_id='$job_id' ");
    $selectJob = mysqli_fetch_assoc($selectJob);
// fetch job data
    $position=$selectJob['position'];
    $deliveredBy=$selectJob['deliveredBy'];
    $job_Country=$selectJob['job_Country'];
    $jobType=$selectJob['jobType'];
    $job_WorkPlace=$selectJob['job_WorkPlace'];
    $jobDescription=$selectJob['jobDescription'];
    $skills=$selectJob['skills'];
    $applicationDeadline=$selectJob['applicationDeadline'];
    $postedDate=$selectJob['postedDate'];
    $salaryRange=$selectJob['salaryRange'];
    $job_apply_link=$selectJob['job_apply_link'];




    $select_Job = mysqli_query($conn,
    "SELECT * FROM jobs 
    INNER JOIN company ON company.company_Name  = jobs.deliveredBy
    WHERE jobs.job_id  = $job_id
    
"
    );
    $role="company";
    $count = mysqli_num_rows($select_Job);

    if (!$count >0) { // course creator not company so it's univeristy 
        $select_Job = mysqli_query($conn,
        "SELECT * FROM jobs 
        INNER JOIN universities ON universities.university_Name  = jobs.deliveredBy
        
        WHERE jobs.job_id  = $job_id"
        );
        $role="univeristy";

    }

    $fetch_job_Creator = mysqli_fetch_assoc($select_Job);


    if($role=="company"){

        $company_id=$fetch_job_Creator['company_id'];
        $deliveredByLOGO=$fetch_job_Creator['company_Logo'];
    }
    else{
        $university_id=$fetch_job_Creator['university_ID'];
        $deliveredByLOGO=$fetch_job_Creator['university_Logo'];
    }


    echo'
 
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>'. $position . '</title>
    </head>
    
    ';

}





?>
    <body>
   
    <link rel="stylesheet" href="css/CompanyProfileStyle.css">
    <link rel="stylesheet" href="css/all_icon.css">
    
    
    <section class="companyProfileContainer">
 
    <!-- </section> -->







<!-- <section class="browseJobsBody otherSection"> -->
            
            <div class="jobsPost">
                <div class="sourceInformtion row">
                    <div class="sourceName row">

                    <?php
         if($role=="company"){
            echo '
            <a href="viewCompanyProfile.php?company_id=' . $company_id . '" class="row" style="text-decoration: none;" target="_black">
            ';
            
        }
        else{
            echo'
                <a href="viewUniversityProfile.php?university_id=' . $university_id . '" class="row" style="text-decoration: none;" target="_black">
            ';
        }
        ?>
                            <img src="images/companies_universities_images/<?= $deliveredByLOGO; ?>" class="logo icon" alt="">
                            <h4><?= $deliveredBy; ?></h4>
                        </a>
                    </div>

                    <div class="jobDeadline">
                        Due to: <?= $applicationDeadline; ?>
                    </div>
                    
                </div>
                <hr>
                <div class="postDetails">

                    <h4 class="opportunityTitle">

                        Position:
                        <span>
                        <?= $position; ?>
                        </span>
                    </h4>

                    <h4 class="column">
                        <span class="groupName">
                            Requirment:
                        </span>
                        <span class="requirmentDetails Details">
                            <h5>
                                <?= $jobDescription; ?>
                            </h5>
                        </span>
                    </h4>


                    <h4 class="column">
                        <span class="groupName">
                            Skills:
                        </span>
                        <span class="requirmentDetails Details">
                            <h5>
                                <!-- FOR SKills -->
                                <?php
                                // Split the skills string into an array
                                $skillArray = explode(', ', $skills);

                                // Print each skill within an <li> element
                                echo '<ul>';
                                foreach ($skillArray as $skill) {
                                    echo '<li>' . $skill . '</li>';
                                }
                                echo '</ul>';

                                ?>
                            </h5>
                        </span>
                    </h4>
                </div>
                <br>
                <div class="applyButtun">
                    <a href="<?= $job_apply_link; ?>" target="_black">
                        APPLY HERE
                    </a>
                </div>
                <hr>
                <div class="likedCommentsDiv row">
                    <div class="like row">
                        <!-- <span class="likedCounts">20</span> -->
                        <img src="images/icons/likeIcon.png" class="icon" class="icon" alt="">
                    </div>
                    <div class="comments row">
                        <img src="images/icons/commentIcon.png" class="icon" alt="">
                        <!-- <span>write hear an comments</span> -->
                    </div>
                    <div class="save row">
                        <img src="images/icons/saveIcon.png" class="icon" alt="">
                        <!-- <span>Save Post</span> -->
                    </div>
                </div>
            </div>

        </section>



        <link rel="stylesheet" href="UserBrowseJobsStyle.css">







        
</body>
</html>
