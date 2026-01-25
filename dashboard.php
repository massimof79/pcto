<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h2>Benvenuto <?php echo $_SESSION["username"]; ?></h2>

<ul>
    <li><a href="insert_compagnia.php">Inserisci compagnia aerea</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
