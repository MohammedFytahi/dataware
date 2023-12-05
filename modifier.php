<?php
include 'connexion.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT * FROM users WHERE id_user = $userId";
    $result = mysqli_query($con, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        echo "Error retrieving user data: " . mysqli_error($con);
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['updated_name'];
    $updatedEmail = $_POST['updated_email'];
    $updatedRole = $_POST['updated_role'];

    $updateQuery = "UPDATE users SET nom = '$updatedName', email = '$updatedEmail', role = '$updatedRole' WHERE id_user = $userId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        header("Location: interface.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-200">
    <h2 class="text-center font-bold text-3xl m-10">Modifier Information Utilisateur</h2>

    <div class="container mx-auto bg-white p-8 rounded-md shadow-md max-w-md">
        <form method="post" class="space-y-4">
            <div class="mb-4">
                <label for="updated_name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                <input type="text" id="updated_name" name="updated_name" value="<?= $userData['nom'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="updated_email" name="updated_email" value="<?= $userData['email'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="updated_role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                <select id="updated_role" name="updated_role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="user" <?= $userData['role'] === 'user' ? 'selected' : '' ?>>User</option>

                    <option value="scrum_master" <?= $userData['role'] === 'scrum_master' ? 'selected' : '' ?>>Scrum Master</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
                <a href="interface.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>

</html>
