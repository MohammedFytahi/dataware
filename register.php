<?php
include "connexion.php";

// Définir les expressions régulières
$pattern_nom_prenom = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{3,}$/u';
$pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$pattern_mot_de_passe = '/^.{8,}$/';

// Initialiser les variables pour stocker les messages d'erreur
$erreur_nom = $erreur_prenom = $erreur_email = $erreur_mot_de_passe = "";
$nom = $prenom = $email = $mot_de_passe = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["password"];

    // Valider le nom
    if (!preg_match($pattern_nom_prenom, $nom)) {
        $erreur_nom = "Veuillez entrer un nom valide (au moins 3 caractères)";
    }

    // Valider le prénom
    if (!preg_match($pattern_nom_prenom, $prenom)) {
        $erreur_prenom = "Veuillez entrer un prénom valide (au moins 3 caractères)";
    }

    // Valider l'email
    if (!preg_match($pattern_email, $email)) {
        $erreur_email = "Veuillez entrer une adresse e-mail valide.";
    }
    $user = "SELECT * FROM users where email = '$email'";
    $result = mysqli_query($con, $user);
    if (mysqli_num_rows($result) > 0) {
        $erreur_email = "Email déjà utilisé";
    }

    // Valider le mot de passe
    if (!preg_match($pattern_mot_de_passe, $mot_de_passe)) {
        $erreur_mot_de_passe = "Veuillez entrer un mot de passe valide (au moins 8 caractères)";
    }

    // Si aucune erreur, rediriger vers la page souhaitée
    if (empty($erreur_nom) && empty($erreur_prenom) && empty($erreur_email) && empty($erreur_mot_de_passe)) {
        // Remplacez "page-de-destination.php" par le chemin de votre page de destination
        $requete = "INSERT INTO users (nom, prenom, email, password) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe')";
        $query = mysqli_query($con, $requete);
        header("Location: valid.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Add Tailwind CSS link here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-400">

    <section class="vh-100 flex items-center justify-center bg-blue-400">
        <div class="container mx-auto">
            <div class="flex justify-center">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                        <h5 class="font-semibold mb-3 mt-3 pb-3 text-lg text-blue-800">Create an account</h5>

                        <div class="mb-3">
                            <input type="text" name="prenom" class="form-input w-full border rounded-md p-2" id="floatingInput" value="<?php echo $prenom; ?>" placeholder="Prénom">
                            <span class="text-red-500"><?php echo $erreur_prenom;?></span>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nom" class="form-input w-full border rounded-md p-2" id="floatingInput" value="<?php echo $nom; ?>" placeholder="Nom">
                            <span class="text-red-500"><?php echo $erreur_nom;?></span>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-input w-full border rounded-md p-2" id="floatingInput" value="<?php echo $email; ?>" placeholder="Email address">
                            <span class="text-red-500"><?php echo $erreur_email; ?></span>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-input w-full border rounded-md p-2" id="floatingPassword" placeholder="Mot de passe">
                            <span class="text-red-500"><?php echo $erreur_mot_de_passe; ?></span>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <button class="bg-blue-800 text-white px-4 py-2 rounded-lg" type="submit" name="submit">Register</button>
                        </div>

                        <p class="mt-3 text-gray-800">Have already an account? <a href="index.php" class="text-blue-800"> Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
