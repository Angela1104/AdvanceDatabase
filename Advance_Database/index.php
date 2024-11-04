<?php
include "conn.php";
?>
<style>
    .button {
        background-color: gray;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #45a049;
    }

    .action-button {
        padding: 5px 10px;
        font-size: 14px;
        margin: 2px;
        border-radius: 3px;
    }

    .update-button {
        background-color: #4CAF50;
        color: white;
    }

    .delete-button {
        background-color: #f44336;
        color: white;
    }

    .update-button:hover {
        background-color: #45a049;
    }

    .delete-button:hover {
        background-color: #d32f2f;
    }
</style>

<?php
$sql1 = "SELECT * FROM customers";
$result_customers = $conn->query($sql1);

if ($result_customers->num_rows > 0) {
    echo "<h2>Table 1: Customers Record</h2>";
    
    echo "<table border='1' cellspacing='0' cellpadding='4'> 
            <tr>
                <th>ID</th>
                <th>COMPANY</th>
                <th>LAST NAME</th>
                <th>FIRST NAME</th>
                <th>EMAIL ADDRESS</th>
                <th>JOB TITLE</th>
                <th>BUSINESS PHONE</th>
                <th>HOME PHONE</th>
                <th>MOBILE PHONE</th>
                <th>FAX NUMBER</th>
                <th>ADDRESS</th>
                <th>CITY</th>
                <th>STATE/PROVINCE</th>
                <th>ZIP/POSTAL CODE</th>
                <th>COUNTRY/REGION</th>
                <th>WEB PAGE</th>
                <th>NOTES</th>
                <th>ATTACHMENTS</th>
                <th>ACTION</th>
            </tr>";

    while ($row = $result_customers->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["company"]."</td>";
            echo "<td>".$row["last_name"]."</td>";
            echo "<td>".$row["first_name"]."</td>";
            echo "<td>".$row["email_address"]."</td>";
            echo "<td>".$row["job_title"]."</td>";
            echo "<td>".$row["business_phone"]."</td>";
            echo "<td>".$row["home_phone"]."</td>";
            echo "<td>".$row["mobile_phone"]."</td>";
            echo "<td>".$row["fax_number"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["city"]."</td>";
            echo "<td>".$row["state_province"]."</td>";
            echo "<td>".$row["zip_postal_code"]."</td>";
            echo "<td>".$row["country_region"]."</td>";
            echo "<td>".$row["web_page"]."</td>";
            echo "<td>".$row["notes"]."</td>";
            echo "<td>".$row["attachments"]."</td>";
            echo "<td>
                    <a href='update.php?id=".$row["id"]."' class='button action-button update-button'>Update</a>
                    <a href='delete.php?id=".$row["id"]."' class='button action-button delete-button'>Delete</a>
                  </td>";
        echo "</tr>";
    }

    echo "</table><br>";
    echo "<form action='add.php' method='post'>
            <button type='submit' class='button'>Add New Record</button>
          </form><br>";
} else {
    echo "0 results for customers.";
}

$sql2 = "
    SELECT od.*, os.status_name 
    FROM order_details od 
    JOIN order_details_status os ON od.status_id = os.id 
    WHERE os.status_name = 'invoiced'";
$result_orders = $conn->query($sql2);

if ($result_orders->num_rows > 0) {
    echo "<h2>Table 2: Status Invoiced</h2>";
    
    echo "<table border='1' cellspacing='0' cellpadding='4'>
            <tr>
                <th>ID</th>
                <th>ORDER ID</th>
                <th>PRODUCT ID</th>
                <th>QUANTITY</th>
                <th>UNIT PRICE</th>
                <th>DISCOUNT</th>
                <th>STATUS ID</th>
                <th>DATE ALLOCATED</th>
                <th>PURCHASE ORDER ID</th>
                <th>INVENTORY ID</th>
                <th>STATUS</th>
            </tr>";

    while ($row = $result_orders->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["order_id"]."</td>";
            echo "<td>".$row["product_id"]."</td>";
            echo "<td>".$row["quantity"]."</td>";
            echo "<td>".$row["unit_price"]."</td>";
            echo "<td>".$row["discount"]."</td>";
            echo "<td>".$row["status_id"]."</td>";
            echo "<td>".$row["date_allocated"]."</td>";
            echo "<td>".$row["purchase_order_id"]."</td>";
            echo "<td>".$row["inventory_id"]."</td>";
            echo "<td>".$row["status_name"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results for invoiced orders.";
}

$sql3 = "
    SELECT 
        s.id AS supplier_id,
        s.company,
        s.state_province,
        po.supplier_id,
        po.shipping_fee,
        po.expected_date,
        pod.purchase_order_id,
        pod.quantity,
        pod.unit_cost
    FROM 
        suppliers s
    JOIN 
        purchase_orders po ON s.id = po.supplier_id
    JOIN 
        purchase_order_details pod ON po.id = pod.purchase_order_id
    WHERE 
        s.id IN (7, 4)";
$result_suppliers_orders = $conn->query($sql3);

if ($result_suppliers_orders->num_rows > 0) {
    echo "<h2>Table 3: Supplier Purchase Order Details</h2>";
    
    echo "<table border='1' cellspacing='0' cellpadding='4'>
            <tr>
                <th>SUPPLIER ID</th>
                <th>COMPANY NAME</th>
                <th>STATE PROVINCE</th>
                <th>SHIPPING FEE</th>
                <th>EXPECTED DATE</th>
                <th>PURCHASE ORDER ID</th>
                <th>QUANTITY</th>
                <th>UNIT COST</th>
            </tr>";

    while ($row = $result_suppliers_orders->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row["supplier_id"]."</td>";
            echo "<td>".$row["company"]."</td>";
            echo "<td>".$row["state_province"]."</td>";
            echo "<td>".$row["shipping_fee"]."</td>";
            echo "<td>".$row["expected_date"]."</td>";
            echo "<td>".$row["purchase_order_id"]."</td>";
            echo "<td>".$row["quantity"]."</td>";
            echo "<td>".$row["unit_cost"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results for suppliers with IDs 7 and 4.";
}

$conn->close();
?>
