<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";

?>



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

  <a href="savedScholarships.php">
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


















<div class="container">
    <h1>
        <i class="fa-solid fa-hand-holding-dollar fa-lg" style="     color: var(--switchers-main); "></i>
        Scholarships
    </h1>
    <div class="scholarships-list">
      <?php
        // Fetch all scholarships from the database
        // Query the database and fetch all scholarship records
        
        // Display each scholarship as a card

        // Fetch all scholarships from the database
        $sql = "SELECT * FROM scholarships";
        $result = $conn->query($sql);
        
        // Display each scholarship as a card
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $scholarshipId = $row['scholarship_id'];
                $scholarshipTitle = $row['scholarship_title'];
                $scholarshipDescription = $row['scholarship_description'];
                // ...
                
                echo '<div class="scholarship-card">';
                echo '<h2>'.$scholarshipTitle.'</h2>';
                echo '<p>'.$scholarshipDescription.'</p>';
                echo '<a href="scholarship.php?id='.$scholarshipId.'">View Details</a>';
                echo '</div>';
            }
        }
      ?>
    </div>
  </div>
    <style>
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