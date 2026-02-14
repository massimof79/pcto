<?php
// api_tutor.php
declare(strict_types=1);

require __DIR__ . "/config.php";

header("Content-Type: application/json; charset=utf-8");

function json_response(int $status, array $payload): void {
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    // Lettura: lista tutor (con ordinamento)
    try {
        $stmt = $pdo->query("
            SELECT codice_tutor, cognome, nome, email, ruolo
            FROM TUTOR_AZIENDALE
            ORDER BY cognome, nome
        ");
        $rows = $stmt->fetchAll();
        json_response(200, ["ok" => true, "data" => $rows]);
    } catch (Throwable $e) {
        json_response(500, ["ok" => false, "error" => "Errore lettura dati."]);
    }
}

if ($method === "POST") {
    // Inserimento: accetta JSON
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        json_response(400, ["ok" => false, "error" => "JSON non valido."]);
    }

    $cognome = trim((string)($data["cognome"] ?? ""));
    $nome    = trim((string)($data["nome"] ?? ""));
    $email   = trim((string)($data["email"] ?? ""));
    $ruolo   = trim((string)($data["ruolo"] ?? ""));

    // Validazioni minime
    if ($cognome === "" || $nome === "" || $email === "" || $ruolo === "") {
        json_response(422, ["ok" => false, "error" => "Compila tutti i campi."]);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        json_response(422, ["ok" => false, "error" => "Email non valida."]);
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO TUTOR_AZIENDALE (cognome, nome, email, ruolo)
            VALUES (:cognome, :nome, :email, :ruolo)
        ");
        $stmt->execute([
            ":cognome" => $cognome,
            ":nome"    => $nome,
            ":email"   => $email,
            ":ruolo"   => $ruolo,
        ]);

        $id = (int)$pdo->lastInsertId();

        json_response(201, [
            "ok" => true,
            "message" => "Tutor inserito.",
            "codice_tutor" => $id
        ]);
    } catch (PDOException $e) {
        // 1062 = duplicate key (es. email UNIQUE)
        if ((int)($e->errorInfo[1] ?? 0) === 1062) {
            json_response(409, ["ok" => false, "error" => "Email già presente (vincolo UNIQUE)."]);
        }
        json_response(500, ["ok" => false, "error" => "Errore inserimento dati."]);
    } catch (Throwable $e) {
        json_response(500, ["ok" => false, "error" => "Errore inserimento dati."]);
    }
}

json_response(405, ["ok" => false, "error" => "Metodo non consentito."]);
