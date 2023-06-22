<?php 
include "../connection.php";
session_start();

if(!isset($_SESSION['individual_ID'])){  //if individual id is not  set in the session, this means the admin  is not logged in and there's a one that's want to access the admin page and we should prevent it in order to allow only the admin that's login correct and save it's id in the session to go to admin page , then we redirect it to the adminLogin page and when he logged in gthen it will store the admin_id in the session and he will be able to go to admin page when he logged in
    header('location:../userRegistration.php');  //only the individual will acces the individual page when he logged in correclty, otherwise it will be redirected to adminLogin.php
  }
else{
    $individual_ID = $_SESSION['individual_ID'];
    }  
?>


<?php
    // fetch individual
    $sql="SELECT * FROM individuals WHERE individual_ID='$individual_ID' ";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    $select_individual = mysqli_fetch_assoc($result);
    ?>

<?php
    // when click update
    // if(isset($_POST['submit'])){
      if(isset($_POST['submit'])){

        $individualName = mysqli_real_escape_string($conn,$_POST['individualName']);
        $about =mysqli_real_escape_string($conn, $_POST['aboutIndividual'] );     
        $Email = mysqli_real_escape_string($conn,$_POST['IndividualEmail'] );
        $PhoneNumber = mysqli_real_escape_string($conn, $_POST['IndividualPhoneNumber'] );
        
        $Major = mysqli_real_escape_string($conn, $_POST['Major'] );
        $highestDegree = mysqli_real_escape_string($conn, $_POST['highestDegree'] );
        $graduated = mysqli_real_escape_string($conn, $_POST['Graduated'] );
        
        $country = mysqli_real_escape_string($conn, $_POST['IndividualCountry'] );
        $linkedinProfile = mysqli_real_escape_string($conn, $_POST['linkedinProfile'] );
        
        // $companyCategories = mysqli_real_escape_string($conn, $_POST['companyCategories'] );
   

        // $pass =mysqli_real_escape_string($conn, $_POST['pass'] );     
        // $pass = mysqli_real_escape_string($conn, $_POST['cpass'] );
   
      

        // to add https:// on websites link if not setted

        // Check if the input string starts with 'https'
        if (strpos($linkedinProfile, 'https://') !== 0 && !empty($linkedinProfile)) {
            $linkedinProfile = 'https://' . $linkedinProfile;
        }




        // IMAGE Uploud

        // Check if the 'image' field is set and not empty
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
          // Get the uploaded image details
          $image = $_FILES['image']['name'];
          $image_size = $_FILES['image']['size'];
          $image_tmp_name = $_FILES['image']['tmp_name'];
          $image_folder = '../images/individuals_images/'.$individual_ID.'.jpg'; // Assuming you want to save the image with the ID as the filename and using the JPG format
          // $old_image = $_POST['old_image'];


          // Process the uploaded image
          if ($image_size > 0) {
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
              // Update the individual's profile photo in the database
              $update_image = mysqli_query($conn, "UPDATE `individuals` SET individual_photo = '$individual_ID.jpg' WHERE individual_ID = '$individual_ID'");
              
              
              // if ($update_image) {
              //   if (!empty($old_image)) {
              //     // unlink('../images/individuals_images/'.$old_image);
              //     $message[] = 'OLD Image deleted successfully!';
              //   }
              //   $message[] = 'Image updated successfully!';
              // } else {
              //   $message[] = 'Failed to update image in the database.';
              // }
            } 
            // else {
            //   $message[] = 'Failed to upload the image.';
            // }
          }
        }
        // else {
        //   // No image uploaded
        //   $message[] = 'No image uploaded.';
        // }

        // Output any messages
        // if (!empty($message)) {
        //   foreach ($message as $msg) {
        //     echo $msg . "<br>";
        //   }
        // }

