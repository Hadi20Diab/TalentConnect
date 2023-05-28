<?php 

require_once 'connection.php';


if(isset($_GET['vcid']) && isset($_GET['cname'])){
    $vcid = $_GET['vcid'];
    $cname = $_GET['cname'];

    $selectuniversity = mysqli_query($conn,"SELECT * FROM universities WHERE university_id='$vcid' ");

    $fetch_university = mysqli_fetch_assoc($selectuniversity);


    $universityID=$fetch_university['university_ID'];
    $university_Name=$fetch_university['university_Name'];
    $university_acronym=$fetch_university['university_acronym'];
    $university_Email=$fetch_university['university_Email'];
    $university_PhoneNumber=$fetch_university['university_phoneNumber'];
    $university_Logo=$fetch_university['university_Logo'];
    $university_country=$fetch_university['university_country'];
    $university_status=$fetch_university['university_Status'];
    $university_About=$fetch_university['university_About'];
    echo'
 
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>'. $university_Name . '</title>
    </head>
    <body>
    
    
    
    <!--  
    <link rel="stylesheet" href="css/universityProfileStyle.css">
    -->
    
    <link rel="stylesheet" href="css/CompanyProfileStyle.css">
    <link rel="stylesheet" href="css/all_icon.css">
    
    
    <section class="companyProfileContainer">
        <div class="companyHeader">
    
            <div calss="companyLogo">
        
                <img src="images/companies_universities_images/'. $university_Logo .' " class="logoIMG" alt="">
        
                <h2>' . $university_Name . '</h2>
                ';
                if(!empty($university_Location)){ // if website link is set so will be display
                    echo'
                        <h5> <i class="fa-solid fa-location-dot"></i>' . $university_Location . '</h5>

                    ';
                }
                echo'
                



            </div>
    
        <div class="contactInformation DIV">
            <h3>Links</h3>
            ';
            if(!empty($university_Website)){ // if website link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fad fa-duotone fa-browser"></i>
                        <a href="'. $university_Website .' " target="_blank">Visit Website</a>
                    </div>
                ';
            }
            if(!empty($university_Linkedin)){ // if linkedin link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fa fa-brands fa-linkedin"></i>
                        <a href="'. $university_Linkedin .' " target="_blank">View linkedin Profile</a>
                    </div>
                ';
            }
            if(!empty($university_Instagram)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fa-brands fa-instagram"></i>
                        <a href=" '. $university_Instagram .' "target="_blank" >Follow Instagram Page</a>
                    </div>            
                ';
            }
            if(!empty($university_Twitter)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                    <i class="fa-brands fa-twitter"></i>
                    <a href=" '. $university_Twitter .' "target="_blank" > Follow on Twitter</a>
                    </div>            
                ';
            }
            if(!empty($university_Facebook)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                    <i class="fa-brands fa-facebook"></i>
                    <a href=" '. $university_Facebook .' "target="_blank" >View Facebook Page</a>
                    </div>            
                ';
            }




            echo'
        </div>
    </div>

    <div class="about DIV">
        <h3>About</h3>
        <p>
            '. $university_About .' 
        </p>
    </div>
</section>


    ';
}
?>
