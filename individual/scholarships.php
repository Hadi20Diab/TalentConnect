<!-- <link rel="stylesheet" href="assets/css/courses_style.css"> -->
<?php 
  include "structural_IndividualPage.php";

?>
<script>
  document.getElementById("Scholarship-LeftBar").classList.add("actived");
</script>
<title>Scholarships</title>


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


















<div class="container" style="padding: 1rem;">
    <h1>
      <i class="fa-solid fa-graduation-cap fa-lg" style="     color: var(--switchers-main); "></i>
      Personalized Scholarship Suggestions
    </h1>
    <div class="scholarships">
        <!-- <div class="stack" id="">
            <a href="">
                <div class="stack-details" id="">
                    <h3>
                        Lorem ipsum dolor sit
                    </h3>
                    <div class="work-location">
                        <span class="fees">
                            <i class="fas fa-money-bill"></i>
                            asd
                        </span>
                        <span class="date">
                            <i class="fas fa-calendar"></i>
                            02/02/2022
                        </span>

                    </div>
                    <span class="see-details">See Details</span>
                </div>
            </a>
        </div>         -->
        



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
                echo "


                <div class=\"stack\" id=\"stack\">
                    <a href=\"scholarshipDetails.php?scholarshipId=".$row['scholarship_id']."\" target='_black'>
                        <div class=\"stack-details\" id=\"stack-details\">
                            <h3>
                                ". $row['scholarship_title']." 
                            </h3>
                            <div class=\"work-location\">
                                <span class=\"fees\">
                                    <i class=\"fas fa-money-bill\"></i>
                                    ".$row['award_amount']."
                                </span>
                                <span class=\"date\">
                                    <i class=\"fas fa-calendar\"></i>
                                    ".$row['application_deadline']."
                                </span>

                            </div>
                            <span class=\"see-details\">See Details</span>
                        </div>
                    </a>


                    ";
                    //bookmark
                    $scholarshipId= $row['scholarship_id'];
                    $bookmarkSql = "SELECT * FROM bookmarks WHERE user_ID = $individual_ID AND user_role = 'individual' AND scholarships_ID = " . $scholarshipId ;

                    // $bookmarkSql="SELECT * FROM bookmarks WHERE user_ID=$individual_ID AND user_role='individual' AND job_ID=$fetch_course['company_id'] ";
                    $bookmarkResult = mysqli_query($conn, $bookmarkSql);
                    $bookmarkCount=mysqli_num_rows($bookmarkResult);


                        if(!$bookmarkCount>0){ //is not saved before 
                            echo'
                                <a  class="addBookmark" href="../addRemoveBookmark.php?scholarships_ID='. $scholarshipId .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                    <i class="fa-regular fa-bookmark fa-2xl" ></i>
                                </a>
                                <a class="removeBookmark hide" href="../addRemoveBookmark.php?scholarships_ID='. $scholarshipId .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">
            
                                    <i class="fas fa-bookmark fa-2xl" ></i>
                                </a>
                            ';
                        }
                        else{ // is saved before 
                            echo'
                                <a  class="addBookmark hide" href="../addRemoveBookmark.php?scholarships_ID='. $scholarshipId .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                    <i class="fa-regular fa-bookmark fa-2xl" ></i>
                                </a>
                                <a class="removeBookmark" href="../addRemoveBookmark.php?scholarships_ID='. $scholarshipId .'&user_ID='. $individual_ID .'&user_role=individual" target="_black">

                                    <i class="fas fa-bookmark fa-2xl" ></i>
                                </a>
                            ';
                        }

                    // close stack div
                    echo"
                    </div> 
                    ";


                // $scholarshipId = $row['scholarship_id'];
                // $scholarshipTitle = $row['scholarship_title'];
                // $scholarshipDescription = $row['scholarship_description'];
                // // ...
                
                // echo '<div class="scholarship-card">';
                // echo '<h2>'.$scholarshipTitle.'</h2>';
                // echo '<p>'.$scholarshipDescription.'</p>';
                // echo '<a href="scholarship.php?id='.$scholarshipId.'">View Details</a>';
                // echo '</div>';
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
    transition: 0.5s;
}
.stack-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
    color: black;
}
.stack-details h3 {
    margin-bottom: 30px;
    line-height: 30px;
    height: 100px;
    height: 90px;
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
    transform: translate3d(-5px, -12px, 0px);
    box-shadow: 1px 1px 0 1px #f9f9fb, 0px -35px 19px 0px rgba(34, 33, 81, 0.01), 31px 34px 43px -10px rgba(34, 33, 81, 0.15);
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


.stack{
        position: relative;
    }
    
    .addBookmark, .removeBookmark{
        position: absolute;
        top: 5px;
        right: 5%;
        background-color: transparent;
        color: var(--nav-main);
    }
    .hide{
        display: none;
    }
    </style>




    <!-- script for Bookmarks add-remove -->
    <script>

        var addBookmarks = document.querySelectorAll('.addBookmark');
        var removeBookmarks = document.querySelectorAll('.removeBookmark');

        // Add event listener for each addBookmark button
        addBookmarks.forEach(function(addBookmark) {
        addBookmark.addEventListener('click', function() {
            var parent = this.parentElement;
            var removeBookmark = parent.querySelector('.removeBookmark');

            removeBookmark.style.display = 'block'; // Show the removeBookmark element
            this.style.display = 'none'; // Hide the addBookmark element
        });
        });

        // Add event listener for each removeBookmark button
        removeBookmarks.forEach(function(removeBookmark) {
        removeBookmark.addEventListener('click', function() {
            var parent = this.parentElement;
            var addBookmark = parent.querySelector('.addBookmark');

            addBookmark.style.display = 'block'; // Show the addBookmark element
            this.style.display = 'none'; // Hide the removeBookmark element
        });
        });

    </script>