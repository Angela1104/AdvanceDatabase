<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $company = $_POST["company"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $email_address = $_POST["email_address"];
    $job_title = $_POST["job_title"];
    $business_phone = $_POST["business_phone"];
    $home_phone = $_POST["home_phone"];
    $mobile_phone = $_POST["mobile_phone"];
    $fax_number = $_POST["fax_number"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state_province = $_POST["state_province"];
    $zip_postal_code = $_POST["zip_postal_code"];
    $country_region = $_POST["country_region"];
    $web_page = $_POST["web_page"];
    $notes = $_POST["notes"];
    $attachments = $_POST["attachments"];

    $sql = "UPDATE customers SET company=?, last_name=?, first_name=?, email_address=?, job_title=?, business_phone=?, home_phone=?, mobile_phone=?, fax_number=?, address=?, city=?, state_province=?, zip_postal_code=?, country_region=?, web_page=?, notes=?, attachments=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssi", $company, $last_name, $first_name, $email_address, $job_title, $business_phone, $home_phone, $mobile_phone, $fax_number, $address, $city, $state_province, $zip_postal_code, $country_region, $web_page, $notes, $attachments, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM customers WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Customer Record</title>
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

<h2>Update Customer Record</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
    <div class="form-group">
        <label>Company:</label>
        <input type="text" name="company" value="<?php echo htmlspecialchars($row['company']); ?>" required>
    </div>
    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
    </div>
    <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
    </div>
    <div class="form-group">
        <label>Email Address:</label>
        <input type="email" name="email_address" value="<?php echo htmlspecialchars($row['email_address']); ?>" required>
    </div>
    <div class="form-group">
        <label>Job Title:</label>
        <input type="text" name="job_title" value="<?php echo htmlspecialchars($row['job_title']); ?>">
    </div>
    <div class="form-group">
        <label>Business Phone:</label>
        <input type="text" name="business_phone" value="<?php echo htmlspecialchars($row['business_phone']); ?>">
    </div>
    <div class="form-group">
        <label>Home Phone:</label>
        <input type="text" name="home_phone" value="<?php echo htmlspecialchars($row['home_phone']); ?>">
    </div>
    <div class="form-group">
        <label>Mobile Phone:</label>
        <input type="text" name="mobile_phone" value="<?php echo htmlspecialchars($row['mobile_phone']); ?>">
    </div>
    <div class="form-group">
        <label>Fax Number:</label>
        <input type="text" name="fax_number" value="<?php echo htmlspecialchars($row['fax_number']); ?>">
    </div>
    <div class="form-group">
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>">
    </div>
    <div class="form-group">
        <label>City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($row['city']); ?>">
    </div>
    <div class="form-group">
        <label>State/Province:</label>
        <input type="text" name="state_province" value="<?php echo htmlspecialchars($row['state_province']); ?>">
    </div>
    <div class="form-group">
        <label>ZIP/Postal Code:</label>
        <input type="text" name="zip_postal_code" value="<?php echo htmlspecialchars($row['zip_postal_code']); ?>">
    </div>
    <div class="form-group">
        <label>Country/Region:</label>
        <input type="text" name="country_region" value="<?php echo htmlspecialchars($row['country_region']); ?>">
    </div>
    <div class="form-group">
        <label>Web Page:</label>
        <input type="text" name="web_page" value="<?php echo htmlspecialchars($row['web_page']); ?>">
    </div>
    <div class="form-group">
        <label>Notes:</label>
        <textarea name="notes"><?php echo htmlspecialchars($row['notes']); ?></textarea>
    </div>
    <div class="form-group">
        <label>Attachments:</label>
        <input type="text" name="attachments" value="<?php echo htmlspecialchars($row['attachments']); ?>">
    </div>
    <button type="submit">Update</button>
</form>

</body>
</html>
