<?php 

include "structuralAdminPage.php";

?>
    <title>Feedback and Suggestions</title>
    <script>
        document.getElementById("Feedback-LeftBar").classList.add("actived");
    </script>

<head>
    <style>
     .empty{
  
  color: var(--black);
  
  background-image: linear-gradient(to bottom, var(--nav-main), rgb(255, 255, 255));
   
  
 }  
.choice-btn{
    padding: 0.7rem;
    width: 30px;
    border-radius: 10px;
    color: #fff;
    font-weight: 400;
    font-size: large;
    background-color: var(--nav-main);
    
    transition: 1s ease;
    margin-left:2rem;
    box-shadow: 0 5px 10px rgba(0,0,0,0.7);
}
.yes:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: #39ff14;
}
.no:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: red;
}


   .details{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
  }
    .foods-btn{
        background-color:#ffd700;
        color: var(--white);
        border-radius: 10px;
        text-decoration: none;
        width: 11rem;
        padding: 0.7rem;
        font-weight: 400;
        font-size: large;
        border: none;
        transition: 0.5s ease;
    }
    .foods-btn:hover{
      
      letter-spacing: 0.4rem;
      width: 13rem;
      cursor: pointer;

    }
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
    .textarea-message{
        border: none;
        resize: none;
    }
    .textarea-message:focus{
        outline: none;
    }
    tr:hover .textarea-message{
        color: inherit;
        background-color: inherit;

    }
    .textarea-message::-webkit-scrollbar {
        width: 5px;
    }
    /* Track */
    .textarea-message::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 10px;
    }
    /* Handle */
    .textarea-message::-webkit-scrollbar-thumb {
      background: #3e3e3e;
      border-radius: 10px;
    }    
    </style>
</head>


           
            <!-- ================ pending companies List ================= -->
            <div class="details">
                            <style>
                                /* .scroll{
                                    overflow: scroll;
                                } */
                                .scroll::--webkit-scrollbar{
                                    display:none;
                                }
                            </style>

                <?php
                   $select_courses = mysqli_query($conn, "SELECT * FROM feedback ");
                   $courses_count = mysqli_num_rows($select_courses);



                   echo '
                        <div class="recentOrders scroll">
        
                            <table >
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Email</td>
                                    <td>Message</td>
                                    <td>Status</td>
                                </tr>

                                </thead>
                   ';


                   if ($courses_count >0) {
                ?>

                        <!-- Search Bar -->
                        
                        <tbody id="containerpendingROW">
                            
                                <div style="    display: flex;     flex-direction: row;     width: 50%;     margin: 0 25%;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                    <i class="fa fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="" id="search-item" placeholder="Search By Email" onkeyup="pendingCompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
                                </div>




                            <form action="" method="post">
                        <?php
                                $number = 0;
                             
                                while ($fetch_pending_companies = mysqli_fetch_assoc($select_courses)) {
                                    $number +=1; 
                                    $rid = $fetch_pending_companies['feedback_id'];

                                    
                        ?>
                            <tr id="singleROW">
                                <td><?= $number ?></td>
                                <td class="companyName">
                                    <p>
                                        <?= $fetch_pending_companies['feedback_email']; ?>
                                </p>
                                </td>
                                <td>
                                    <textarea 
                                        rows="10" 
                                        cols="60" 
                                        readonly 
                                        class="textarea-message" 
                                        ><?= $fetch_pending_companies['feedback_message']; ?></textarea>
                                    </td>
                                <td><?= $fetch_pending_companies['feedback_status']; ?></td>
                            </tr>
                            <!-- Script Search Bar -->

                            <script type="text/javascript">
                                function pendingCompanySearch() {
                                    let filter = document.getElementById('search-item').value.toUpperCase();
                                    let singleROW = document.querySelectorAll('#singleROW');
                                    let l = document.getElementsByTagName('p');
                                    
                                    for(var i = 0; i<=l.length ;i++){
                                        let match=singleROW[i].getElementsByTagName('p')[0];
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


                       <?php
                                  }
                                
                             ?>

                            </form>
                        </tbody>
                    </table>
                </div>
            <?php
                }
                else{
                echo '</table>
                <p class="empty" style="width: fit-content; margin-bottom: 19%;">
                    No Courses Yet!
                </p>';
                }
            ?>
                
            </div>
        </div>
    </div>












</div>
    <title>Courses</title>
    <script>
        document.getElementById("Feedback-LeftBar").classList.add("actived");
    </script>
    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>

</body>

</html>