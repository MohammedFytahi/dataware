<?php

include 'connexion.php';

if (isset($_GET['id'])) {
    $equipeId = $_GET['id'];

    $query = "SELECT * FROM equipe WHERE id_equipe = $equipeId";
    $result = mysqli_query($con, $query);

    if ($result) {
        $equipeData = mysqli_fetch_assoc($result);
    } else {
        echo "Error retrieving equipe data: " . mysqli_error($con);
        exit();
    }
} else {
    echo "Equipe ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedNomEquipe = $_POST['updated_nom_equipe'];
    $updatedDescriptionEquipe = $_POST['updated_description_equipe'];

    $updateQuery = "UPDATE equipe SET nom_equipe = '$updatedNomEquipe', description_equipe = '$updatedDescriptionEquipe' WHERE id_equipe = $equipeId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        header("Location: equipe.php");
        exit();
    } else {
        echo "Error updating equipe: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Équipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-200">
    <h2 class="text-center font-bold text-3xl m-10">Modifier Information Équipe</h2>

    <div class="container mx-auto bg-white p-8 rounded-md shadow-md max-w-md">
        <form method="post" class="space-y-4">
            <div class="mb-4">
                <label for="updated_nom_equipe" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'équipe:</label>
                <input type="text" id="updated_nom_equipe" name="updated_nom_equipe" value="<?= $equipeData['nom_equipe'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_description_equipe" class="block text-gray-700 text-sm font-bold mb-2">Description de l'équipe:</label>
                <textarea id="updated_description_equipe" name="updated_description_equipe" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $equipeData['description_equipe'] ?></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
                <a href="interface.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>

</html>
