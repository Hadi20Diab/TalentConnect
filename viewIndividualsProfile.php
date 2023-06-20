<?php 

require_once 'connection.php';


if(isset($_GET['individual_ID']) ){
    $individual_ID = $_GET['individual_ID'];

    $selectIndividual = mysqli_query($conn,"SELECT * FROM individuals WHERE individual_ID='$individual_ID' ");

    $fetch_Individual = mysqli_fetch_assoc($selectIndividual);


    $universityID=$fetch_Individual['individual_ID'];
    $individual_Name=$fetch_Individual['individual_Name'];
    $individual_Email=$fetch_Individual['individual_Email'];
    $individual_PhoneNumber=$fetch_Individual['individual_PhoneNumber'];
    $individual_photo=$fetch_Individual['individual_photo'];
    $individual_Country=$fetch_Individual['individual_Country'];
    $individual_About=$fetch_Individual['individual_About'];
    $individual_Linkedin=$fetch_Individual['individual_Linkedin'];
    echo'
 
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>'. $individual_Name . '</title>
    </head>
    <body>
    
    
    
    <!--  
    <link rel="stylesheet" href="css/universityProfileStyle.css">
    -->
    
    <link rel="stylesheet" href="css/CompanyProfileStyle.css">
    <link rel="stylesheet" href="css/all-icon.css">
    
    
    <section class="companyProfileContainer">
        <div class="companyHeader">
    
            <div calss="companyLogo">
        
                <img src="images/individuals_images/'. $individual_photo .' " class="logoIMG" alt="">
        
                <h2>' . $individual_Name . '</h2>
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
            if(!empty($individual_Linkedin)){ // if linkedin link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fa fa-brands fa-linkedin"></i>
                        <a href="'. $individual_Linkedin .' " target="_blank">View linkedin Profile</a>
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
        <p style="white-space: pre-line;">'. $individual_About .' 
        </p>
    </div>
</section>


    ';
}
?>
