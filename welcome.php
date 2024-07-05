<?php

session_start();

if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            text-align: center;
            padding: 50px;
        }

        .container {
            background: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 0.5em;
        }

        p {
            font-size: 1.2em;
        }

        a {
            color: #ff7e5f;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome, <?= $_SESSION['user_name']; ?>!</h1>
    <h3>Your e-mail is, <?= $_SESSION['user_email']; ?></h3>
    <p>You have successfully registered.</p>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
