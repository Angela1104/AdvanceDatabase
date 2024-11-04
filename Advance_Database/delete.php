<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    header("Location: index.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Customer Record</title>
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
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        button {
            width: 48%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .confirm-button {
            background-color: #d9534f;
            color: white;
        }
        .confirm-button:hover {
            background-color: #c9302c;
        }
        .cancel-button {
            background-color: gray;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            padding: 10px;
            border-radius: 3px;
            width: 48%;
            font-size: 16px;
            box-sizing: border-box;
        }
        .cancel-button:hover {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<h2>Delete Customer Record</h2>

<form method="post" action="delete.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>Are you sure you want to delete this record?</p>
    <button type="submit" class="confirm-button">Delete</button>
    <a href="index.php" class="cancel-button">Cancel</a>
</form>

</body>
</html>
