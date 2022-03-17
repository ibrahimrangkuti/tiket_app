<?php include 'includes/functions.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tiket</title>
</head>

<body>
    <div class="container">
        <nav>
            <div class="logo">
                <a href="">Tiket</a>
            </div>

            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="">Destinasi</a>
                </li>
                <li>
                    <a href="">Hotel</a>
                </li>
                <?php if (!isset($_SESSION['login'])) : ?>
                    <li>
                        <a href="signin.php">Sign In</a>
                    </li>
                    <li>
                        <a href="signup.php" class="btn-primary">Sign Up</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="logout.php" class="btn-primary">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>