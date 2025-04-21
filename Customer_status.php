<!DOCTYPE html>
<html>
<head>
   
    <title>Medical Store Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("customer_status.jpeg");
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 90%; 
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ddd; 
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: blue; 
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        select, button {
            padding: 8px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            margin-right: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        /* Home Button */
        .home-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .home-btn:hover {
            background-color: #0056b3;
      
        }
    </style>
</head>
<body>
    <h1>Medical Store Status</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Medicine Details</th>
            <th>Status</th>
        </tr>
        <?php
        $db_connection = mysqli_connect("localhost", "root", "", "shop_db");
        
        if (!$db_connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $query = "SELECT * FROM `order`"; 
        $result = mysqli_query($db_connection, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['total_medicines'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "</tr>";
        }
        
        mysqli_close($db_connection);
        ?>
    </table>
    <!-- Home Button -->
    <a href="customer_home.html" class="home-btn">Home</a>
</body>
</html>
