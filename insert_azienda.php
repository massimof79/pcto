<?php
header("Content-Type: application/json");
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (
    empty($data["ragione_sociale"]) ||
    empty($data["partita_iva"]) ||
    empty($data["sede_legale"]) ||
    empty($data["sede_operativa"])
) {
    http_response_code(400);
    echo json_encode(["errore" => "Dati mancanti"]);
    exit;
}

$sql = "INSERT INTO AZIENDA (ragione_sociale, partita_iva, sede_legale, sede_operativa)
        VALUES (:ragione_sociale, :partita_iva, :sede_legale, :sede_operativa)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ":ragione_sociale" => $data["ragione_sociale"],
        ":partita_iva"     => $data["partita_iva"],
        ":sede_legale"     => $data["sede_legale"],
        ":sede_operativa"  => $data["sede_operativa"]
    ]);

    echo json_encode(["successo" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["errore" => "Errore inserimento (forse partita IVA duplicata)"]);
}
?>
