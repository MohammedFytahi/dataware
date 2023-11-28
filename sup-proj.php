<?php

if (isset($_GET['id'])) {
    $projetId = $_GET['id'];

    // Connect to the database (Assuming you already have a $con connection)
    include 'connexion.php';

    // Implement deletion logic
    $query = "DELETE FROM projets WHERE id_projet = $projetId";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Redirect to the main page for projects
        header("Location: project.php");
        exit();
    } else {
        echo "Error deleting project: " . mysqli_error($con);
    }
} else {
    echo "Project ID not provided.";
}
?>
