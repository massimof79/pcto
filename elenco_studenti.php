<?php
require_once "db.php";

$sql = "SELECT 
            codice_studente,
            nome,
            cognome,
            data_di_nascita,
            luogo_di_nascita,
            indirizzo,
            email,
            classe,
            indirizzo_di_studi,
            codice_esperienza,
            codice_candidatura
        FROM STUDENTE
        ORDER BY cognome, nome";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Studenti</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #fafafa; }
    </style>
</head>
<body>

<h2>Elenco Studenti</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data di nascita</th>
            <th>Luogo di nascita</th>
            <th>Indirizzo</th>
            <th>Email</th>
            <th>Classe</th>
            <th>Indirizzo di studi</th>
            <th>Cod. Esperienza</th>
            <th>Cod. Candidatura</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row["codice_studente"]) ?></td>
                <td><?= htmlspecialchars($row["nome"]) ?></td>
                <td><?= htmlspecialchars($row["cognome"]) ?></td>
                <td><?= htmlspecialchars($row["data_di_nascita"]) ?></td>
                <td><?= htmlspecialchars($row["luogo_di_nascita"]) ?></td>
                <td><?= htmlspecialchars($row["indirizzo"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
                <td><?= htmlspecialchars($row["classe"]) ?></td>
                <td><?= htmlspecialchars($row["indirizzo_di_studi"]) ?></td>
                <td><?= htmlspecialchars($row["codice_esperienza"] ?? "") ?></td>
                <td><?= htmlspecialchars($row["codice_candidatura"] ?? "") ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
<?php else: ?>
    <p>Nessuno studente presente nel database.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
