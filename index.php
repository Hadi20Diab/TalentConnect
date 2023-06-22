<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
        <link rel="stylesheet" href="individual/assets/css/style.css">
        <link rel="stylesheet" href="individual/assets/css/empty.css">
        <link rel="stylesheet" href="individual/assets/css/profile.css">
        <link rel="stylesheet" href="individual/assets/css/dark.css">
        <link rel="stylesheet" href="individual/assets/css/alert.css">
        <link rel="stylesheet" href="individual/assets/css/customers.css">
        <link rel="stylesheet" href="individual/assets/css/navbar.css">
        <link rel="stylesheet" href="individual/assets/css/commonStyle.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
        <title>Talent Connect</title>
        <style>
    /* :root {
        var(--white): #eee;
    } */

.navigation ul li a.actived::before,
.navigation ul li a.actived::before{
  content: "";
  position: absolute;
  right: 0;
  top: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px 35px 0 10px var(--white);
  pointer-events: none;
}
.navigation ul li a.actived::after,
.navigation ul li a.actived::after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px -35px 0 10px var(--white);
  pointer-events: none;
}

.navigation ul li a.actived {
  color: var(--nav-main);
  background-color: var(--white);
}

input{
    text-indent: 10px;
}


.actived .icon img{
    filter: invert(0);
}
    </style>
    </head>
