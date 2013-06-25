<?php

$mysql_server='localhost';
$mysql_username='test';
$mysql_db='easy_read_test';
$mysql_password='test';

ini_set('error_reporting', E_ALL & E_STRICT);

/* opens up connection to server. If database does not connect to server, it will error out */
$sql_link=mysql_connect($mysql_server, $mysql_username, $mysql_password);
if(!$sql_link){
    die('Could not connect to database: '.mysql_error());
}

/* look for database. If not found, error */
$sql_dbselect=mysql_select_db($mysql_db,$sql_link);
if(!$sql_dbselect){
    $q = "CREATE DATABASE $mysql_db";
    mysql_query($q) or DIE('Could not create database! '.mysql_error().'<br>');
    echo ("Database created!<br>");
}

$sql_dbselect=mysql_select_db($mysql_db,$sql_link);
?>