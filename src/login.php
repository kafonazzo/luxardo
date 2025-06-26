<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: gestione_prodotti.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #f0f0f0;
        }
        .login-box {
            max-width: 400px;
            margin: 8rem auto;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        input, button {
            width: 100%;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        button {
            background-color: #1abc9c;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login Area Riservata</h2>
    <form action="login_process.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Accedi</button>
    </form>
    <?php if (isset($_GET['error'])) echo "<p style='color:red;'>".htmlspecialchars($_GET['error'])."</p>"; ?>
</div>
</body>
</html>
