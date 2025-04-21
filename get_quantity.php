<?php
// Include config.php
@include 'config.php';

// Check if medicine name is provided in the AJAX request
if(isset($_GET['medicine_name'])){
    $medicine_name = $_GET['medicine_name'];

    // Query to fetch the total quantity of the medicine from the cart
    $select_quantity = mysqli_query($conn, "SELECT SUM(quantity) as total_quantity FROM `cart` WHERE name = '$medicine_name'");
    
    if(mysqli_num_rows($select_quantity) > 0){
        $fetch_quantity = mysqli_fetch_assoc($select_quantity);
        // Return the total quantity of the medicine
        echo $fetch_quantity['total_quantity'];
    } else {
        // Return 0 if the medicine is not found in the cart
        echo 0;
    }
} else {
    // Return an error message if the medicine name is not provided
    echo "Error: Medicine name not provided.";
}
?>








<html>
<body>


<!-- Add this script tag to include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // Function to update available quantity using AJAX
    function updateAvailableQuantity(medicineName, container){
        $.ajax({
            type: 'GET',
            url: 'get_quantity.php',
            data: { medicine_name: medicineName },
            success: function(response){
                container.find('.quantity').text('Available: ' + response);
            }
        });
    }

    // Event listener for add to cart button
    $('form').submit(function(e){
        e.preventDefault(); // Prevent form submission
        
        var form = $(this);
        var medicineName = form.find('input[name="medicine_name"]').val();
        var container = form.closest('.box');
        
        // Call function to update available quantity
        updateAvailableQuantity(medicineName, container);

        // Submit form
        form.unbind('submit').submit();
    });
});
</script>
</body>
</html>