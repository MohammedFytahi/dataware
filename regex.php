<?php 
include("connexion.php");
session_start();

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

   
    $query = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        header("location: interface.php");
        exit();
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
?>
