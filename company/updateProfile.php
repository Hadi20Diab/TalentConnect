<?php 
include "../connection.php";
session_start();

// if(!isset($_SESSION['company_id'])){  //if admin id is not  set in the session, this means the admin  is not logged in and there's a one that's want to access the admin page and we should prevent it in order to allow only the admin that's login correct and save it's id in the session to go to admin page , then we redirect it to the adminLogin page and when he logged in gthen it will store the admin_id in the session and he will be able to go to admin page when he logged in
//     header('location:adminLogin.php');  //only the admin will acces the admin page when he logged in correclty, otherwise it will be redirected to adminLogin.php
//   }
// else{
//     $company_id = $_SESSION['company_id'];
// }

$company_id=1;
?>
<head>
    <!-- Search Select javascript -->
    <!-- <script src="../js/jquery.min.js"></script>
    <script src="../js/selectize.min.js"></script> -->
</head>


<?php
    // fetch company
    $sql="SELECT * FROM company WHERE company_id='$company_id' ";
    // Execute the query
    $result = mysqli_query($conn, $sql);

    $select_company = mysqli_fetch_assoc($result);
    // echo"$select_company[company_Name]";
?>
<?php
    // when click update
    if(isset($_POST['submit'])){

        $companyName = mysqli_real_escape_string($conn,$_POST['companyName']);
        $aboutCompany =mysqli_real_escape_string($conn, $_POST['aboutCompany'] );     
        $companyEmail = mysqli_real_escape_string($conn,$_POST['companyEmail'] );
        $companyPhoneNumber = mysqli_real_escape_string($conn, $_POST['companyPhoneNumber'] );
        $companyLocation = mysqli_real_escape_string($conn, $_POST['companyLocation'] );
        
        $companyWebsite = mysqli_real_escape_string($conn, $_POST['companyWebsite'] );
        $linkedinProfile = mysqli_real_escape_string($conn, $_POST['linkedinProfile'] );
        $twitterProfile = mysqli_real_escape_string($conn, $_POST['twitterProfile'] );
        $facebookProfile = mysqli_real_escape_string($conn, $_POST['facebookProfile'] );
        $instagramProfile = mysqli_real_escape_string($conn, $_POST['instagramProfile'] );
        
        $companyCategories = mysqli_real_escape_string($conn, $_POST['companyCategories'] );
   

        $pass =mysqli_real_escape_string($conn, $_POST['pass'] );     
        $pass = mysqli_real_escape_string($conn, $_POST['cpass'] );
   
      

        // to add https:// on websites link if not setted

        // Check if the input string starts with 'https'
        if (strpos($companyWebsite, 'https://') !== 0 && !empty($companyWebsite)) {
            // Prepend 'https://' to the input string
            $companyWebsite = 'https://' . $companyWebsite;
        }
        if (strpos($linkedinProfile, 'https://') !== 0 && !empty($linkedinProfile)) {
            $linkedinProfile = 'https://' . $linkedinProfile;
        }
        if (strpos($twitterProfile, 'https://') !== 0 && !empty($twitterProfile)) {
            $twitterProfile = 'https://' . $twitterProfile;
        }
        if (strpos($facebookProfile, 'https://') !== 0 && !empty($facebookProfile)) {
            $facebookProfile = 'https://' . $facebookProfile;
        }
        if (strpos($instagramProfile, 'https://') !== 0 && !empty($instagramProfile)) {
            $instagramProfile = 'https://' . $instagramProfile;
        }


        $image = $_FILES['image']['name'];  
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../images/companies_images/'.$image;
        $old_image = $_POST['old_image'];
     

        if(!empty($image)){
           if($image_size > 2000000){
              $message[] = 'image size is too large!';
           }else{
             $update_image = mysqli_query($conn, "UPDATE `company` SET company_Logo = '$image' WHERE company_id = '$company_id' ") ;
             
              if($update_image){
                 move_uploaded_file($company_id, $image_folder); // we rename the image with the ID to avoid the conflict btw images name (may be 2 user upload image with same name)
                 if (!empty($old_image)){ // if image uploded for first time so we will not delete the preivous one
                    unlink('uploaded_img/'.$old_image);
                 }
                //  $message[] = 'image updated successfully!';
              };
           };
        };







        $updateProfileQuery = mysqli_query($conn, "INSERT INTO `company`(company_Name,company_Email	, company_Password, company_PhoneNumber, company_Country, 	company_Website, company_Location, company_Linkedin, company_Twitter, company_Facebook, company_Instagram, company_About)
                                                    VALUES('$companyName', '$companyEmail', '$pass','$phoneNumber', '$country', '$location','$linkedin', '$twitter', '$facebook','$about')");

    }
?>




<form action="update_profile.php" method="POST">
<h2 style="text-align: center;">Update Company Profile</h2>
  <label for="companyName">Company Name:</label>
  <input type="text" id="companyName" name="companyName" value="<?= $select_company['company_Name']; ?>" required>
  
  <label for="aboutCompany">About Company:</label>
  <textarea id="aboutCompany" name="aboutCompany" rows="4" required style="resize:vertical;   min-height: 110px;"><?= $select_company['company_About']; ?></textarea>
  
  <label for="contactPersonEmail">Company Email:</label>
  <input type="email" id="contactPersonEmail" name="companyEmail" required value="<?= $select_company['company_Email']; ?>" >
  
  <label for="companyPhoneNumber">Contact Company Phone:</label>
  <input type="tel" id="contactPersonPhone" name="companyPhoneNumber" required value="<?= $select_company['company_PhoneNumber']; ?>" >

    
  <label for="Location">Company Location:</label>
  <input type="text" id="companyLocation" name="companyLocation" value="<?= $select_company['company_Location']; ?>" >

  <!-- <div>
    <label for="companySize">Company Size:</label>
    <select id="companySize" name="companySize">
      <option value="small">Small</option>
      <option value="medium">Medium</option>
      <option value="large">Large</option>
    </select>
  </div> -->

  <label for="companyPhotos">Company Logo:</label>
  <input type="file" id="companyPhotos" name="image" value="Upload" accept="image/jpg, image/jpeg, image/png">

  <label for="companyWebsite">Company Website:</label>
  <input type="url" id="companyWebsite" name="companyWebsite">
  
  
  <label for="linkedinProfile">LinkedIn Profile:</label>
  <input type="url" id="linkedinProfile" name="linkedinProfile" value="<?= $select_company['company_Linkedin']; ?>" >
  
  <label for="twitterProfile">Twitter Profile:</label>
  <input type="url" id="twitterProfile" name="twitterProfile" value="<?= $select_company['company_Twitter']; ?>" >
  
  <label for="facebookProfile">Facebook Profile:</label>
  <input type="url" id="facebookProfile" name="facebookProfile" value="<?= $select_company['company_Facebook']; ?>" >
  
  <label for="instagramProfile">Instagram Profile:</label>
  <input type="url" id="instagramProfile" name="instagramProfile" value="<?= $select_company['company_Instagram']; ?>" >
  
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
  
  <button type="submit" style="    width: 40%;     margin: 3% 30%;">Update Profile</button>
</form>







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


