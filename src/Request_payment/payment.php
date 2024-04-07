<?php
include_once("Lib/connect.php");
include_once("include/func_genralfunc_.php");

// Extract URL parameters
$token = isset($_GET['token']) ? $_GET['token'] : '';

 $func = new RequestPayment('', '');
 $paymentdeatils = $func->GetRequestDetailsFromToken($token);

//var_dump($paymentdeatils);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Request Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        appearance: none;
    }
    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>


</head>
<body>
<div class="container">
    <h1>Payment Request Form</h1>
    <form action="Request_payment/process_rpayment_.php" method="post">
        <div class="form-group">
            <label for="company">Company:</label>
            <input type="text" id="company" name="company" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <?php foreach ($paymentdeatils as $paymentdeatil):?>

        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" value="<?php echo number_format($paymentdeatil['amount'], 2, '.', ',')?>" readonly required>
        </div>
        <div class="form-group">
            <label for="amount">Currency:</label>
            <input type="text" id="amount" name="currency" value="<?php echo $paymentdeatil['currency']?>" readonly required>
        </div>
        <div class="form-group">
            <label for="name">Request Token:</label>
            <input type="text" id="name" name="token" value="<?php echo $paymentdeatil['unique_token']?>" readonly required>
        </div>
        <?php endforeach ?>


    
        <div class="form-group">
            <input type="submit" value="Pay Now">
        </div>
    </form>
</div>
</body>
</html>











