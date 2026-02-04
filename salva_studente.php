<?php
require_once "db.php";

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$data = $_POST["data_di_nascita"];
$luogo = $_POST["luogo_di_nascita"];
$indirizzo = $_POST["indirizzo"];
$email = $_POST["email"];
$classe = $_POST["classe"];
$indirizzo_studi = $_POST["indirizzo_di_studi"];

$codice_esperienza = !empty($_POST["codice_esperienza"]) ? $_POST["codice_esperienza"] : null;
$codice_candidatura = !empty($_POST["codice_candidatura"]) ? $_POST["codice_candidatura"] : null;

$sql = "INSERT INTO STUDENTE 
(nome, cognome, data_di_nascita, luogo_di_nascita, indirizzo, email, classe, indirizzo_di_studi, codice_esperienza, codice_candidatura)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssii",
    $nome,
    $cognome,
    $data,
    $luogo,
    $indirizzo,
    $email,
    $classe,
    $indirizzo_studi,
    $codice_esperienza,
    $codice_candidatura
);

if ($stmt->execute()) {
    echo "Studente inserito con successo.";
} else {
    echo "Errore: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
