<?php
require './user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User('', $_POST['email'], '', '');
    $user->login($_POST['email'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" value="Login" name="login">
    </form>
    <a href="register.php">Sign up</a>
</div>
</body>
</html>