//-----




        
        // UPDATE graduation status


        // Convert the graduation status to boolean value
        $isGraduated = ($graduated === 'yes') ? 1 : 0;
        // Update the student's graduation status in the database
        $query = "UPDATE individuals SET Is_Graduated = $isGraduated WHERE  individual_ID = '$individual_ID' ";
        $result = mysqli_query($conn, $query);




        if (isset($_POST['interestedFields'])) {
          $interestedFields = $_POST['interestedFields'];
        
          // Update the student's interested fields in the database
          mysqli_query($conn, "DELETE FROM individual_intrested_field WHERE individual_ID = $individual_ID"); // Delete existing entries
          foreach ($interestedFields as $fieldName) {
            $fieldName = mysqli_real_escape_string($conn, $fieldName);
            $insertQuery = "INSERT INTO individual_intrested_field (individual_ID, field_Name) VALUES ('$individual_ID', '$fieldName')";
            mysqli_query($conn, $insertQuery);
          }
        }
        



        // $interestedFields = $_POST['interestedFields'];

        // // Update the student's interested fields in the database
        // mysqli_query($conn, "DELETE FROM individual_intrested_field WHERE individual_ID = $individual_ID"); // Delete existing entries
        // foreach ($interestedFields as $fieldName) {
        //   $fieldName = mysqli_real_escape_string($conn, $fieldName);
        //   $insertQuery = "INSERT INTO individual_intrested_field (individual_ID, field_Name) VALUES ('$individual_ID', '$fieldName')";
        //   mysqli_query($conn, $insertQuery);
        // }

        $updateProfileQuery = mysqli_query($conn, "UPDATE `individuals` SET individual_Name = '$individualName', individual_Email = '$Email', individual_PhoneNumber = '$PhoneNumber', individual_Country = '$country', individual_Linkedin = '$linkedinProfile', individual_About = '$about',  individual_Major = '$Major', individual_highestDegree = '$highestDegree'  WHERE individual_ID = '$individual_ID'");

        
      if($_POST['individualName']){

        // check if pending or not, if he pending so the admin will review his infromation
          if ($select_individual['individual_Status']=="pending" || $select_individual['individual_Status']=="blocked"){
            echo '<div class="popup " id="popup" style="    top: 50%;">
                    <img src="../admin/assets/imgs/pending.png" >
                    <h2>Our team is currently reviewing your account details. </h2>
                    <p>Please stay tuned for further instructions or contact our support team for more information.</p>
                    <button type="button">
                      <a href="logout.php" style="text-decoration: none; width:100%">OK</a>
                    </button>
                  </div>    
                ';
          }
          else {
            header('location:home.php');
          }
      }

        if (!$updateProfileQuery) {
          echo "Update query error: " . mysqli_error($conn);
        }
    }
?>

<?php
    // fetch individual
    $sql="SELECT * FROM individuals WHERE individual_ID='$individual_ID' ";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    $select_individual = mysqli_fetch_assoc($result);
    ?>



  <!-- Search Script For Select -->
  <head>
    <!-- for alert -->
  <link rel="stylesheet" href="../css/alert.css">

  <!-- Icon Style -->
  <!-- <link rel="stylesheet" href="../css/all-icon.css" /> -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

  <title>Update Profile</title>


  
      <script src="../js/jquery.min.js"></script>
      <script src="../js/selectize.min.js"></script>
      <link rel="stylesheet" href="../js/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
      <script>
        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
      </script>




</head>




<form action="updateProfile.php" method="POST" enctype="multipart/form-data">
<h2 style="text-align: center;">Update Your Profile</h2>


<!-- <input type="hidden" name="old_image" value="<php echo $old_image; ?>"> -->
<div class="profile-photo">
    <label for="profilePhoto" class="edit-icon">
      <i class="fa-regular fa-pen-to-square"></i>
    </label>

    
    <!-- <input type="file" id="profilePhoto" name="image" accept="image/jpg, image/jpeg, image/png" onchange="previewImage(event)"> -->
    <input type="file" id="profilePhoto" name="image" accept="image/jpg, image/jpeg, image/png" onchange="previewImage(event)">
    
    <?php
    if ($select_individual['individual_photo']) {
      echo'
        <img id="preview" src="../images/individuals_images/'. $select_individual['individual_photo'] .'" alt="Profile Photo">
      ';
    }
    else{
      echo'
        <img id="preview" src="../images/individuals_images/default_Image.png" alt="Profile Photo">
      ';
      
    }
    ?>
