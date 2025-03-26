<?php
// Include databaseconfiguratie
require 'config.php';

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal en filter de gegevens op
    $naam = trim($_POST['naam']);
    $email = trim($_POST['email']);
    $onderwerp = trim($_POST['onderwerp']);
    $bericht = trim($_POST['bericht']);

    // Extra beveiliging: escape HTML-tekens
    $naam = htmlspecialchars($naam);
    $email = htmlspecialchars($email);
    $onderwerp = htmlspecialchars($onderwerp);
    $bericht = htmlspecialchars($bericht);

    // Voorbereiden van de SQL-query
    $stmt = $conn->prepare("INSERT INTO messages (naam, email, onderwerp, bericht, datum) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $naam, $email, $onderwerp, $bericht);

    // Voer de query uit en controleer of het is gelukt
    if ($stmt->execute()) {
        echo "Bericht succesvol verzonden!";
    } else {
        echo "Er is iets misgegaan: " . $stmt->error;
    }

    // Sluit de statement
    $stmt->close();
}

// Sluit de databaseverbinding
$conn->close();
?>
