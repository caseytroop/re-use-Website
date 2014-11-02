<?php //Programmer [MD]
session_start(); // starts new or resumes existing session
$message = '';
$error = '';

if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
      // check the token
      $badToken = true;
      if (empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $message = 'Sorry, try it again. There was a security issue.';
        $badToken = true;
      } else {
        $badToken = false;
        unset($_SESSION['token']); 
    
      // sets up connection to database
      define("MYSQLUSER", "dave1mat");
      define("MYSQLPASS", "dave1mat");
      define("HOSTNAME", "localhost");
      define("MYSQLDB", "matt_db");
    
	  // Make connection to database
	  $connection = @new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
	  if ($connection->connect_error) {
		die('Connect Error: ' . $connection->connect_error);
	  } else {
		  
      // Get the data also sanitizes each piece
      $queryField = filter_input(INPUT_POST,'queryField', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
      $table = filter_input(INPUT_POST,'tables', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
      
      // Verify the data will print an error message if you don't enter a value
      if (!(trim($queryField))) {
        $error .= "You must enter a value<br />";
      }
       if (!(trim($table))) {
        $error .= "You must enter a value <br />";
     
       }if ($error) {
        $message .= $error;
      } else {
      
	
        
        // Set up the query
        // NOTE: This is where the fields are declared. This is why
        // you can only enter in values into tables that have the rows
        // field 1, field 2, field, 3, field4, and field 5.
         $query = "INSERT INTO $table $queryField";
 
        echo $query;
           
                            $i = 0;
                    echo '<html><body><table><tr>';
                    while ($i < mysql_num_fields($queryField))
                    {
                        $meta = mysql_fetch_field($queryField, $i);
                        echo '<td>' . $meta->name . '</td>';
                        $i = $i + 1;
                    }
                    echo '</tr>';

                    $i = 0;
                    while ($row = mysql_fetch_row($queryField)) 
                    {
                        echo '<tr>';
                        $count = count($row);
                        $y = 0;
                        while ($y < $count)
                        {
                            $c_row = current($queryField);
                            echo '<td>' . $c_row . '</td>';
                            next($row);
                            $y = $y + 1;
                        }
                        echo '</tr>';
                        $i = $i + 1;
                    }
                    echo '</table></body></html>';
                    mysql_free_result($queryField);

        // Run the query and display appropriate message
        if (!$result = $connection->query($query)) {
          $message .= "Unable  to Create Query<br />";
        } else {
          $message .= "Query Successfully Created<br />";
        }
      }
    }
  }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="QForm.css">
<title>Query Entry</title>
</head>
<body>
<h1>Query Entry</h1>
<h2> Welcome to Create A Query Website </h2>
<p> This site will allow you to create a query for whichever database you select. This of 
    course depends on your knowledge of MySQL programming and also if you know what rows
    are in the table that you select. Now If you want to create a table with rows that you
    define so that you can use this query entry more effeciently please click on the link 
    below:</p>
<p> <a href="http://cs.bemidjistate.edu/dave1mat/AWP%20Final%20/TableEntry.php"> Link To Table Creation </a>

<p> <?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A'); ?> </p>

<p><?php echo $message; ?></p>

<form action="QueryForm.php" method="post" name="maint" id="maint">

  <fieldset class="maintform">
	  
	  	<legend> Choose Your Table </legend>
			<p> Choose a table you would like to insert data into: </p>
			<ul>
				
				<?php
				// This is an awesome way to display the table names from
				// my database into a dropdown box
				$dbname = 'matt_db';

				if (!mysql_connect('localhost', 'dave1mat', 'dave1mat')) {
					echo 'Could not connect to mysql';
					exit;
				}
				
				 $dbname = "matt_db";
				 $sql = "SHOW TABLES FROM $dbname";
				 $result = mysql_query($sql);
				 $tableNames= array();

				 while ($row = mysql_fetch_row($result)) {
				  $tableNames[] = $row[0];
				 }


				 echo '<select name="tables" id="tables">';     
				 foreach ($tableNames as $name){
				   echo '<option value="' . $name . '">' . $name . '</option>';
				 }
				 echo '</select>';

				if (!$result) {
					echo "DB Error, could not list tables\n";
					echo 'MySQL Error: ' . mysql_error();
					exit;
				}

				while ($row = mysql_fetch_row($result)) {
					echo "Table: {$row[0]}\n";
				}

				mysql_free_result($result);
				?>
          </ul>
          <br>
        <legend> Create a Query </legend>
                <ul>

                  <li><label for="queryField">Please Type in Your Query Here</label><br />
                    <input type="text" name="queryField" id="queryField" /></li>
                </ul>

    <?php 
    // create token
    $salt = 'SomeSalt';
    $token = sha1(mt_rand(1,1000000) . $salt); 
    $_SESSION['token'] = $token;
    ?>
    <input type='hidden' name='token' value='<?php echo $token; ?>'/>

    <input type="submit" name="save" value="Save" />
    <a class="cancel" href="QueryForm.php">Cancel</a>
    </fieldset>
</form>

</body>
</html>