<?php
// delete.php

echo $_GET['id'];


if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    

    // Connect to the database (Assuming you already have a $con connection)
    include 'connexion.php';

    // Implement deletion logic
    $query = "DELETE FROM users WHERE id_user = $userId";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Redirect to the main page
        header("Location: interface.php");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    echo "User ID not provided.";
}
?>
