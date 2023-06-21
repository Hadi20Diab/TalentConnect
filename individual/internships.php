<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";

?>
<script>
  document.getElementById("InternshipManagement-LeftBar").classList.add("actived");
</script>
<title>Internships</title>


<div class="cardBox">

  <a href="scholarships_search.php">

      <div class="card">
              <div>
                  <div class="cardName">Search </div>
              </div>

              <div class="iconBx">
                  <i class="fa fa-solid fa-magnifying-glass"></i>
                  <!-- <img src="https://cdn-icons-png.flaticon.com/512/4300/4300058.png" class="cardImgIcon" alt=""> -->
                  <!-- <ion-icon name="" class="fa-thin fa-buildings"></ion-icon> -->
              </div>
      </div>

  </a>

  <a href="savedInternship.php">
      <div class="card">

          <div>
              <div class="cardName">Saved </div>
          </div>

          <div class="iconBx">
            <i class="fa fa-bookmark"></i>
            <!-- <ion-icon name="storefront-outline"></ion-icon> -->
          </div>
      </div>

  </a>

</div>


















<div class="container" style="padding: 1rem;">
    <h1>
      <i class="fa-solid fa-hand-holding-dollar fa-lg" style="     color: var(--switchers-main); "></i>
      Personalized Internships Suggestions
    </h1>
    <div class="scholarships">
        
      <?php
        // Fetch all scholarships from the database
        // Query the database and fetch all scholarship records
        
        // Display each scholarship as a card

        // Fetch all scholarships from the database
        $sql = "SELECT * FROM internship";
        $result = $conn->query($sql);
        
        // Display each scholarship as a card
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "


                <div class=\"stack\" id=\"stack\">
                <a href=\"internshipDetails.php?internshipId=".$row['internship_ID']."\" target='_black'>
                    <div class=\"stack-details\" id=\"stack-details\">
                        <h3>
                            ". $row['internship_Title']." 
                        </h3>
                        <div class=\"work-location\">
                            <span>
                                <i class=\"fa fa-thin fa-briefcase\"></i>
                                ". $row['work']." 
                            </span>
                            <span>
                                <i class=\"fas fa-location-arrow\"></i>
                                ". $row['location']."  
                            </span>
                            <span>
                                <i class=\"fa fa-thin fa-stopwatch\"></i>
                                ". $row['commitment']." 
                            </span>
                            <span>
                              <i class=\"fa fa-solid fa-hourglass\"></i>
                              ".$row['period']."
                        </span>
                        </div>
                        <span class=\"see-details\">See Details</span>
                    </div>
                </a>
                </div>

                ";
            }
        }
      ?>
    </div>
  </div>

    <style>
/*  */
.scholarships{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 20px;
    margin-top: 30px;
}
.stack {
    width: 240px;
    padding: 25px 25px 10px 25px;
    border-radius: 5px;
    background-color: #eee;
}
.stack-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
    color: black;
}
.stack-details h3 {
    /* margin-bottom: 30px; */
    line-height: 30px;
    height: 100px;
    height: 80px;
}
.see-details {
    align-self: end;
    margin-bottom: 8px;
}
.work-location {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.work-location span {
    display: flex;
    align-items: center;
    gap: 10px;
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
    box-shadow: 1px 9px 10px #333;

}
.stack:hover .see-details {
    text-decoration: underline;
}
/*  */


        /* .container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
} */

h1 {
  color: #333;
}

.scholarships-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

/* .scholarship-card {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
} */

h2 {
  color: #333;
}

p {
  color: #666;
}

/* a {
  display: inline-block;
  margin-top: 10px;
  background-color: #3366cc;
  color: #fff;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
} */

/* a:hover {
  background-color: #204b99;
} */

    </style>