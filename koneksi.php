<?php
$username = "root@";
$password = "";
$host = "localhost:8111";

return new PDO("mysql:host=$host; dbname=infokan", $username, $password);

?>