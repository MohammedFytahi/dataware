
<?php
include "connexion.php";

if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $nomProjet = $_POST["nom_projet"];
    $description = $_POST["description"];
    $dateDebut = $_POST["date_debut"];
    $dateFin = $_POST["date_fin"];
    $statut = $_POST["statut"];
   
    

    // Insérer le nouveau projet dans la table `projets`
    $requeteProjet = "INSERT INTO projets (nom_projet, description, date_debut, date_fin, statut) VALUES ('$nomProjet', '$description', '$dateDebut', '$dateFin', '$statut')";
    
    // Exécuter la requête
    $queryProjet = mysqli_query($con, $requeteProjet);

    if ($queryProjet) {
        echo "Le projet a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du projet : " . mysqli_error($con);
    }
}

// Récupérer la liste des équipes pour le formulaire
$queryEquipes = mysqli_query($con, "SELECT id_equipe, nom_equipe FROM equipe");
$equipes = [];
while ($equipe = mysqli_fetch_assoc($queryEquipes)) {
    $equipes[] = $equipe;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Projet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Ajouter ici les liens vers les fichiers CSS ou d'autres dépendances -->
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Créer un Projet</h1>
        <form method="post" action="" class="max-w-md">
            <label for="nom_projet" class="block mb-2">Nom du Projet:</label>
            <input type="text" name="nom_projet" required class="w-full px-3 py-2 border rounded mb-3" />

            <label for="description" class="block mb-2">Description:</label>
            <textarea name="description" class="w-full px-3 py-2 border rounded mb-3"></textarea>

            <label for="date_debut" class="block mb-2">Date de Début:</label>
            <input type="date" name="date_debut" required class="w-full px-3 py-2 border rounded mb-3" />

            <label for="date_fin" class="block mb-2">Date de Fin:</label>
            <input type="date" name="date_fin" required class="w-full px-3 py-2 border rounded mb-3" />

            <div class="mb-4">
    <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut:</label>
    <select id="statut" name="statut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="en_cours">En Cours</option>
        <option value="finalise">Finalisé</option>
    </select>
</div>


          

            <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter le Projet</button>
        </form>
    </div>
    <!-- Ajouter ici d'autres éléments de l'interface utilisateur si nécessaire -->
</body>

</html>

