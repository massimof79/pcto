<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    die("Accesso non autorizzato");
}

$sql = "INSERT INTO compagnie 
        (codice_iata, nome, paese_origine, anno_fondazione)
        VALUES (:codice, :nome, :paese, :anno)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "codice" => $_POST["codice"],
    "nome"   => $_POST["nome"],
    "paese"  => $_POST["paese"],
    "anno"   => $_POST["anno"]
]);

echo "Compagnia inserita correttamente";
