<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body>
	<?php
		define("MYSQLUSER", "ejohannsen");
		define("MYSQLPASS", "11027147");
		define("HOSTNAME", "cs.bemidjistate.edu");
		define("MYSQLDB", "greengrp");
		echo MYSQLUSER;
		$conn = @new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
		echo HOSTNAME;
		if ($conn->connect_error) 
		{
			die('Connect Error: ' . $conn->connect_error);
		} 
		else 
		{
			echo 'Successful connection to MySQL <br />';
		}
	?>
</body>

</html>
