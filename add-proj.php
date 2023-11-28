<?php
// Inclure le fichier de connexion à la base de données (connexion.php)
include "connexion.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_projet = $_POST["nom_projet"];
    $description = $_POST["description"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $statut = $_POST["statut"];

    // Insertion des données dans la table projets
    $insertQuery = "INSERT INTO projets (nom_projet, description, date_debut, date_fin, statut) VALUES ('$nom_projet', '$description', '$date_debut', '$date_fin', '$statut')";
    $resultInsert = mysqli_query($con, $insertQuery);

    if ($resultInsert) {
        echo "Projet ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du projet : " . mysqli_error($con);
    }
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Les balises head avec les métadonnées, les styles, etc. -->
    <title>Ajouter Projet</title>
    <!-- Inclure la feuille de style de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header, navigation, ou d'autres éléments communs -->

    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold my-4">Ajouter Projet</h2>

        <!-- Formulaire pour ajouter un nouveau projet -->
        <form method="post" class="space-y-4">
            <div class="mb-4">
                <label for="nom_projet" class="block text-gray-700 text-sm font-bold mb-2">Nom du Projet:</label>
                <input type="text" id="nom_projet" name="nom_projet" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700 text-sm font-bold mb-2">Date de Début:</label>
                <input type="date" id="date_debut" name="date_debut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700 text-sm font-bold mb-2">Date de Fin:</label>
                <input type="date" id="date_fin" name="date_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
    <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut:</label>
    <select id="statut" name="statut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="en_cours">En Cours</option>
        <option value="finalise">Finalisé</option>
    </select>
</div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Ajouter Projet
                </button>
            </div>
        </form>
    </div>

    <!-- Footer ou autres éléments communs -->

</body>

</html>
