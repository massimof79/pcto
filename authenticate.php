<?php
require "config.php";

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM utenti WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(["username" => $username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    header("Location: dashboard.php");
    exit;
} else {
    echo "Credenziali non valide";
}
