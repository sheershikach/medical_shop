<?php
// Include your database connection code or create a connection object if not already done
// $db_connection = mysqli_connect("localhost", "username", "password", "database_name");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if '0' index exists in $_POST array
    if(isset($_POST['1'])) {
        // Sanitize the input to prevent SQL injection
        $id = mysqli_real_escape_string($db_connection, $_POST['0']);

        // Fetch the selected row from orders table
        $query = "SELECT * FROM orders WHERE id = $id";
        $result = mysqli_query($db_connection, $query);

        // Check if the query executed successfully
        if($result) {
            // Fetch the row as an associative array
            $row = mysqli_fetch_assoc($result);

            // Check if the row exists
            if($row) {
                // Insert the row into destination table
                $insert_query = "INSERT INTO destination (name, description) VALUES ('" . $row['name'] . "', '" . $row['description'] . "')";
                $insert_result = mysqli_query($db_connection, $insert_query);

                // Check if the insertion was successful
                if($insert_result) {
                    // Delete the row from orders table
                    $delete_query = "DELETE FROM orders WHERE id = $id";
                    $delete_result = mysqli_query($db_connection, $delete_query);

                    // Check if the deletion was successful
                    if(!$delete_result) {
                        echo "Error deleting row: " . mysqli_error($db_connection);
                    }
                } else {
                    echo "Error inserting row: " . mysqli_error($db_connection);
                }
            } else {
                echo "Row with ID $id not found.";
            }
        } else {
            echo "Error fetching row: " . mysqli_error($db_connection);
        }
    } else {
        echo "No row ID specified.";
    }
}
?>
