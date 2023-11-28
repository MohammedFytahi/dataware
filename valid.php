<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];
include 'connexion.php';

$requete = "INSERT INTO users (nom, prenom, email, password) VALUES ('$nom', '$prenom', '$email', '$password')";
$query = mysqli_query($con, $requete);

if ($query) {
    header("location:index.php");
} else {
    echo "<h1>Erreur</h1>";
}
?>
