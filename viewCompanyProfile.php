<?php 

require_once 'connection.php';


if(isset($_GET['company_id']) ){
    $company_id = $_GET['company_id'];

    $selectCompany = mysqli_query($conn,"SELECT * FROM company WHERE company_id='$company_id' ");

    $fetch_company = mysqli_fetch_assoc($selectCompany);


    $companyID=$fetch_company['company_id'];
    $company_Name=$fetch_company['company_Name'];
    $company_Email=$fetch_company['company_Email'];
    $company_PhoneNumber=$fetch_company['company_PhoneNumber'];
    $company_Logo=$fetch_company['company_Logo'];
    $company_Location=$fetch_company['company_Location'];
    $company_Website=$fetch_company['company_Website'];
    $company_Linkedin=$fetch_company['company_Linkedin'];
    $company_Twitter=$fetch_company['company_Twitter'];
    $company_Facebook=$fetch_company['company_Facebook'];
    $company_Instagram=$fetch_company['company_Instagram'];
    $company_About=$fetch_company['company_About'];

    echo'
 
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>'. $company_Name . '</title>
    </head>
    <body>
    
    
    
    
    
    <link rel="stylesheet" href="css/CompanyProfileStyle.css">
    <link rel="stylesheet" href="css/all-icon.css">
    <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" >
    

    <section class="companyProfileContainer">
        <div class="companyHeader">
    
            <div calss="companyLogo">
        
                <img src="images/companies_universities_images/'. $company_Logo .' " class="logoIMG" alt="">
        
                <h2>' . $company_Name . '</h2>
                ';
                if(!empty($company_Location)){ // if website link is set so will be display
                    echo'
                        <h5> <i class="fa-solid fa-location-dot"></i>' . $company_Location . '</h5>

                    ';
                }
                echo'
                



            </div>
    
        <div class="contactInformation DIV">
            <h3>Links</h3>
            ';
            if(!empty($company_Website)){ // if website link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fad fa-duotone fa-browser"></i>
                        <a href="'. $company_Website .' " target="_blank">Visit Website</a>
                    </div>
                ';
            }
            if(!empty($company_Linkedin)){ // if linkedin link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fa fa-brands fa-linkedin"></i>
                        <a href="'. $company_Linkedin .' " target="_blank">View linkedin Profile</a>
                    </div>
                ';
            }
            if(!empty($company_Instagram)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                        <i class="fa-brands fa-instagram"></i>
                        <a href=" '. $company_Instagram .' "target="_blank" >Follow Instagram Page</a>
                    </div>            
                ';
            }
            if(!empty($company_Twitter)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                    <i class="fa-brands fa-twitter"></i>
                    <a href=" '. $company_Twitter .' "target="_blank" > Follow on Twitter</a>
                    </div>            
                ';
            }
            if(!empty($company_Facebook)){ // if instagram link is set so will be display
                echo'
                    <div class="contactLinks" style="margin-top: 10px;">
                    <i class="fa-brands fa-facebook"></i>
                    <a href=" '. $company_Facebook .' "target="_blank" >View Facebook Page</a>
                    </div>            
                ';
            }




            echo'
        </div>
    </div>

    <div class="about DIV">
        <h3>About</h3>
        <p style="white-space: pre-line;">'. $company_About .' 
        </p>
    </div>
</section>


    ';
}
?>












<!-- 


        
</body>
</html>