</div>
  <label for="individualName">Name:</label>
  <input type="text" id="individualName" name="individualName" value="<?= $select_individual['individual_Name']; ?>" required>
  
  <label for="aboutIndividual">About You:</label>
  <textarea id="aboutIndividual" name="aboutIndividual" rows="4" required style="resize:vertical;   min-height: 110px;"><?= $select_individual['individual_About']; ?></textarea>
  
  <label for="contactPersonEmail">Your Email:</label>
  <input type="email" id="contactPersonEmail" name="IndividualEmail" required value="<?= $select_individual['individual_Email']; ?>" >
  
  <label for="IndividualPhoneNumber">Phone Number:</label>
  <input type="tel" id="contactPersonPhone" name="IndividualPhoneNumber" required value="<?= $select_individual['individual_PhoneNumber']; ?>" >
  

<!-- Major -->
  <?php
// Step 1: Retrieve the individual's major from the database
if ($select_individual['individual_Major']) {
    $studentMajor = $select_individual['individual_Major'];
} else {
    $studentMajor = ''; // Set default value if no data found
}

// Step 2: Retrieve the list of majors from the database
$queryMajors = "SELECT major_name FROM majors";
$resultMajors = mysqli_query($conn, $queryMajors);

$majorOptions = '';
// select the user major
if ($resultMajors && mysqli_num_rows($resultMajors) > 0) {
    while ($rowMajors = mysqli_fetch_assoc($resultMajors)) {
        $majorName = $rowMajors['major_name'];
        $selected = ($studentMajor == $majorName) ? 'selected' : '';
        $majorOptions .= "<option value='$majorName' $selected>$majorName</option>";
    }
}
?>

<!-- Step 3: Create the <select> element -->
<label for="StudentMajor">Major:</label>
<select name="Major">
    <option value=""></option>
    <?php echo $majorOptions; ?>
</select>



  <label for="highestDegree">Highest Education Degree:</label>
  <select id="select-state" name="highestDegree">
    <option value="">Highest Degree</option>
    <option value="Bachelor" <?= ($select_individual['individual_highestDegree']) == 'Bachelor' ? 'selected' : '' ?>>Bachelor</option>
    <option value="Master" <?= ($select_individual['individual_highestDegree']) == 'Master' ? 'selected' : '' ?>>Master</option>
    <option value="Phd" <?= ($select_individual['individual_highestDegree']) == 'Phd' ? 'selected' : '' ?>>Phd</option>
  </select>

  



<!-- individual's graduation -->

<?php
// Step 1: Retrieve the individual's graduation status from the database
if (isset( $select_individual['Is_Graduated']) ){
  $graduated = $select_individual['Is_Graduated'];
  $graduated = $graduated ? 'yes' : 'no'; // Convert boolean to string value
} else {
  $graduated = ''; // Set default value if no data found
}

?>

<label for="IndividualGraduated">Are you Graduated?</label>
<select name="Graduated">
  <option value=""></option>
  <option value="yes" <?php if ($graduated == 'yes') echo 'selected'; ?>>Yes</option>
  <option value="no" <?php if ($graduated == 'no') echo 'selected'; ?>>No</option>
</select>
  

  
<!-- individual's Interested Fields -->

  <!-- <form method="POST" action="<?php // echo $_SERVER['PHP_SELF']; ?>"> -->
  <label for="interestedFields">Select Interested Fields:</label>

  <select name="interestedFields[]" multiple>
    <option value="">Fields:</option>
    <!-- Retrieve and display available categories from the 'categories' table -->
    <?php
    $categoriesQuery = mysqli_query($conn, "SELECT * FROM categories");
    while ($category = mysqli_fetch_assoc($categoriesQuery)) {
      $selected = ''; // Initialize variable for checking if the field is selected
      // Check if the field is selected for the student
      $fieldQuery = mysqli_query($conn, "SELECT * FROM individual_intrested_field WHERE individual_ID = $individual_ID AND field_Name = '{$category['category_name']}'");
      if (mysqli_num_rows($fieldQuery) > 0) {
        $selected = 'selected'; // Mark the field as selected
      }
      echo '<option value="' . $category['category_name'] . '" ' . $selected . '>' . $category['category_name'] . '</option>';
    }
    ?>
  </select>

  

