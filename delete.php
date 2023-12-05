<?php
include "connexion.php";

// Check if the team ID is provided in the URL parameters
if (isset($_GET['id'])) {
    $teamId = $_GET['id'];

    // Start a transaction
    mysqli_autocommit($con, false);

    // SQL query to delete projects associated with the team
    $deleteProjectsQuery = "DELETE FROM projets WHERE equipe_id = $teamId";
    $resultProjects = mysqli_query($con, $deleteProjectsQuery);

    // Check if the projects deletion was successful
    if ($resultProjects) {
        // SQL query to delete the team
        $deleteTeamQuery = "DELETE FROM equipe WHERE id_equipe = $teamId";
        $resultTeam = mysqli_query($con, $deleteTeamQuery);

        // Check if the team deletion was successful
        if ($resultTeam) {
            // Commit the transaction
            mysqli_commit($con);
            header("location:equipe.php");
        } else {
            // Rollback the transaction in case of an error
            mysqli_rollback($con);
            echo "Error deleting team: " . mysqli_error($con);
        }
    } else {
        // Rollback the transaction in case of an error
        mysqli_rollback($con);
        echo "Error deleting associated projects: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo "Team ID not provided.";
}
?>
