<?php
include "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    if (isset($_POST["project"]) && isset($_POST["team"])) {
        $selectedProject = $_POST["project"];
        $selectedTeam = $_POST["team"];

       
        echo "Projet sélectionné : " . $selectedProject . "<br>";
        echo "Équipe sélectionnée : " . $selectedTeam . "<br>";

        // Ajouter le code d'exécution de la requête SQL ici
        $query = "UPDATE equipe SET id_projet = '$selectedProject' WHERE id_equipe = '$selectedTeam'";
        mysqli_query($con, $query);

        // Redirection vers la page d'affectation après la mise à jour
        header("Location: equipe.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Les données du formulaire ne sont pas définies.";
    }
}





$queryProjects = "SELECT * FROM projets";
$queryTeams = "SELECT * FROM equipe";

$resultProjects = mysqli_query($con, $queryProjects);
$resultTeams = mysqli_query($con, $queryTeams);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Affecter Projet</title>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold my-4">Affecter Projet</h2>

        <form method="post" action="affecte.php" class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <div class="mb-4">
                <label for="project" class="block text-gray-700 text-sm font-bold mb-2">Sélectionner un projet:</label>
                <select name="project" id="project" class="w-full p-2 border rounded-md">
                    <?php while ($rowProject = mysqli_fetch_assoc($resultProjects)) : ?>
                        <option value="<?php echo $rowProject['id_projet']; ?>"><?php echo $rowProject['nom_projet']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="team" class="block text-gray-700 text-sm font-bold mb-2">Sélectionner une équipe:</label>
                <select name="team" id="team" class="w-full p-2 border rounded-md">
                    <?php while ($rowTeam = mysqli_fetch_assoc($resultTeams)) : ?>
                        <option value="<?php echo $rowTeam['id_equipe']; ?>"><?php echo $rowTeam['nom_equipe']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="bg-gray-800 text-white font-bold py-2 px-4 rounded-md hover:bg-gray-600 focus:outline-none focus:shadow-outline-gray active:bg-gray-800">Affecter Projet</button>
        </form>
    </div>
</body>

</html>
