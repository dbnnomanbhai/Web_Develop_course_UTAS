<?php

// Define variable to where the database file is
$dbFile = '/var/www/html/najmulu/phpliteadmin/db/practice';

try {
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
} catch(PDOException $e) {
    echo "Connection failed: ";
}
?>
