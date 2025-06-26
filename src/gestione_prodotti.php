<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prodotti</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f8f8f8;
            padding: 2rem;
        }
        .container {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .azioni a {
            margin-right: 1rem;
            text-decoration: none;
            color: #1abc9c;
            font-weight: bold;
        }
        .azioni a:hover {
            text-decoration: underline;
        }
        .aggiungi {
            display: inline-block;
            margin-bottom: 1rem;
            background: #1abc9c;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Gestione Prodotti</h2>
    <a class="aggiungi" href="aggiungi_prodotto.php">➕ Aggiungi nuovo prodotto</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Prezzo</th>
            <th>Azioni</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "luxardo");
        $result = $conn->query("SELECT * FROM prodotti");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['categoria']}</td>
                    <td>€ ".number_format($row['prezzo'], 2, ',', '.')."</td>
                    <td class='azioni'>
                        <a href='modifica_prodotto.php?id={$row['id']}'>✏️ Modifica</a>
                        <a href='elimina_prodotto.php?id={$row['id']}' onclick=\"return confirm('Sei sicuro?')\">❌ Elimina</a>
                    </td>
                </tr>";
        }
        $conn->close();
        ?>
    </table>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