<body>
    <div class="container0">
        <div class="navigation">
                        <ul>
                            <li>
                                <a href="index.php" >
        
                                    <span class="title" style="font-weight:600 ; font-size:25px; display: flex;     padding-top: 2px;     margin-left: -13px;">
                                        <img src="individual/assets/imgs/talentConnectLOGO.png" style="height: 100%; filter: invert(0.9);" alt="">
                                        TalentConnect
                                    </span>
                                </a>
                                <div class="">

                                </div>
                            </li>
        
                            <li>
                                <a href="index.php" id="Dashboard-LeftBar">
                                    <span class="icon">
                                        <!-- <i class="fa-sharp fa-solid fa-house fa-2xl"></i> -->
                                        <i class="fa-solid fa-house fa-2xl"></i>
                                        
                                        <!-- <ion-icon name="home-outline"></ion-icon> -->
                                    </span>
                                    <span class="title">Home</span>
                                </a>
                            </li>
                            
                            <!-- <li>
                                <a href="customers.php" id="UserManagement-LeftBar">
                                    <span class="icon">
                                        <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/1570/1570102.png" alt="">
        
                                        <ion-icon name="people-outline" class="fa-light fa-bars-progress"></ion-icon>
                                    </span>
                                    <span class="title">User Management</span>
                                </a>
                            </li> -->
        
                            <li>
                                <a href="individual/courses.php" id="Courses-LeftBar">
                                    <span class="icon">
                                        <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/2832/2832673.png" alt="">
                                        <!-- <ion-icon name="storefront-outline"></ion-icon> -->
                                    </span>
                                    <span class="title">Courses</span>
                                </a>
                            </li>
        
                            <li>
                                <a href="individual/scholarships.php" id="Scholarship-LeftBar">
                                    <span class="icon">
                                        <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8920/8920733.png" alt="">
                                        <!-- <ion-icon name="grid-outline"></ion-icon> -->
                                    </span>
                                    <span class="title">Scholarships</span>
                                </a>
                            </li>
        
                            <li>
                                <a href="individual/internships.php" id="InternshipManagement-LeftBar">
                                    <span class="icon">
                                        <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8920/8920564.png" alt="">
                                        <!-- <i class="fa-solid fa-truck"></i> -->
                                    </span>
                                    <span class="title">Internships</span>
                                </a>
                            </li>
        
                            <li>
                                <a href="individual/jobs.php" id="Job-LeftBar">
                                    <span class="icon">
                                        <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8388/8388689.png" alt="">
                                        <!-- <ion-icon name="fast-food-outline"></ion-icon> -->
                                    </span>
                                    <span class="title">Jobs</span>
                                </a>
                            </li>
        
                            <li>
                                <a href="userRegistration.php" id="Job-LeftBar">
                                    <span class="icon">
                                        <!-- <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8388/8388689.png" alt=""> -->
                                        <!-- <ion-icon name="fast-food-outline"></ion-icon> -->
                                        <i class="fa-solid fa-right-to-bracket fa-lg"></i>
                                    </span>
                                    <span class="title">Login/ Signup</span>
                                </a>
                            </li>
                        </ul>
                    </div><!-- end navigation -->
        <div class="rightSide">

            <div class="description" id="description">
                <div class="container con-description">
                    <div class="description-content">
                        <div class="image">
                            <img src="images/High-school-students.jpg" alt="">
                        </div>
                        <div class="text">
                            <h3 class="welcome" id="welcome"></h3>
                            <h3>The platform with excellent opportunities network</h3>
                            <p>Talent Connect is a diverse forum where people aspiring to pursue higher studies or polishing their educational and professional skills can find all the requisite websites links, scholarship programs, fellowships, exchange programs, conferences, Summer Programs, Entrepreneurial Events, Internships, workshops symposium, and pieces of information, guidelines and procedures.</p>
                        </div>
                    </div>
                </div>
            </div><!-- end description -->
        
            <!-- Start Last Opportunities -->
                <div class="last-oppor">
                    <div class="container">
                        <h2 id="last-oppor-h2">Last Opportunities in Lebanon</h2>
                        <div class="opportunities-content">
                            <!-- Lebanon -->
                            <?php
                                require_once 'connection.php';
                                $query = "SELECT * From scholarships where scholarship_country='Lebanon' ORDER BY scholarship_id DESC";
                                $result = mysqli_query($conn,$query);
                                if (!$result) die ("Database access failed: " . mysqli_error());
                                // else echo "pass";
                                // $row= mysqli_fetch_row($result);
                                
                                for($j=1; $j<7;++$j){
                                    $row= mysqli_fetch_assoc($result);
                                    echo "
                                    <div class=\"stack\" id=\"last-oppor-stack\">
                                        <a href=\"individual/scholarshipDetails.php?scholarshipId=".$row['scholarship_id']."\">
                                            <div class=\"stack-details\" id=\"stack-details\">
                                                <h3>" . $row['scholarship_title']." </h3>
                                                <div class=\"fees\">
                                                    <span>
                                                        <i class=\"fas fa-money-bill\"></i>"." ".
                                                        $row['award_amount']."
                                                    </span>
                                                </div>
                                                <div class=\"date\">
                                                    <span>
                                                        <i class=\"fas fa-calendar\"></i>"." "." ".
                                                        $row['application_deadline']."
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    ";
                                }//end for loop
                            ?>
                            <!-- <div class="stack">
                                <a href="">
                                    <div class="stack-details">
                                        <h3>School of Management: Developing Futures Scholarships 2022</h3>
                                        
                                        <div class="fees">
                                            <span>
                                                <i class="fas fa-money-bill"></i>
                                                $1000
                                            </span>
                                        </div>
                                        <div class="date">
                                            <span>
                                                <i class="fas fa-calendar"></i>
                                                1 July 2022
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div> 
            <!-- End Last Opportunities -->
    <!-- Start Most Popular Countries -->
    <div class="popular-coun">
        <div class="container">
            <h2 id="popular-coun-title">Most Popular Countries</h2>
            <div class="popular-cont-content">
                <div class="country">
                    <a href="">
                        <div class="image">
                            <img src="https://img2.storyblok.com/400x400/f/45556/1500x1000/599c7ecaca/photo-1504913659239-6abc87875a63.jpeg" alt="">
                        </div>
                        <div class="text">
                            <span>Scholarship in</span>
                            
                            <span>United States</span>
                        </div>
                    </a>
                </div>
                <div class="country">
                    <a href="">
                        <div class="image">
                            <img src="https://img2.storyblok.com/400x400/f/45556/1510x1000/7bb034177a/photo-1529955169862-51fc083b42dc.jpeg" alt="">
                        </div>
                        <div class="text">
                            <span>Scholarship in</span>
                            
                            <span>United Kingdom</span>
                        </div>
                    </a>
                </div>
                <div class="country">
                    <a href="">
                        <div class="image">
                            <img src="https://img2.storyblok.com/400x400/f/45556/1500x1000/5c77b3382d/photo-1534352267890-0c7d8e0630bb.jpeg" alt="">
                        </div>
                        <div class="text">
                            <span>Scholarship in</span>
                            
                            <span>Netherlands</span>
                        </div>
                    </a>
                </div>
                <div class="country">
                    <a href="">
                        <div class="image">
                            <img src="https://img2.storyblok.com/400x400/f/45556/1500x1000/17ec9c3c35/photo-1497030855747-0fc424f89a4b.jpeg" alt="">
                        </div>
                        <div class="text">
                            <span>Scholarship in</span>
                            
                            <span>Germany</span>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    <!-- End Most Popular Countries -->
        </div> <!-- end RightSide -->
    </div><!-- end container0 -->
