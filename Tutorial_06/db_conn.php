<?php
 
$dbFile = '/var/www/html/najmulu/phpliteadmin/db/tutorial6.db';

try {
    $db = new PDO("sqlite:$dbFile");
    //set the PDO error mode to exception
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>