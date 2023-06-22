<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

        

        <?php
            
            require_once '../connection.php';
            $id= $_GET['scholarshipId'];
            $query = "SELECT * From scholarships where scholarship_id=".$id."";
            $result = mysqli_query($conn,$query);
            $row= mysqli_fetch_assoc($result);

            $qUniversityName= "SELECT university_Name,contact_email From universities where university_ID=".$row['provider_Id']."";
            $resultUniversityName = mysqli_query($conn,$qUniversityName);
            $rUniversity= mysqli_fetch_assoc($resultUniversityName);
            $UniversityName=$rUniversity['university_Name'];
            $UniversityContactEmail=$rUniversity['contact_email'];
            echo "
                <title>Scholarships in ".$row['scholarship_title']."</title>
            ";
        ?>
<style>
@media (min-width: 992px){
    .container {
        width: calc(100% - 50px);
        margin: 0 auto;  
    }
}
.scholarship-details-intro{
    margin: 30px 0px 30px;
    display: flex;
    justify-content: space-between;

}
.scholarship-details-intro-left {
    width: 60%;
}
.scholarship-details-intro-left p{
    line-height: 30px;
    padding: 10px 10px 0px 0px;
}
.scholarship-details-intro-right {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 25px;
    height: 100px;
}
.scholarship-details-intro-right a{
    font-size: 19px;
    margin-top: 6px;
    align-self: center;
    text-decoration: none;
    color: white;
    background-color: black;
    padding: 6px;
    border-radius: 13px;
}
.scholarship-details-intro-right span{
    font-size: 19px;
}
@media (max-width: 768px) {
    .scholarship-details-intro{
        text-align: center;
        flex-direction: column;
        gap: 20px;
    }
    .scholarship-details-intro-left {
        width: 100%;
    }

    .scholarship-details-intro-right div{
        margin-bottom: 15px;
    }

}

.scholarship-details-intro-data{
    width: 74%;
}
.scholarship-details-intro-data h2{
    margin-bottom: 5px;
}
.scholarship-details-intro-data p{
    line-height: 30px;
    width: calc(80% - 10px);
}

@media (max-width: 768px) {
    .scholarship-details-intro-data{
        text-align: center;
    }
    .scholarship-details-intro-data p{
        width: 100%;
    }
}
ul.t1 {
    list-style: disc;
}
ul.t1 li{
    margin: 17px 0px;
}
.scholarship-details-intro-data div ul{
    /* padding: 10px; */
}

.scholarship-details-intro-data h2 {
    margin: 30px 0px 8px;
}


/*  */
.scholarship-details-intro-left.dark {
    color: white;
}
.scholarship-details-intro-right.dark {
    color: white;
}
.scholarship-details-intro-data.dark{
    color: white;
}

        </style>
    </head>
    <body>
        <?php
            echo "
            <div class=\"scholarship-details\">
                <div class=\"container\">
                    <div class=\"scholarship-details-intro\">
                        <div class=\"scholarship-details-intro-left\" id=\"s_details\">
                            <h1>
                                ".$row['scholarship_title']."
                            </h1>
                            <p>
                                ".$row['scholarship_description']."
                            </p>
                        </div>
                        <div class=\"scholarship-details-intro-right\" id=\"s_details\" >
                            <div>
                                <span>
                                    <i class=\"fa fa-solid fa-person-sign fa-lg\"></i>
                                    ".$UniversityName."
                                </span>
                            </div>
                            <div>
                                <span>
                                    <i class=\"fas fa-money-bill\"></i>
                                    ".$row['award_amount']."
                                </span>
                            </div>
                            <div>
                                <span>
                                    <i class=\"fa fa-solid fa-graduation-cap\"></i>
                                    ".$row['scholarship_Degree']." Degree
                                </span>
                            </div>
                            <div>
                                <span>
                                    <i class=\"fas fa-calendar\"></i>
                                    ".$row['application_deadline']."
                                </span>
                            </div>
                            <a href=\"".$row['application_link']."\" target=\"_blank\" >Apply Now</a>
                        </div>
                    </div>
                    <div class=\"scholarship-details-intro-data\" id=\"s_details\">
                        <h2>Eligibility Criteria</h2>
                            
                        <p>
                                <ul class=\"t1\" id=\"q\">
                                        "
                                        .
                                        $row['eligibility_criteria'].
                                        "
                                </ul>
                            
                        </p>
                        <h2>Additional Requirements</h2>
                        <p>
                                <ul class=\"t1\" id=\"q\">
                                    "
                                    .
                                    $row['additional_requirements'].
                                    "
                                </ul>
                        </p>
                        <p style=\" margin-top:30px;\">
                            <span style=\"font-weight: bold;\">Contact Email: </span>
                            <a href=\"mailto: ".$UniversityContactEmail." \" style=\"\">
                                ".$UniversityContactEmail."
                            </a>
                        </p>
                        
                    </div>
                </div>
            </div>

            ";
            echo '
            <script>
                var target= document.querySelectorAll("ul");
                var str;	
                for(var i=0;i<target.length;i++){
                    str= target[i].innerHTML;
                    if(target[i].id=="q"){
                    var arr = str.split("*");
                        var final="<li>";
                            for (let i = 0; i < arr.length; i++) {
                        
                                final+=arr[i];
                                if(i==arr.length-1){
                                    break;
                                } 
                                final+="</li><li>";
                            
                            } //end for
                        target[i].innerHTML=final;
            
                        }
            
                    }   
            </script>';
        ?>
    </body>
</html>
