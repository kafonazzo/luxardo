<?php
$mysqli = new mysqli("localhost", "root", "", "luxardo");
if ($mysqli->connect_error) {
    die("Connessione fallita: " . $mysqli->connect_error);
}

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$stmt = $mysqli->prepare("
    SELECT p.nome, p.descrizione, p.prezzo, p.immagine
    FROM prodotti p
    JOIN categorie c ON p.categoria_id = c.id
    WHERE c.nome = ?
");
$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($categoria); ?> - Prodotti</title>
    <link rel="stylesheet" href="style.css" />
    <script defer src="script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
</head>
<body>
<div class="wrapper">

    <nav class="navbar">
        <div class="logo">🛠️ Ferramenta Luxardo</div>
        <div class="menu-toggle" id="menu-toggle">&#9776;</div>
        <ul class="nav-links" id="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="prodotti.php?categoria=Bulloneria">Prodotti</a></li>
            <li><a href="#">Contatti</a></li>
        </ul>
    </nav>

    <main>
        <h1 class="prodotti-titolo">Prodotti: <?php echo htmlspecialchars($categoria); ?></h1>
        <div class="griglia-prodotti">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card-prodotto">
                    <img src="<?php echo htmlspecialchars($row['immagine']); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>">
                    <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                    <p><?php echo htmlspecialchars($row['descrizione']); ?></p>
                    <strong>€ <?php echo number_format($row['prezzo'], 2, ',', '.'); ?></strong>
                </div>
            <?php endwhile; ?>
            <?php $stmt->close(); $mysqli->close(); ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ferramenta Luxardo - Tutti i diritti riservati.</p>
    </footer>

</div> <!-- /.wrapper -->
</body>
</html>
