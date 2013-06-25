<?php

include('conf.php');

$q = "DROP DATABASE $mysql_db";

mysql_query($q) or DIE('Database not dropped '.mysql_error().'<br>');

echo 'Database dropped...<br>';

session_destroy();
session_start();

include('conf.php');

echo 'Database created...<br>';

$q = "CREATE TABLE books
(
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
author text,
title text NOT NULL,
year text,
ord int NOT NULL,
num_chapters int NOT NULL,
complete int(1) NOT NULL
);";

mysql_query($q) or DIE('BOOKS table was not created. '.mysql_error().'<br>');

echo "BOOKS table created...<br>";

$q = "CREATE TABLE info
(
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
book_id int NOT NULL,
chapter int NOT NULL,
part int NOT NULL,
text text NOT NULL
);";

mysql_query($q) or DIE('INFO table was not created. '.mysql_error().'<br>');

echo "INFO table created...<br>";

$q = "CREATE TABLE logs
(
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
book_id int NOT NULL,
chapter int NOT NULL,
part int NOT NULL
);";

mysql_query($q) or DIE('LOG table not created. '.mysql_error().'<br>');

echo "Done!";

?>