<?php

include 'connexion.php';

if (isset($_GET['id'])) {
    $projetId = $_GET['id'];

    $query = "SELECT * FROM projets WHERE id_projet = $projetId";
    $result = mysqli_query($con, $query);

    if ($result) {
        $projetData = mysqli_fetch_assoc($result);
    } else {
        echo "Error retrieving project data: " . mysqli_error($con);
        exit();
    }
} else {
    echo "Project ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedNomProjet = $_POST['updated_nom_projet'];
    $updatedDescription = $_POST['updated_description'];
    $updatedDateDebut = $_POST['updated_date_debut'];
    $updatedDateFin = $_POST['updated_date_fin'];
    $updatedStatut = $_POST['updated_statut'];

    $updateQuery = "UPDATE projets SET nom_projet = '$updatedNomProjet', description = '$updatedDescription', date_debut = '$updatedDateDebut', date_fin = '$updatedDateFin', statut = '$updatedStatut' WHERE id_projet = $projetId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        header("Location: tableau_projets.php");
        exit();
    } else {
        echo "Error updating project: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Projet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-200">
    <h2 class="text-center font-bold text-3xl m-10">Modifier Information Projet</h2>

    <div class="container mx-auto bg-white p-8 rounded-md shadow-md max-w-md">
        <form method="post" class="space-y-4">
            <div class="mb-4">
                <label for="updated_nom_projet" class="block text-gray-700 text-sm font-bold mb-2">Nom Projet:</label>
                <input type="text" id="updated_nom_projet" name="updated_nom_projet" value="<?= $projetData['nom_projet'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="updated_description" name="updated_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $projetData['description'] ?></textarea>
            </div>

            <div class="mb-4">
                <label for="updated_date_debut" class="block text-gray-700 text-sm font-bold mb-2">Date de début:</label>
                <input type="date" id="updated_date_debut" name="updated_date_debut" value="<?= $projetData['date_debut'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_date_fin" class="block text-gray-700 text-sm font-bold mb-2">Date de fin:</label>
                <input type="date" id="updated_date_fin" name="updated_date_fin" value="<?= $projetData['date_fin'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_statut" class="block text-gray-700 text-sm font-bold mb-2">Statut:</label>
                <select id="updated_statut" name="updated_statut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="en_cours" <?= ($projetData['statut'] == 'en_cours') ? 'selected' : '' ?>>En Cours</option>
                    <option value="finalise" <?= ($projetData['statut'] == 'finalise') ? 'selected' : '' ?>>Finalisé</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
                <a href="project.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>
</html>