<!-- individual's Country -->
  

  <label for="IndividualCountry">Country:</label>
  <select id="select-state" name="IndividualCountry">
    <option value="">Where are you live?</option>
        <?php
            $studentCountry=$select_individual['individual_Country'];

            $query = "SELECT country_name FROM country";
            $result = mysqli_query($conn, $query);
            $countries = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $countries[] = $row['country_name'];
            }

            // Step 2: Generate the <option> tags dynamically
            $options = '';
            foreach ($countries as $country) {
                $selected = ($country == $studentCountry) ? 'selected' : ''; // Step 3: Pre-select the student's country
                $options .= "<option value='$country' $selected>$country</option>";
            }
        ?>
        <?php echo $options; ?>
  </select>




  <!-- <div>
    <label for="companySize">Company Size:</label>
    <select id="companySize" name="companySize">
      <option value="small">Small</option>
      <option value="medium">Medium</option>
      <option value="large">Large</option>
    </select>
  </div> -->



  <!-- <label for="companyPhotos">Your Photo:</label>
  <input type="file" id="companyPhotos" name="image" value="Upload" accept="image/jpg, image/jpeg, image/png"> -->

  <label for="linkedinProfile">LinkedIn Profile:</label>
  <input type="url" id="linkedinProfile" name="linkedinProfile" value="<?= $select_individual['individual_Linkedin']; ?>" >

  
  <!-- <label for="companyCategories">Company Categories</label>
  <select id="select-state" name="companyCategories" multiple>
    <option value="">choose category</option>
        <?php
        //     $select_categories = mysqli_query($conn, "SELECT category_name FROM `categories`");
                
        //     while ($select_categoy = mysqli_fetch_assoc($select_categories)) {
        //         echo"
        //             <option value=" . $select_categoy['category_name'] . " > " .$select_categoy['category_name']. " </option>
        //         ";
        //     }
        //     echo'
        //     </select>';
        // ?>
  </select> -->
  
  <br>
  <div style="display: flex;     justify-content: space-evenly;     align-items: center;     flex-wrap: wrap;       margin: 3% 0;     width: 100%;">

    
      <button type="submit" name="submit">Update Profile</button>
    
      <button type="button" onclick="window.location.href=document.referrer;">Cancel</button>
      <!-- back to the previous page -->
    </form>
  </div>





<!-- for image -->
  <style>
  .profile-photo {
  position: relative;
  display: inline-block;
  width: 100%;
    text-align-last: center;
}

.profile-photo #profilePhoto {
  display: none;
}

.profile-photo img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
}

.profile-photo .edit-icon {
  position: absolute;
  bottom: 0;
  right: 37%;
  background-color: rgba(0, 0, 0, 0.6);
  color: #fff;
  padding: 5px;
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.3s;

  width: 130px;
  height: 30%;
  text-align-last: center;
  filter: invert(1);
}

.profile-photo .edit-icon i {
  font-size: 16px;
}

.profile-photo .edit-icon:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

</style>

<script>
  function previewImage(event) {
  var input = event.target;
  var reader = new FileReader();

  reader.onload = function () {
    var preview = document.getElementById('preview');
    preview.src = reader.result;
  };

  reader.readAsDataURL(input.files[0]);
}

</script>
<!-- END -->



<!-- <script>
    $(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
      });
   });
</script> -->
    <style>
form {
  width: 500px;
  margin: 0 auto;
}

label {
  display: block;
  margin-top: 10px;
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="tel"],
textarea {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

textarea {
  height: 100px;
}

select {
  width: 100%;
  padding: 8px;
  margin-top: 10px;
  margin-left: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background-color: #45a049;
}

input[type="file"] {
  margin-top: 5px;
}

input[type="file"]::-webkit-file-upload-button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="file"]::-webkit-file-upload-button:hover {
  background-color: #45a049;
}




    </style>


