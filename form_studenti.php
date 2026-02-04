<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Inserimento Studente</title>
    <script>
        function validaForm() {
            const email = document.forms["formStudente"]["email"].value;
            const data = document.forms["formStudente"]["data_di_nascita"].value;

            if (!email.includes("@")) {
                alert("Email non valida");
                return false;
            }

            if (data === "") {
                alert("Inserire la data di nascita");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<h2>Nuovo Studente</h2>

<form name="formStudente" action="salva_studente.php" method="POST" onsubmit="return validaForm()">

    Nome: <input type="text" name="nome" required><br><br>
    Cognome: <input type="text" name="cognome" required><br><br>
    Data di nascita: <input type="date" name="data_di_nascita" required><br><br>
    Luogo di nascita: <input type="text" name="luogo_di_nascita" required><br><br>
    Indirizzo: <input type="text" name="indirizzo" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Classe: <input type="text" name="classe" required><br><br>
    Indirizzo di studi: <input type="text" name="indirizzo_di_studi" required><br><br>

    Codice esperienza (opzionale): <input type="number" name="codice_esperienza"><br><br>
    Codice candidatura (opzionale): <input type="number" name="codice_candidatura"><br><br>

    <button type="submit">Salva Studente</button>

</form>

</body>
</html>