</body>
<style>
    :root{
    /* --main-color: #19c8fa; */
    /* #1f1f1f */
    --main-transition: 0.5s;

    --main-color: #03dac6;
    --main-dark: #212121;
    --second-dark: #1f1f1f;

    --dark-text: #7e7e7e;
}
.rightSide{
    width: calc(100% - 325px);
    transform: translateX(312.5px);
}
/* Start Description */
.description{
    /* min-height: 100vh; */
    /* background-color: #1f2021; */
    /* background-image: url("../images/landing.jpg"); */
    background-size: cover;
    position: relative;
    /* height: calc(100vh - 97px); */
    background: linear-gradient(-90deg,rgba(35,130,219,.9),rgba(59,239,215,.9))!important;
    display: flex;
    align-content: center;
    /* flex-wrap: wrap; */
    margin-bottom: 30px;
    transition: var(--main-transition);
    
    
    padding: 0px 5px 29px;
}
.description .con-description{
    display: flex;
    align-items: center;
}
.description .image{
    position: relative;
    width: 350px;
    transition: var(--main-transition);
    margin-left: 20px;
}
.description .image img{
    max-width: 100%;
    transition: var(--main-transition);
}
.description .description-content{
    display: flex;
    /* flex-wrap: wrap; */
    justify-content: space-between;
    transition: var(--main-transition);
    align-items: center;
    padding-top: 30px;
}
.description .text{
    flex-basis: calc(100% - 500px);
    align-content: space-between;
    display: flex;
    align-items: start;
    flex-direction: column;
    justify-content: center;
    transition: var(--main-transition);
    /* width: 80%; */
    /* width: 324.72px; */
}

.description .text h3{
    color: #fff;
    margin: 10px 0px 26px;
    font-size: 26px;
    line-height: 34px;
    font-weight: 600;
	/*height: 30px;*/
    
}
.description .text .welcome{
    font-size: 20px;
    line-height: 30px;
    white-space: nowrap;
    overflow: hidden;
    animation: control 3s 2s both, blink 0.5s infinite;
    border-right: 2px solid #fff;
    /* width: fit-content; */
}
/* @keyframes control {
    from{
        width: 0px;
    }
    to{
        width: 200px;
    }
} */
@keyframes blink {
    from{
        border-right-color: #fff;
    }
    to{
        border-right-color: transparent;
    }
}
.description .text p{
    color: white;
    line-height: 24px;
}
/*  */
@media  (max-width: 768px)  {
    .description .image{
        width: 250px;
        align-self: center;
    }
    .description{
        align-content: start;
        text-align: center;
    }  
    .description .description-content{
        justify-content: center;
        flex-direction: column;
    }  
    .description .text{
        flex-direction: column;
        flex-basis: calc(100% - 160px);
        align-items: center;
        
    }
    .description .text h3{
        margin: 5px 0px 15px;
    }
    .description .text h3:nth-child(2){
        font-size: 25px;
    }
 }
 /*  */
 @media  (min-width: 769px) and  (max-width: 991px) {
    .description .description-content{
        align-items: center;
        gap: 61px;
    }
    .description .image{
        width: 290px;
    }
    .description .text {
        flex-direction: column;
        flex-basis: calc(100% - 300px);
        /* align-items: center; */
    }

 }
