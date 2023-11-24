<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
include 'connexion.php';

$requete = "INSERT INTO users (nom, prenom, email) VALUES ('$nom', '$prenom', '$email')";
$query = mysqli_query($con, $requete);

if ($query) {
    echo '<a href="index.php" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">login</a>';
} else {
    echo "<h1>Erreur</h1>";
}
?>
