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
      $field1 = filter_input(INPUT_POST,'field1', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
      $field2 = filter_input(INPUT_POST,'field2', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	  $field3 = filter_input(INPUT_POST,'field3', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	  $field4 = filter_input(INPUT_POST,'field4', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
      $field5 = filter_input(INPUT_POST,'field5', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
      $table = filter_input(INPUT_POST,'tables', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);

      
      // Verify the data will print an error message if you don't enter a value
      if (!(trim($field1))) {
        $error .= "You must enter a value<br />";
      }
       if (!(trim($field2))) {
        $error .= "You must enter a value <br />";
      }
       if (!(trim($field3))) {
        $error .= "You must enter a value<br />";
      }
       if (!(trim($field4))) {
        $error .= "You must enter a value<br />";
      }
       if (!(trim($field5))) {
        $error .= "You must enter a value<br />";
      }
      if ($error) {
        $message .= $error;
      } else {
      
	
        
        // Set up the query
        // NOTE: This is where the fields are declared. This is why
        // you can only enter in values into tables that have the rows
        // field 1, field 2, field, 3, field4, and field 5.
         $query = "INSERT INTO `$table` (`field1`, `field2`, `field3`, `field4`, `field5`) VALUES "
         . " ('$field1', '$field2', '$field3', '$field4', '$field5')";
 
        echo $query;

        // Run the query and display appropriate message
        if (!$result = $connection->query($query)) {
          $message .= "Unable to add rows<br />";
        } else {
          $message .= "Row successfully added<br />";
        }
      }
    }
  }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body>
<h1>Data Entry</h1>
<h2> Welcome to The Database Entry Website </h2>
<h3> This form will allow you to add values to the table Exercise 2! </h3>
<h4> Note: This will only insert data into rows that are actually named field1, field2, field3, field4 & field 5. </h4>
<h5> (So, this will only work if you named each row field1, field 2, field 3, filed 4, and field 5 in the Table Entry Website.) </h5>
<p> *** If you want an easy way to enter data into a table simply select the data_entry table from the drop down box which already has the default rows created. *** </p>
<p> <?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A'); ?> </p>

<p><?php echo $message; ?></p>

<form action="DataEntry.php" method="post" name="maint" id="maint">

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
		
    <br><legend>Add Row Values</legend>
		<ul>
		  
		  <li><label for="field1">Value For Field 1</label><br />
			<input type="text" name="field1" id="field1" /></li>
		</ul>
		
		<ul>
		  
		  <li><label for="field2">Value For Field 2</label><br />
			<input type="text" name="field2" id="field2" /></li>
		</ul>
		
		<ul>
		  
		  <li><label for="field3">Value For Field 3</label><br />
			<input type="text" name="field3" id="field3" /></li>
			
		</ul>
		
		<ul>
		  
		  <li><label for="field4">Value For Field 4</label><br />
			<input type="text" name="field4" id="field4" /></li>
			
		</ul>
		
		<ul>
		  
		  <li><label for="field5">Value For Field 5</label><br />
			<input type="text" name="field5" id="field5" /></li>

		</ul>





    <?php 
    // create token
    $salt = 'SomeSalt';
    $token = sha1(mt_rand(1,1000000) . $salt); 
    $_SESSION['token'] = $token;
    ?>
    <input type='hidden' name='token' value='<?php echo $token; ?>'/>

    <input type="submit" name="save" value="Save" />
    <a class="cancel" href="DataEntry.php">Cancel</a>
    </fieldset>
</form>

</body>
</html>


