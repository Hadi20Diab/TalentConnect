<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
<?php
        require_once '../connection.php';
        $id= $_GET['internshipId'];
        $query = "SELECT * From internship where internship_ID=".$id."";
        $result = mysqli_query($conn,$query);
        $row= mysqli_fetch_assoc($result);
            $qCompanyName= "SELECT company_Name From company where company_id=".$row['publisher_Id']."";
            $resultCompanyName = mysqli_query($conn,$qCompanyName);
            $CompanyName= mysqli_fetch_assoc($resultCompanyName);
            $publisherName=$CompanyName['company_Name'];

            if(!$resultCompanyName){
                $qCompanyName= "SELECT university_Name From universities where university_ID=".$row['publisher_Id']."";
                $resultCompanyName = mysqli_query($conn,$qCompanyName);
                $CompanyName= mysqli_fetch_assoc($resultCompanyName);
                $publisherName=$CompanyName['university_Name'];

            }
        echo "
            <title>".$row['internship_Title']."</title>
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
    gap: 15px;
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
.scholarship-details-intro-right span {
    display: flex;
    align-items: center;
    gap: 10px;
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
                                ".$row['internship_Title']."
                                </h1>
                                <p>
                                ".$row['description']."
                                </p>
                            </div>
                            <div class=\"scholarship-details-intro-right\" id=\"s_details\">
                                <div>
                                    <span>
                                        <i class=\"fa fa-solid fa-person-sign fa-lg\"></i>
                                        ".$publisherName."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fas fa-money-bill\"></i>
                                        ".$row['fees']."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fa fa-thin fa-briefcase\"></i>
                                        ".$row['commitment']."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fa fa-thin fa-stopwatch\"></i>
                                        ".$row['work']."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fa fa-solid fa-hourglass\"></i>
                                        ".$row['period']."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fas fa-calendar\"></i>
                                        ".$row['application_deadline']."
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <i class=\"fas fa-location-arrow\"></i>
                                        ".$row['location']."
                                    </span>
                                </div>
                                <a href=\"".$row['applyLink']."\" target=\"_blank\" >Apply Now</a>
                            </div>
                        </div>
                        <div class=\"scholarship-details-intro-data\" id=\"s_details\">

                            <div>
                                <h2>
                                    Requirments
                                </h2> 
                                <ul class=\"t1\" id=\"q\">
                                    "
                                    .
                                    $row['requirements'].
                                    "
                                </ul>
                            </div>
                            <div>
                                <h2>
                                    Qualifications
                                </h2> 
                                <ul class=\"t1\" id=\"q\"> "
                                    .
                                    $row['qualifications'].
                                    "
                                </ul>
                            </div>

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