/*  */
@media  (max-width: 505px)  {
    .description .image{
        width: 150px;
        align-self: center;
    }
    .description .text p{
        font-size: 15px;
    }
    .description .text h3{
        font-size: 15px;
        margin: 2px 0px 10px;
    }
    .description .text h3:nth-child(2){
        font-size: 19px;
    }
}
/* End Description */
/* Start Last Opportunities */
.last-oppor h2{
    text-align: center;
    color: black;
    font-weight: 700;
    font-size: 30px;
    margin: 50px 0px 20px;
}
.last-oppor a{
    text-decoration: none;
    color: #000;
}
.last-oppor a:visited{
    color: transparent;
}
.last-oppor .fees,
.last-oppor .date{
    font-size: 19px;
}
.stack-details h3{
    margin-bottom: 30px;
    line-height: 30px;
    height: 90px;
}

.stack-details .fees,
.stack-details .date {
    width: -moz-fit-content;
    width: fit-content;
    padding: 6px 14px;
    transition: 0.5s;
    border-radius: 20px;
    outline: 1px solid #4444;
    margin-bottom: 8px;
}

 .stack:hover{
    transform: translate3d(-5px, -12px, 0px);
    box-shadow: 1px 1px 0 1px #f9f9fb, 0px -35px 19px 0px rgba(34, 33, 81, 0.01), 31px 34px 43px -10px rgba(34, 33, 81, 0.15);  

}
.stack:hover .see-details {
    text-decoration: underline;
}
/* .last-oppor span{
    
} */

.last-oppor .opportunities-content{
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fill , minmax(300px,1fr));
}
.stack {
    background-color: #eee;
    padding: 25px;
    border-radius: 5px;
    transition: 0.5s;
}

/* End Last Opportunties */
/* Start Popular Conutries */
.popular-coun{
    margin-top: 100px;
}
.popular-coun h2{
    text-align: center;
    color: black;
    font-weight: 700;
    font-size: 30px;
    margin: 50px 0px 20px;
}
.popular-cont-content{
    display: flex;
    gap: 20px;
    justify-content: space-around;
    /* align-content: center; */
    flex-wrap: wrap;
}
@media (min-width: 640px) {
    .popular-coun .popular-cont-content .country{
        text-align: center;
    }
}

.popular-coun .country{
    text-align: center;
    
}
.popular-coun .country:hover >a .text span:nth-child(2){
    text-decoration: underline;
}
.popular-coun .country a:visited{
    color: black;

}
.popular-coun .country .image{
    width: 195px;
    display: block;
}
.popular-coun .country .image img{
    max-width: 100%;
}
.popular-coun .text span{
    display: block;
    margin: 5px 0px;
}
.popular-coun .text span:nth-child(1){
    color: gray;
}
.popular-coun .text span:nth-child(2){
    font-weight: 500;
    font-size: 22px;
}

/* End Popular Countries */
</style>
<script>
    var i=0, text;
text="Welcome to Talent Connect";

function typing() { 
    if(i<text.length ){
        document.getElementById("welcome").innerHTML += text.charAt(i);
        i++;
        setTimeout(typing,100);
    }
}
typing();
</script>
</html>