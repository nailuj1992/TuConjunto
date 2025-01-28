<?php

$dbName = "tuconjunto_database";
$user = "root"
//"tuconjunto"
;
$pass = ""
//")g,3wF)b}c7V"
;

// This is the database connection configuration.
return array(
    'connectionString' => 'mysql:host=127.0.0.1;dbname=' . $dbName,
    'emulatePrepare' => true,
    'username' => $user,
    'password' => $pass,
    'charset' => 'utf8',
);
