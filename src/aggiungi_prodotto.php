<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "luxardo");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $prezzo = floatval($_POST['prezzo']);

    if ($nome === '' || $categoria === '' || $prezzo <= 0) {
        $error = "Compila tutti i campi correttamente.";
    } else {
        $stmt = $conn->prepare("INSERT INTO prodotti (nome, categoria, prezzo) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $nome, $categoria, $prezzo);
        $stmt->execute();
        $stmt->close();
        header("Location: gestione_prodotti.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <title>Aggiungi Prodotto</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f8f8f8;
            padding: 2rem;
        }
        .container {
            max-width: 500px;
            background: white;
            margin: auto;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        input, select, button {
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
        .error {
            color: red;
            margin-bottom: 1rem;
        }
        a {
            text-decoration: none;
            color: #1abc9c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Aggiungi Nuovo Prodotto</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="post" action="">
        <input type="text" name="nome" placeholder="Nome prodotto" required>
        <input type="text" name="categoria" placeholder="Categoria" required>
        <input type="number" step="0.01" name="prezzo" placeholder="Prezzo" required min="0.01">
        <button type="submit">Aggiungi</button>
    </form>
    <p><a href="gestione_prodotti.php">← Torna indietro</a></p>
</div>
</body>
</html>
