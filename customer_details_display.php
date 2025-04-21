<!DOCTYPE html>
<html>
<head>
    <title>MEDICINES MANAGEMENT SYSTEM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            color: white;
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #dddddd;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: block;
            margin: auto;
            width: 150px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>MEDICINES MANAGEMENT SYSTEM</h1>

<center><h2>CUSTOMER DETAILS DISPLAY FORM</h2></center>

<?php
$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("shop_db", $con);

$records = mysql_query("SELECT * FROM `order`");
if (!$records) {
    die('Error: ' . mysql_error());
}
?>
<table>
<tr>
    <th>ID</th>
    <th>NAME</th>
    <th>NUMBER</th>
    <th>FLAT</th>
    <th>TOTAL_MEDICINES</th>
    <th>TOTAL_PRICE</th>
</tr>
<?php
while ($row = mysql_fetch_array($records)) {
    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[5] . "</td><td>" . $row[11] . "</td><td>" . $row[12] . "</td></tr>"; 
}
?>
</table>
<a href="admin_addproduct.php">BACK</a><br><br>
</body>
</html>
