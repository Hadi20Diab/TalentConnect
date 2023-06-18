<?php 
  include "structural_IndividualPage.php";


  if(isset($_GET['course_ID'])  ){
    $course_ID = $_GET['course_ID'];
  }
  else{
      $course_ID = '';
      header('location:courses.php');
   }


?>
<!-- save data after submition form part -->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $card_number = isset($_GET['card_number']) ? $_GET['card_number'] : '';
    $card_holder = isset($_GET['card_holder']) ? $_GET['card_holder'] : '';
    $expiration_month = isset($_GET['expiration_month']) ? $_GET['expiration_month'] : '';
    $expiration_year = isset($_GET['expiration_year']) ? $_GET['expiration_year'] : '';
    $cvv = isset($_GET['cvv']) ? $_GET['cvv'] : '';




    $courseFee_query = "SELECT course_Fees FROM courses WHERE course_ID = $course_ID";
    $courseFee_result = mysqli_query($conn, $courseFee_query);

    if ($courseFee_result) {
        // Check if any rows were returned
        if (mysqli_num_rows($courseFee_result) > 0) {
            $row = mysqli_fetch_assoc($courseFee_result);
            $amount = $row['course_Fees'];
        }
    }
    


    if(isset($_GET['card_number']) && isset($_GET['card_holder']) && isset($_GET['expiration_month']) && isset($_GET['expiration_year']) && isset($_GET['cvv'])){
        // add payment to database
            // secure data before add it on database using encryptIt
            $card_number = encryptIt($card_number);
            $card_holder = encryptIt($card_holder);
            $expiration_month = encryptIt($expiration_month);
            $expiration_year = encryptIt($expiration_year);
            $cvv = encryptIt($cvv);

        $query = "INSERT INTO payments (course_ID, individual_ID, amount, card_number, card_holder, expiration_month, expiration_year, cvv)
                                VALUES ('$course_ID', '$individual_ID', '$amount', '$card_number', '$card_holder', '$expiration_month', '$expiration_year', '$cvv')";
        $result = mysqli_query($conn, $query);


        // update course Status for individual to under-progress
            // BUT first we need the Id for first video on this course
            $video_query = "SELECT video_ID FROM  course_videos WHERE course_ID=$course_ID AND video_Order=1";
            $video_result = mysqli_query($conn, $video_query);
            $row = mysqli_fetch_assoc($video_result);
            $video_ID = $row['video_ID'];

        $query = "INSERT INTO course_progress ( individual_ID, course_ID, last_watched_video, course_Status)
                                VALUES ('$individual_ID', '$course_ID', '$video_ID', 'under-progress')";
        $result = mysqli_query($conn, $query);



        echo '
            <div class="popup" id="popup" style="background: rgb(226, 252, 214); top: 50%;">
            <img src="assets/imgs/tick.png" >
            <h2 style="color:green;">Payment Successful!</h2>
            <p>Thank you for your payment. You will now be redirected back to the course you paid for.</p>
            <button type="button" style="background: #6fd649;" onclick="location.href=\'viewCourse.php?course_id=' . $course_ID . '\';">OK</button>
            </div>
        ';

    
    }
}
?>


<!-- get infromation payment information from database if he payed before -->

<?php

// Query to retrieve payment information
$query = "SELECT DISTINCT card_number, card_holder, expiration_month, expiration_year, cvv FROM payments WHERE individual_ID = $individual_ID";
$result = mysqli_query($conn, $query);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);

        //decrypt data and Store the values in variables
            $card_number = decryptIt($row['card_number']);
            $card_holder = decryptIt($row['card_holder']);
            $expiration_month = decryptIt($row['expiration_month']);
            $expiration_year = decryptIt($row['expiration_year']);
            $cvv = decryptIt($row['cvv']);

        // Perform further processing with the retrieved values

        
        
        // $input = "123";
        // $encrypted = encryptIt($input);
        // $decrypted = decryptIt($encrypted);
        
        // echo $encrypted . '<br />' . $decrypted;

        // $card_number = decryptIt($card_number);
    }
}

?>






<div class="payment_container">

    <div class="card-container">

        <div class="front">
            <div class="image">
                <img src="assets/imgs/chip.png" alt="">
                <img src="assets/imgs/visa.png" alt="">
            </div>
            <div class="card-number-box">################</div>
            <div class="flexbox">
                <div class="box">
                    <span>card holder</span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="image/visa.png" alt="">
            </div>
        </div>

    </div>

