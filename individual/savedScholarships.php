<?php 
  include "structural_IndividualPage.php";

?>

<section class="courses">
    <h1 class="heading">
        <!-- back button -->
        <a href="scholarships.php"> 
            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: var(--nav-main);"></i>
        </a>
        Saved Scholarships
    </h1>

    <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
        <i class="fa fa-solid fa-magnifying-glass"></i>
        <input type="text" name="" id="search-item" placeholder="Search By Scholarship Name" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
    </div>

    <div class="box-container">
        



<?php
    $sql="SELECT * FROM bookmarks 
    LEFT JOIN scholarships ON bookmarks.scholarships_ID = scholarships.scholarship_id
    
    WHERE bookmarks.user_ID = $individual_ID AND bookmarks.user_role='individual' AND bookmarks.scholarships_ID != 0";


    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn));
    }
    
    if(!mysqli_num_rows($result)>0){
        echo"<p class='empty'>No saved Scholarships Yet!</p>";
    }





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
            }
        }
      ?>
    </div>
  </div>







<style>

    .courses{
        padding: 25px;
    }
    .box-container{
        /* display: flex;
        flex-wrap: wrap;
        justify-content: space-between; */

        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, 21.5rem);
        gap: 1.5rem;
        justify-content: center;
        align-items: stretch;
    }
    /* .box{
        border-radius: 0.5rem;
        background-color: #eee;
        padding: 2rem;
    }
    .box .course_Creator{
        margin-bottom: 0.5rem;
        display: flex;
        align-items: stretch;
        gap: 2rem;
    }
    .box .course_Creator img{

        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.5rem;
    }
    .coursePhoto{
        width: 100%;
        border-radius: 0.5rem;
        height: 10rem;
        object-fit: cover;
        margin-bottom: 1rem;
    }
    .viewCourseBtn{
        background-color: var(--nav-main);
        color: white;
        display: inline-block;
        border-radius: 0.5rem;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        /* margin-top: 1rem; 
        text-transform: capitalize;
        cursor: pointer;
        text-align: center;
    } */
    .box{
        position: relative;
    }
    .hide{
        display: none;
    }
    .addBookmark, .removeBookmark{
        position: absolute;
        top: 5px;
        right: 5%;
        background-color: transparent;
        color: var(--nav-main);
    }

    .empty{
        position: absolute;
        top: 30%;
        left: 20%;
        width: 30%;
   }


</style>
<link rel="stylesheet" href="../css/all_icon.css">
<!-- select search script  -->
<script>
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
          });
       });
</script>







    </div>
    <title>Search courses</title>

    <!-- Script Search Bar -->

    <script type="text/javascript">
        function pendingCompanySearch() {
            let filter = document.getElementById('search-item').value.toUpperCase();
            let singleROW = document.querySelectorAll('#stack');
            let l = document.getElementsByTagName('h3'); // Scholarship Name
            
            for(var i = 0; i<=l.length ;i++){
                let match=singleROW[i].getElementsByTagName('h3')[0];
                let value=match.innerHTML || match.innerText || match.textContent;
                
                
                if(value.toUpperCase().indexOf(filter) > -1) {
                    singleROW[i].style.display="";
                }
                else
                {
                    singleROW[i].style.display="none";
                }
            }
        }
    </script>


    <script>
        document.getElementById("Scholarship-LeftBar").classList.add("actived");

        //  script for Bookmarks add-remove 

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
</body>

</html>