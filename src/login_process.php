<?php
session_start();
$conn = new mysqli("localhost", "root", "", "luxardo");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM utenti WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hash);
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        $_SESSION['username'] = $username;
        header("Location: gestione_prodotti.php");
    } else {
        header("Location: login.php?error=Password errata");
    }
} else {
    header("Location: login.php?error=Utente non trovato");
}

$stmt->close();
$conn->close();
?>
