<?php

// stockage du hash du mot de passe
/*
$query  = sprintf("INSERT INTO users(name,pwd) VALUES('%s','%s');",
            pg_escape_string($username),
            password_hash($password, PASSWORD_DEFAULT));
$result = pg_query($connection, $query); */

// on vérifie si l'utilisateur a soumis le bon mot de passe
$query = sprintf("SELECT pwd FROM users WHERE name='%s';",
            pg_escape_string($username));
$row = pg_fetch_assoc(pg_query($connection, $query));

if ($row && password_verify($password, $row['pwd'])) {
    echo 'Bonjour, ' . htmlspecialchars($username) . '!';
} 
else {
    echo 'L\'authentification a échoué pour ' . htmlspecialchars($username) . '.';
}

?>
