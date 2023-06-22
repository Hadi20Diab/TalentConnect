<?php 
  include "structural_IndividualPage.php";

?>
<section class="scholarships">

    <h1 class="heading">
        <!-- back button -->
        <a href="jobs.php"> 
            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: var(--nav-main);"></i>
        </a>
        Saved Jobs
    </h1>


<?php 


    $sql="SELECT * FROM bookmarks 
    LEFT JOIN jobs ON bookmarks.job_ID = jobs.job_id

    WHERE bookmarks.user_ID = $individual_ID AND bookmarks.user_role='individual' AND bookmarks.job_ID != 0";


    
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn));
    }

    if(!mysqli_num_rows($result)>0){
        echo"<p class='empty'>No saved Job Yet!</p>";
    }


    while ($row = $result->fetch_assoc()) {
        echo "

        <div class=\"stack\" id=\"stack\">
        <a href=\"../viewJob.php?job_id=".$row['job_id']."\" target='_black'>
            <div class=\"stack-details\" id=\"stack-details\">
                <h3>
                    ". $row['position']." 
                </h3>
                <div class=\"work-location\">
                    <span>
                        <i class=\"fa fa-thin fa-briefcase\"></i>
                        ". $row['jobType']." 
                    </span>
                    <span>
                        <i class=\"fas fa-location-arrow\"></i>
                        ". $row['job_Country'].' ('.$row['job_City'].')'."
                    </span>
                    <span>
                        <i class=\"fa fa-thin fa-stopwatch\"></i>
                        ". $row['job_WorkPlace']." 
                    </span>
                    <span>
                        <i class='fa-solid fa-money-bill'></i>
                      ".$row['salaryRange']."
                </span>
                </div>
                <span class=\"see-details\">See Details</span>
            </div>
        </a>
        

        ";


    $bookmarkSql = " SELECT * FROM bookmarks WHERE user_ID = $individual_ID AND user_role = 'individual' AND job_ID = $row[job_id] ";

    // $bookmarkSql="SELECT * FROM bookmarks WHERE user_ID=$individual_ID AND user_role='individual' AND job_ID=$row['company_id'] ";
    $bookmarkResult = mysqli_query($conn, $bookmarkSql);
    $bookmarkCount=mysqli_num_rows($bookmarkResult);

        if(!$bookmarkCount>0){ //is not saved before 
            echo'
                <a  class="addBookmark" href="../addRemoveBookmark.php?job_ID='. $row['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=add" target="_black">

                    <i class="fa-regular fa-bookmark fa-2xl" ></i>
                </a>
                <a class="removeBookmark hide" href="../addRemoveBookmark.php?job_ID='. $row['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=remove" target="_black">

                    <i class="fas fa-bookmark fa-2xl" ></i>
                </a>
            ';
        }
        else{ // is saved before 
            echo'
            <a  class="addBookmark hide" href="../addRemoveBookmark.php?job_ID='. $row['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=add" target="_black">

                <i class="fa-regular fa-bookmark fa-2xl" ></i>
            </a>
            <a class="removeBookmark" href="../addRemoveBookmark.php?job_ID='. $row['job_id'] .'&user_ID= '. $individual_ID .'&user_role=individual&status=remove" target="_black">

                <i class="fas fa-bookmark fa-2xl" ></i>
            </a>
        ';
        }//else
        
// close post DIV
    echo'
       </div> 
    ';

}
    


echo"</section>";
    // } 
    
    

?>




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






<style>
   /* .PostContainer{
        width: 80%;
        margin:3% 10%;
   } 
   .Post{
        padding: 15px;
        border-radius: 25px;
        background-color: #f3f2ef;
        box-shadow: 7px 7px 10px rgb(0 0 0 / 15%);
        margin: 30px 0px;

    }
   .postHeader , .postDetails{
        justify-content: space-between;
   }
   .postHeader, .postTitle, .postDetails{
        display: flex;
        flex-direction: row;
        align-items: center;
   }
   
   .postTitle img{
        width: 100px;
        margin-right: 15px;
    }

   .postDetails{
        margin: 20px 0px;
   }
   .postDetails a{
        background-color: var(--nav-main);
        color: white;
        padding: 5px;
        border-radius: 25px;
        transition: 0.5s ease-in-out;
    }
   .postDetails a:hover{
        scale: 1.15;
    } */

   .stack{
    position: relative;
   }
   .addBookmark, .removeBookmark{
    position: absolute;
    top: 1px;
    right: 5%;
    display: block;
    background-color: transparent;
    color: var(--nav-main);
    padding: 5px;
   }
   .hide{
    display:none;
   }
   .empty{
        position: absolute;
        top: 30%;
        left: 20%;
        width: 30%;
   }
</style>



    </div>
    <title>Saved Jobs</title>
    <script>
        document.getElementById("Job-LeftBar").classList.add("actived");
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

    /* width: 80%; */
        /* margin:3% 10%; */
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

    </style>

</body>

</html>