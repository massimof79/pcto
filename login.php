<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Accesso al sistema</h2>

<form action="authenticate.php" method="post">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Accedi</button>
</form>

</body>
</html>
