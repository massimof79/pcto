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
    <title>Inserimento compagnia</title>
</head>
<body>

<h2>Nuova compagnia aerea</h2>

<form id="compagniaForm">
    <label>Codice IATA</label><br>
    <input type="text" name="codice" required><br><br>

    <label>Nome</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Paese</label><br>
    <input type="text" name="paese" required><br><br>

    <label>Anno di fondazione</label><br>
    <input type="number" name="anno" required><br><br>

    <button type="submit">Inserisci</button>
</form>

<p id="esito"></p>

<script>
document.getElementById("compagniaForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("insert_compagnia_server.php", {
        method: "POST",
        body: formData
    })
    .then(r => r.text())
    .then(data => document.getElementById("esito").innerText = data);
});
</script>

</body>
</html>
