<?php

// stockage du hash du mot de passe

$query  = sprintf("INSERT INTO users(name,pwd,0) VALUES('%s','%s',%d);",
            pg_escape_string($username),
            password_hash($password, PASSWORD_DEFAULT));
$result = pg_query($connection, $query); 


?>
