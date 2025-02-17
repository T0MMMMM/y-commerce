<?php
/* Database connexion */
$DB_SERVER = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'php_exam_fuster';


/* Connexion à la base de données */
$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

/* verifier connection */
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>