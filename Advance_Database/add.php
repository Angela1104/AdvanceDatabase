<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = isset($_POST["company"]) ? $_POST["company"] : '';
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : '';
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
    $email_address = isset($_POST["email_address"]) ? $_POST["email_address"] : '';
    $job_title = isset($_POST["job_title"]) ? $_POST["job_title"] : '';
    $business_phone = isset($_POST["business_phone"]) ? $_POST["business_phone"] : '';
    $home_phone = isset($_POST["home_phone"]) ? $_POST["home_phone"] : '';
    $mobile_phone = isset($_POST["mobile_phone"]) ? $_POST["mobile_phone"] : '';
    $fax_number = isset($_POST["fax_number"]) ? $_POST["fax_number"] : '';
    $address = isset($_POST["address"]) ? $_POST["address"] : '';
    $city = isset($_POST["city"]) ? $_POST["city"] : '';
    $state_province = isset($_POST["state_province"]) ? $_POST["state_province"] : '';
    $zip_postal_code = isset($_POST["zip_postal_code"]) ? $_POST["zip_postal_code"] : '';
    $country_region = isset($_POST["country_region"]) ? $_POST["country_region"] : '';
    $web_page = isset($_POST["web_page"]) ? $_POST["web_page"] : '';
    $notes = isset($_POST["notes"]) ? $_POST["notes"] : '';
    $attachments = isset($_POST["attachments"]) ? $_POST["attachments"] : '';

    if (!empty($company) && !empty($last_name) && !empty($first_name)) {
        $sql = "INSERT INTO customers (company, last_name, first_name, email_address, job_title, business_phone, home_phone, mobile_phone, fax_number, address, city, state_province, zip_postal_code, country_region, web_page, notes, attachments) 
                VALUES ('$company', '$last_name', '$first_name', '$email_address', '$job_title', '$business_phone', '$home_phone', '$mobile_phone', '$fax_number', '$address', '$city', '$state_province', '$zip_postal_code', '$country_region', '$web_page', '$notes', '$attachments')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: gray;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<h2>Add New Customer Record</h2>

<form method="post" action="add.php">
    <div class="form-group">
        <label>Company:</label>
        <input type="text" name="company" required>
    </div>
    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" required>
    </div>
    <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" required>
    </div>
    <div class="form-group">
        <label>Email Address:</label>
        <input type="email" name="email_address">
    </div>
    <div class="form-group">
        <label>Job Title:</label>
        <input type="text" name="job_title">
    </div>
    <div class="form-group">
        <label>Business Phone:</label>
        <input type="text" name="business_phone">
    </div>
    <div class="form-group">
        <label>Home Phone:</label>
        <input type="text" name="home_phone">
    </div>
    <div class="form-group">
        <label>Mobile Phone:</label>
        <input type="text" name="mobile_phone">
    </div>
    <div class="form-group">
        <label>Fax Number:</label>
        <input type="text" name="fax_number">
    </div>
    <div class="form-group">
        <label>Address:</label>
        <input type="text" name="address">
    </div>
    <div class="form-group">
        <label>City:</label>
        <input type="text" name="city">
    </div>
    <div class="form-group">
        <label>State/Province:</label>
        <input type="text" name="state_province">
    </div>
    <div class="form-group">
        <label>ZIP/Postal Code:</label>
        <input type="text" name="zip_postal_code">
    </div>
    <div class="form-group">
        <label>Country/Region:</label>
        <input type="text" name="country_region">
    </div>
    <div class="form-group">
        <label>Web Page:</label>
        <input type="text" name="web_page">
    </div>
    <div class="form-group">
        <label>Notes:</label>
        <textarea name="notes"></textarea>
    </div>
    <div class="form-group">
        <label>Attachments:</label>
        <input type="text" name="attachments">
    </div>
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
