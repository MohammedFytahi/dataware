<?php
// Inclure le fichier de connexion à la base de données (connexion.php)
include "connexion.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_equipe = $_POST["id_equipe"];
    $id_user = $_POST["id_user"];

    // Vérifier si l'utilisateur et l'équipe existent
    $userQuery = "SELECT * FROM users WHERE id_user = $id_user";
    $equipeQuery = "SELECT * FROM equipe WHERE id_equipe = $id_equipe";

    $userResult = mysqli_query($con, $userQuery);
    $equipeResult = mysqli_query($con, $equipeQuery);

    if (mysqli_num_rows($userResult) > 0 && mysqli_num_rows($equipeResult) > 0) {
        // Mettre à jour le champ nom_equipe dans la table users
        $updateQuery = "UPDATE users SET nom_equipe = (SELECT nom_equipe FROM equipe WHERE id_equipe = $id_equipe) WHERE id_user = $id_user";
        $resultUpdate = mysqli_query($con, $updateQuery);

        if ($resultUpdate) {
            echo "Utilisateur ajouté à l'équipe avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du champ nom_equipe : " . mysqli_error($con);
        }
    } else {
        echo "L'utilisateur ou l'équipe n'existe pas.";
    }
}

// Récupérer les données des équipes depuis la base de données (exemple)
$queryEquipe = "SELECT * FROM equipe";
$resultEquipe = mysqli_query($con, $queryEquipe);

// Récupérer les données des utilisateurs depuis la base de données (exemple)
$queryUser = "SELECT * FROM users";
$resultUser = mysqli_query($con, $queryUser);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Les balises head avec les métadonnées, les styles, etc. -->
    <title>Ajouter Utilisateur à Équipe</title>
    <!-- Inclure la feuille de style de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header, navigation, ou d'autres éléments communs -->

    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold my-4">Ajouter Utilisateur à Équipe</h2>

        <!-- Formulaire pour ajouter un utilisateur à une équipe -->
        <form method="post" class="space-y-4">
            <div class="mb-4">
                <label for="id_equipe" class="block text-gray-700 text-sm font-bold mb-2">Sélectionner Équipe:</label>
                <select id="id_equipe" name="id_equipe" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php while ($rowEquipe = mysqli_fetch_assoc($resultEquipe)) : ?>
                        <option value="<?php echo $rowEquipe['id_equipe']; ?>"><?php echo $rowEquipe['nom_equipe']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="id_user" class="block text-gray-700 text-sm font-bold mb-2">Sélectionner Utilisateur:</label>
                <select id="id_user" name="id_user" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php while ($rowUser = mysqli_fetch_assoc($resultUser)) : ?>
                        <option value="<?php echo $rowUser['id_user']; ?>"><?php echo $rowUser['nom'] . ' ' . $rowUser['prenom']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Ajouter à l'équipe
                </button>
            </div>
        </form>
    </div>

    <!-- Footer ou autres éléments communs -->

</body>

</html>