<form action="payment.php" method="GET">
    <div style="text-align: center;font-size: 1.3rem;font-weight: bold;    margin-top: 10px;">
        <span>Amount</span>
        <span><?= $amount ?> $</span>
    </div>
    <div class="inputBox">
        <span>card number</span>
        <input type="text" name="card_number" maxlength="19" class="card-number-input" placeholder="0000 0000 0000 0000" onkeyup="formatCardNumber(this)" oninput="this.value = this.value.replace(/\D/g, '')" required value="<?= $card_number?>">
    </div>
    <div class="inputBox">
        <span>card holder</span>
        <input type="text" name="card_holder" class="card-holder-input" placeholder="Enter the name on your Visa card" required value="<?= $card_holder ?>">
    </div>
    <div class="flexbox">
        <div class="inputBox">
            <span>expiration mm</span>
            <select name="expiration_month" class="month-input" required>
                <option value="">month</option>
                <?php
                $selectedMonth = isset($expiration_month) ? $expiration_month  : '';
                for ($month = 1; $month <= 12; $month++) {
                    $value = str_pad($month, 2, '0', STR_PAD_LEFT);
                    $selected = $selectedMonth === $value ? ' selected' : '';
                    echo "<option value=\"$value\"$selected>$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="inputBox">
            <span>expiration yy</span>
            <select name="expiration_year" class="year-input" required>
                <option value="">year</option>
                <?php
                $selectedYear = isset($expiration_year) ? $expiration_year : '';
                for ($year = 2023; $year <= 2033; $year++) {
                    $selected = $selectedYear === (string)$year ? ' selected' : '';
                    echo "<option value=\"$year\"$selected>$year</option>";
                }
                ?>
            </select>
        </div>
        <div class="inputBox">
            <span>cvv</span>
            <input type="text" name="cvv" maxlength="3" class="cvv-input" placeholder="3-Digit Code" required value="<?= $cvv ?>">
        </div>
    </div>
    <input type="submit" value="submit" class="submit-btn"/>
    <input type="hidden" name="course_ID" value="<?php echo $course_ID; ?>">
</form>




</div>
<!-- script for cardNumber to access only enter diget and the format like this: 0000 0000 0000 0000 -->
<script>
function formatCardNumber(input) {
  // Remove all non-digit characters
  input.value = input.value.replace(/\D/g, '');

  // Add spaces every 4 characters
  if (input.value.length > 0) {
    input.value = input.value.match(new RegExp('.{1,4}', 'g')).join(' ');
  }
}
</script>


<title>Payment</title>

<style>
/* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap'); */
/* 
*{
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border: none; 
    text-decoration: none;
} */

.payment_container{
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    margin-top: 20px;
    /* background: #eee; */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column;
    padding-bottom: 60px;
}
.payment_container, .payment_container input{
    text-transform: uppercase;
}

.payment_container form{
    background: #fff;
    border-radius: 5px;
    box-shadow: 7px 12px 22px rgba(0,0,0,.1);
    padding: 20px;
    width: 600px;
    padding-top: 160px;
    
}

.payment_container form .inputBox{
    margin-top: 20px;
}

.payment_container form .inputBox span{
    display: block;
    color:#999;
    padding-bottom: 5px;
}

.payment_container form .inputBox input,
.payment_container form .inputBox select{
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border:1px solid rgba(0,0,0,.3);
    color:#444;
}

.payment_container form .flexbox{
    display: flex;
    gap:15px;
}

.payment_container form .flexbox .inputBox{
    flex:1 1 150px;
}

.payment_container form .submit-btn{
    width: 100%;
    /* background:linear-gradient(45deg, blueviolet, deeppink); */
    background: linear-gradient(45deg, black, var(--nav-main));

    margin-top: 20px;
    padding: 10px;
    font-size: 20px;
    color:#fff;
    border-radius: 10px;
    cursor: pointer;
    transition: .2s linear;
}

.payment_container form .submit-btn:hover{
    letter-spacing: 2px;
    opacity: .8;
}

.payment_container .card-container{
    margin-bottom: -150px;
    position: relative;
    height: 250px;
    width: 400px;
	z-index:1;
}

.payment_container .card-container .front{
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0; left: 0;
    /* background:linear-gradient(45deg, blueviolet, deeppink); */
    background: linear-gradient(45deg, black, var(--nav-main));

    border-radius: 5px;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    padding:20px;
    transform:perspective(1000px) rotateY(0deg);
    transition:transform .4s ease-out;
}

.payment_container .card-container .front .image{
    display: flex;
    align-items:center;
    justify-content: space-between;
    padding-top: 10px;
}

.payment_container .card-container .front .image img{
    height: 50px;
}

.payment_container .card-container .front .card-number-box{
    padding:30px 0;
    font-size: 22px;
    color:#fff;
}

.payment_container .card-container .front .flexbox{
    display: flex;
}

.payment_container .card-container .front .flexbox .box:nth-child(1){
    margin-right: auto;
}

.payment_container .card-container .front .flexbox .box{
    font-size: 15px;
    color:#fff;
}

.payment_container .card-container .back{
    position: absolute;
    top:0; left: 0;
    height: 100%;
    width: 100%;
    /* background:linear-gradient(45deg, blueviolet, deeppink); */
    background: linear-gradient(45deg, black, var(--nav-main));

    border-radius: 5px;
    padding: 20px 0;
    text-align: right;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    transform:perspective(1000px) rotateY(180deg);
    transition:transform .4s ease-out;
}

.payment_container .card-container .back .stripe{
    background: #000;
    width: 100%;
    margin: 10px 0;
    height: 50px;
}

.payment_container .card-container .back .box{
    padding: 0 20px;
}

.payment_container .card-container .back .box span{
    color:#fff;
    font-size: 15px;
}

.payment_container .card-container .back .box .cvv-box{
    height: 50px;
    padding: 10px;
    margin-top: 5px;
    color:#333;
    background: #fff;
    border-radius: 5px;
    width: 100%;
}

.payment_container .card-container .back .box img{
    margin-top: 30px;
    height: 30px;
}
</style>





<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
    document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
    document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;

});


document.querySelector('.card-number-input').oninput = () =>{
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}

document.querySelector('.card-holder-input').oninput = () =>{
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}

document.querySelector('.month-input').oninput = () =>{
    document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
}

document.querySelector('.year-input').oninput = () =>{
    document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
}

document.querySelector('.cvv-input').onmouseenter = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
}

document.querySelector('.cvv-input').onmouseleave = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
}

document.querySelector('.cvv-input').oninput = () =>{
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
	}

</script>
