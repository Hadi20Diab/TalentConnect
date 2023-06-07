<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Payment Page</h1>
    <form id="paymentForm" method="post" action="process_payment.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required>
        </div>
        <div class="form-group">
            <button type="submit">Pay Now</button>
        </div>
    </form>
    <div id="paymentStatus"></div>
    <script src="script.js"></script>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
}

.form-group {
    margin-bottom: 10px;
}

label {
    display: inline-block;
    width: 100px;
}

input[type="text"],
input[type="email"],
input[type="number"] {
    width: 200px;
}

button {
    padding: 10px 20px;
    background-color: #337ab7;
    color: #fff;
    border: none;
    cursor: pointer;
}

#paymentStatus {
    margin-top: 20px;
    font-weight: bold;
}

</style>

<script>
    window.addEventListener('DOMContentLoaded', function() {
    var paymentForm = document.getElementById('paymentForm');
    var paymentStatus = document.getElementById('paymentStatus');
  
    paymentForm.addEventListener('submit', function(event) {
        event.preventDefault();
      
        // Retrieve form data
        var formData = new FormData(paymentForm);
        var name = formData.get('name');
        var email = formData.get('email');
        var amount = formData.get('amount');
      
        // Perform payment processing
        // Here you can make an AJAX request to a server-side script to handle the payment processing
      
        // Display payment status
        paymentStatus.textContent = 'Payment successful! Thank you, ' + name + ', for your payment of $' + amount + '.';
      
        // Reset the form
        paymentForm.reset();
    });
});

</script>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
  
    // Perform payment processing
    // Here you can integrate with a payment gateway or process the payment in your desired way
    
    // Example: Save payment details to a database
    // Replace with your own database connection code
    $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');
    $sql = "INSERT INTO payments (name, email, amount) VALUES ('$name', '$email', '$amount')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}
?>
