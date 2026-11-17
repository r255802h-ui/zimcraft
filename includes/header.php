<?php
if (!isset($pageTitle)) {
    $pageTitle = "ZimCraft";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> | ZimCraft</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
    <a class="logo" href="index.php">
        <span>✦</span> ZimCraft
    </a>

    <nav>
        <a href="index.php">Home</a>
        <a href="discover.php">Discover Crafts</a>
        <a href="about.php">About ZimCraft</a>
        <a href="register.php">Become a Seller</a>
    </nav>

    <div class="location-label">
        Harare, Zimbabwe
    </div>
</header>

<main>