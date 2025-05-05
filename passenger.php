<?php 
// Include the database connection file
include 'pdb.php';
session_start();  // Start the session to access session variables

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data (as arrays)
    $names = $_POST['name'];
    $mobiles = $_POST['mobile'];
    $bus_ids = $_POST['bus_id'];
    $destinations = $_POST['destination'];

    // Get the logged-in user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Store only the first set of data (assuming that's the signed-in user's details)
    $passenger_name = $names[0];
    $passenger_mobile = $mobiles[0];
    $bus_id = $bus_ids[0];
    $destination = $destinations[0];

    // Insert passenger data into the database (only for the user)
    $sql = "INSERT INTO passengers (name, mobile, bus_id, destination, user_id) 
            VALUES ('$passenger_name', '$passenger_mobile', '$bus_id', '$destination', '$user_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Passenger details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the DB connection
mysqli_close($conn);
?>
