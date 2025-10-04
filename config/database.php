<?php

// Detaliile de conectare la baza de date
define('DB_HOST', 'localhost'); // De obicei 'localhost' sau '127.0.0.1'
define('DB_USER', 'root');      // Utilizatorul MySQL
define('DB_PASS', '');          // Parola MySQL (goală în cazul tău)
define('DB_NAME', 'ai_documentation'); // Numele bazei de date create anterior

/**
 * Functie pentru a crea o conexiune la baza de date folosind MySQLi.
 *
 * @return mysqli|false Obiectul de conexiune mysqli in caz de succes, sau false in caz de eroare.
 */
function connectDB() {
    // Încearcă să creezi o nouă conexiune
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verifică dacă a apărut o eroare la conectare
    if ($connection->connect_error) {
        // Oprește execuția scriptului și afișează un mesaj de eroare
        die("Eroare de conectare la baza de date: " . $connection->connect_error);
    }

    // Setează setul de caractere la utf8mb4 pentru a suporta caractere speciale și emoji
    $connection->set_charset("utf8mb4");

    // Returnează obiectul de conexiune
    return $connection;
}

?>