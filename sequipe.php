<?php
// Inclure le fichier de connexion à la base de données (connexion.php)
include "connexion.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_equipe = $_POST["id_equipe"];
    $id_user = $_POST["id_user"];

    // Mettre à jour le champ nom_equipe dans la table users
    $updateQuery = "UPDATE users SET nom_equipe = NULL WHERE id_user = $id_user AND nom_equipe = (SELECT nom_equipe FROM equipe WHERE id_equipe = $id_equipe)";
    $resultUpdate = mysqli_query($con, $updateQuery);

    if ($resultUpdate) {
        echo "Membre retiré de l'équipe avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du champ nom_equipe : " . mysqli_error($con);
    }
}

// Récupérer les données des équipes depuis la base de données (exemple)
$queryEquipe = "SELECT * FROM equipe";
$resultEquipe = mysqli_query($con, $queryEquipe);

// Récupérer les données des utilisateurs dans une équipe depuis la base de données (exemple)
$queryUserInEquipe = "SELECT * FROM users WHERE nom_equipe IS NOT NULL";
$resultUserInEquipe = mysqli_query($con, $queryUserInEquipe);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Les balises head avec les métadonnées, les styles, etc. -->
    <title>Retirer Membre d'Équipe</title>
    <!-- Inclure la feuille de style de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header, navigation, ou d'autres éléments communs -->

    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold my-4">Retirer Membre d'Équipe</h2>

        <!-- Formulaire pour retirer un utilisateur d'une équipe -->
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
                <label for="id_user" class="block text-gray-700 text-sm font-bold mb-2">Sélectionner Membre à Retirer:</label>
                <select id="id_user" name="id_user" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php while ($rowUserInEquipe = mysqli_fetch_assoc($resultUserInEquipe)) : ?>
                        <option value="<?php echo $rowUserInEquipe['id_user']; ?>"><?php echo $rowUserInEquipe['nom'] . ' ' . $rowUserInEquipe['prenom']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Retirer de l'équipe
                </button>
            </div>
        </form>
    </div>

    <!-- Footer ou autres éléments communs -->

</body>

</html>
