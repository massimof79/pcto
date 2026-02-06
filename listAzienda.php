<?php
header("Content-Type: application/json");
require "config.php";

$sql = "SELECT codice_azienda, ragione_sociale, partita_iva, sede_legale, sede_operativa
        FROM AZIENDA
        ORDER BY ragione_sociale";

$stmt = $pdo->query($sql);
$aziende = $stmt->fetchAll();

echo json_encode($aziende);
?>
