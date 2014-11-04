<!DOCTYPE html>

	<head>
		<title>
		</title>
	</head>
	<body>
		<?php
			define("MYSQLUSER", "ctroop");
			define("MYSQLPASS", "00356594");
			define("HOSTNAME", "cs.bemidjistate.edu");
			define("MYSQLDB", "greengrp");
			// Make connection to database
			$connection = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
			echo "nope ";
			if ($connection->connect_error) 
			{
				die('Connect Error: ' . $connection->connect_error);
			}
			else 
			{
				echo "you pass ";
			}
		  
		?>
	</body>
</html>
