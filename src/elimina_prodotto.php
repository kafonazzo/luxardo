<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: gestione_prodotti.php");
    exit;
}

$id = intval($_GET['id']);

$conn = new mysqli("localhost", "root", "", "luxardo");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM prodotti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: gestione_prodotti.php");
exit;
