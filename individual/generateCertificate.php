<?php
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $individual_ID = $_POST['individual_ID'];
  $course_ID = $_POST['course_ID'];

  $select_individual_Name = mysqli_query($conn,"SELECT individual_Name FROM `individuals` WHERE individual_ID = $individual_ID");
  $fetch_individual_Name = mysqli_fetch_assoc($select_individual_Name);
  // fetch Individual Name
  $individual_Name= $fetch_individual_Name['individual_Name'];




  $select_course_Creator = mysqli_query($conn,
  "SELECT 	course_Name, company_Logo FROM courses 
  INNER JOIN company ON company.company_Name  = courses.course_Creator
  
  WHERE course_ID = $course_ID"
  );

  $fetch_course_Creator = mysqli_fetch_assoc($select_course_Creator);
    // fetch LOGO
  $logo = $fetch_course_Creator['company_Logo'];

  $count = mysqli_num_rows($select_course_Creator);
  if (!$count >0) {
    $select_course_Creator = mysqli_query($conn,
    "SELECT 	course_Name, university_Logo FROM courses 
    INNER JOIN universities ON universities.university_Name  = courses.course_Creator
    
    WHERE course_ID = $course_ID"
    );

    $fetch_course_Creator = mysqli_fetch_assoc($select_course_Creator);
    // fetch LOGO
    $logo = $fetch_course_Creator['university_Logo'];

  }
  // fetch course Name
  $course_Name = $fetch_course_Creator['course_Name'];

  // fetch date
  $select_IssuedOn= mysqli_query($conn, "SELECT progress_date	 FROM course_progress WHERE course_ID = $course_ID AND individual_ID = $individual_ID");
  $fetch_IssuedOn= mysqli_fetch_assoc($select_IssuedOn);
  $issuedOn= $fetch_IssuedOn['progress_date'];

}
// $certificate_Name= $individual_Name."_".$course_Name."_Certificate";
?>

<!DOCTYPE html>
<html>
  <head>
        <!-- Include the library to  Downlead Certificate-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script> -->
  </head>
<body>
  <div id ="certificate" class="certificate">
    <div class="logo-container">
      <img src="../images/talentConnectLOGO.png" alt="Talent Connect Logo" class="logo">
      <img src="../images/companies_universities_images/<?= $logo ?>" alt="Company/University Logo" class="logo">
    </div>
    <h1>Certificate of Completion</h1>
    <h2>This is to certify that</h2>
    <!-- individual_Name  -->
    <h3><?= $individual_Name ?></h3>
    <h4>has successfully completed the course</h4>
    <h4 class="course-name"><?= $course_Name ?></h4>
    <p class="issued-on">Issued on: <span class="date"><?= $issuedOn ?> </span></p>
  </div>

    <!-- <button id="download" onclick="generateCertificate()">Download PDF</button> -->
    <!-- <script src="assets/js/cdnjs.cloudflare.com_ajax_libs_html2pdf.js_0.9.2_html2pdf.bundle.js"></script>

<script>
window.onload = function () {
  function generateCertificate(){
    const invoice = this.document.getElementById("certificate");
    console.log(invoice);
    console.log(window);
    var opt = {
        margin: 1,
        filename: 'myfile.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().from(invoice).set(opt).save();
  }
  // downloud 
  generateCertificate();
}
</script> -->


</body>
</html>

<style>
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f2f2f2;
}

.certificate {
  background-color: #ffffff;
  border: 2px solid #333333;
  padding: 40px;
  text-align: center;
  max-width: 600px;
  margin: 50px auto;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  font-family: 'Arial', sans-serif;
}

.logo-container {
  display: flex;
  justify-content: space-around;
  margin-bottom: 30px;
}

.logo {
  max-width: 120px;
  margin: 0 10px;
}

h1 {
  font-size: 32px;
  margin-bottom: 20px;
  color: #333333;
  font-weight: bold;
}

h2 {
  font-size: 24px;
  margin-bottom: 10px;
  color: #555555;
}

h3,
h4 {
  font-size: 28px;
  margin-bottom: 10px;
  color: #333333;
  font-weight: normal;
}

.course-name {
  font-size: 32px;
  margin-bottom: 10px;
  font-weight: bold;
  color: #555555;
}

.date {
  font-style: italic;
  font-family: 'Courier New', monospace;
  color: #555555;
}

.issued-on {
  font-size: 20px;
  margin-top: 30px;
  color: #555555;
}
h1, h2, h3, h4, p {
  font-family: 'Times New Roman', serif;
  }

  </style>
