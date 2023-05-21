<?php 

require_once '../connection.php';


if(isset($_GET['vcid']) && isset($_GET['cname'])){
    $vcid = $_GET['vcid'];
    $cname = $_GET['cname'];

    $selectCompany = mysqli_query($conn,"SELECT * FROM company WHERE company_id='$vcid' ");

    $fetch_company = mysqli_fetch_assoc($selectCompany);



    $companyID=$fetch_company['company_id'];
    $company_Name=$fetch_company['company_Name'];
    $company_Email=$fetch_company['company_Email'];
    $company_PhoneNumber=$fetch_company['company_PhoneNumber'];
    $company_Logo=$fetch_company['company_Logo'];
    $company_Website=$fetch_company['company_Website'];
    $company_Linkedin=$fetch_company['company_Linkedin'];
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
    
    
    
    
    
    <link rel="stylesheet" href="CompanyProfileStyle.css">
    <link rel="stylesheet" href="../css/all_icon.css">
    
    
    <section class="companyProfileContainer">
        <div class="companyHeader">
    
            <div calss="companyLogo">
        
                <img src="assets/imgs/ '. $company_Website .' " class="logoIMG" alt="">
        
                <h2>' . $company_Name . '</h2>



            </div>
    
        <div class="contactInformation DIV">
            <h3>Contact</h3>
            <div class="contactLinks" style="margin-top: 10px;">
                <i class="fad fa-duotone fa-browser"></i>
                <a href="https://'. $company_Website .' " target="_blank">Visit Website</a>
            </div>
            
            <div class="contactLinks" style="margin-top: 10px;">
                <i class="fa fa-brands fa-linkedin"></i>
                <a href="https://'. $company_Linkedin .' " target="_blank">View linkedin Profile</a>
            </div>

            <div class="contactLinks" style="margin-top: 10px;">
                <i class="fa-brands fa-instagram"></i>
                <a href="tel:+'. $company_Linkedin .' "> Call us: '. $company_PhoneNumber .' </a>
            </div>
        </div>
    </div>

    <div class="about DIV">
        <h3>About</h3>
        <p>
            '. $company_About .' 
        </p>
    </div>
</section>


    ';
}
?>












<!-- 


        
</body>
</html>
