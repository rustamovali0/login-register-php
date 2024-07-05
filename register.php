<?php
require_once './db.php';
require_once './user.php';

$emailError = '';
$passwordError = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    if ($user->emailExists($_POST['email'])) {
        $emailError = "Email already exists in the database.";
    }
    if ($_POST['password'] != $_POST['confirm_password']) {
        $passwordError = "Passwords do not match.";
    } else {
        $user->create();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Register</h1>
    <form action="" method="post">
        <input type="text" placeholder="Name" name="name" required>
        <input type="email" placeholder="Email" name="email" required>
        <?php
        if ($emailError != null) {
            echo "<p style='color: red; text-align: left'>$emailError</p>";
        }
        ?>
        <input type="password" placeholder="Password" name="password" required>
        <input type="password" placeholder="Confirm Password" name="confirm_password" required>
        <?php
        if ($passwordError != null) {
            echo "<p style='color: red; text-align: left'>$passwordError</p>";
        }
        ?>
        <input type="submit" value="Register" >
    </form>

    <a href="index.php">Login</a>
</div>
</body>
</html>
