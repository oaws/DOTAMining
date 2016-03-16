<?php
$user="fixatex1_osid";
$password="#Lenovo12";
$database="fixatex1_dota2";

@mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die("Unable to select database");
?>