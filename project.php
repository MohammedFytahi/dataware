<?php
include 'connexion.php';

// Fetch all projects from the database
$sql = "SELECT * FROM projets";
$result = mysqli_query($con, $sql);

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Projets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
<div class="container mx-auto bg-white p-8 rounded-md shadow-md">
    <h1 class="text-2xl font-bold mb-4">Tableau des Projets</h1>

    <!-- Bouton pour ajouter un nouveau projet -->
    <a href="add-proj.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Ajouter un nouveau projet
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="bg-white p-6 rounded-md shadow-md">
                <h2 class="text-xl font-bold mb-2"><?= $row['nom_projet'] ?></h2>
                <p class="text-gray-500 mb-4"><?= $row['description'] ?></p>
                <p class="text-gray-500 mb-4">Date de début: <?= $row['date_debut'] ?></p>
                <p class="text-gray-500 mb-4">Date de fin: <?= $row['date_fin'] ?></p>
                <p class="text-gray-500 mb-4">Statut: <?= $row['statut'] ?></p>
                <div class="flex">
                    <a href='modif-proj.php?id=<?= $row['id_projet'] ?>' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Modifier
                    </a>
                    <a href='sup-proj.php?id=<?= $row['id_projet'] ?>' class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Supprimer
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
