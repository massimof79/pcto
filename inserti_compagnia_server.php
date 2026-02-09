<?php
require "config.php";

header("Content-Type: text/plain; charset=UTF-8");

// Controllo sessione
if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    exit("Sessione non valida. Effettua il login.");
}

// Controllo metodo
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Metodo non consentito.");
}

// Recupero e pulizia dati
$codice = strtoupper(trim($_POST["codice"] ?? ""));
$nome   = trim($_POST["nome"] ?? "");
$paese  = trim($_POST["paese"] ?? "");
$anno   = intval($_POST["anno"] ?? 0);

// Validazioni
if ($codice === "" || $nome === "" || $paese === "" || $anno === 0) {
    http_response_code(400);
    exit("Tutti i campi sono obbligatori.");
}

if (!preg_match("/^[A-Z0-9]{2,3}$/", $codice)) {
    http_response_code(400);
    exit("Codice IATA non valido.");
}

if ($anno < 1900 || $anno > intval(date("Y"))) {
    http_response_code(400);
    exit("Anno di fondazione non valido.");
}

try {
    // Verifica duplicato codice IATA
    $check = $pdo->prepare("SELECT COUNT(*) FROM compagnie_aeree WHERE codice_iata = ?");
    $check->execute([$codice]);

    if ($check->fetchColumn() > 0) {
        http_response_code(409);
        exit("Esiste già una compagnia con questo codice IATA.");
    }

    // Inserimento
    $stmt = $pdo->prepare("
        INSERT INTO compagnie_aeree (codice_iata, nome, paese, anno_fondazione)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$codice, $nome, $paese, $anno]);

    echo "Compagnia aerea inserita con successo.";

} catch (PDOException $e) {
    http_response_code(500);
    echo "Errore durante l'inserimento nel database.";
}
