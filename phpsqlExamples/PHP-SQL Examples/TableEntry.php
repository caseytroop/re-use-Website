<?php
define("MYSQLUSER", "dave1mat");
define("MYSQLPASS", "dave1mat");
define("HOSTNAME", "localhost");
define("MYSQLDB", "matt_db");

// Make connection to database
$connection = @new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
if ($connection->connect_error) {
  die('Connect Error: ' . $connection->connect_error);
} else {
  echo 'Successful connection to MySQL <br />';
  // Create the MySQL command by copying the command and
  // spliting into shorter lines and concatenating with periods
  // Drop the final semicolon on the MySQL commmand
  // but don't forget the semicolon for ending the PHP command
  
  //grab values
  $tab = filter_input(INPUT_POST,'tab', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $field1 = filter_input(INPUT_POST,'field1', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $field2 = filter_input(INPUT_POST,'field2', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $field3 = filter_input(INPUT_POST,'field3', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $field4 = filter_input(INPUT_POST,'field4', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $field5 = filter_input(INPUT_POST,'field5', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $type1 = filter_input(INPUT_POST,'type1', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $type2 = filter_input(INPUT_POST,'type2', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $type3 = filter_input(INPUT_POST,'type3', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $type4 = filter_input(INPUT_POST,'type4', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $type5 = filter_input(INPUT_POST,'type5', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  
  $query = "CREATE TABLE `matt_db`.`$tab` ( "
	. "`$field1` $type1 , "
	. "`$field2` $type2 , "
	. "`$field3` $type3 , "
	. "`$field4` $type4 , "
	. "`$field5` $type5 , "
	. "`date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
  . ") ENGINE = MYISAM";
  // Run the query and display appropriate message
  if (!$result = $connection->query($query)) {
    echo "Unable to create table<br />";
  } else {
    echo "Table successfully created<br />";
  }
  // Show the tables
  if ($result = $connection->query("SHOW TABLES")) {
    $count = $result->num_rows;
    echo "Tables: ($count)<br />"; 
    while ($row =$result->fetch_array()) {
      echo $row[0]. '<br />';
    }
  }
}
?>

<?php //Programmer [MD] ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body>
<h1>Table Entry</h1>
<h2> Welcome to The Database Entry Website </h2>
<p> This form will allow you to create a table with five fields! </p>
<p> <?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A'); ?> </p>

<p><?php echo $message; ?></p>

<form action="TableEntry.php" method="post" name="maint" id="maint">
   	
  <fieldset class="maintform">
	<legend> Name Your Table </legend>
		<ul> <li><label for="tab">What Would You Like To Name Your Table?</label><br />
			<input type="text" name="tab" id="tab" /></li>

		</ul>
	
    <legend>Add a Row</legend>
		<ul>
		  
		  <li><label for="field1">Field 1</label><br />
			<input type="text" name="field1" id="field1" /></li>
			
		 			<select id="type1" name="type1">
					<option value="">- Choose A Data Type -</option>
					<option value="CHAR(20)">CHAR</option>
					<option value="VARCHAR(20)">VARCHAR</option>
					<option value="TEXT(20)">TEXT</option>
					<option value="MEDIUMINT(20)">MEDIUMINT</option>
					
			</select>
		</ul>
		
		<ul>
		  
		  <li><label for="field2">Field 2</label><br />
			<input type="text" name="field2" id="field2" /></li>
			
		 			<select id="type2" name="type2">
					<option value="">- Choose A Data Type -</option>
					<option value="CHAR(20)">CHAR</option>
					<option value="VARCHAR(20)">VARCHAR</option>
					<option value="TEXT(20)">TEXT</option>
					<option value="MEDIUMINT(20)">MEDIUMINT</option>
					
			</select>
		</ul>
		
		<ul>
		  
		  <li><label for="field3">Field 3</label><br />
			<input type="text" name="field3" id="field3" /></li>
			
		 			<select id="type3" name="type3">
					<option value="">- Choose A Data Type -</option>
					<option value="CHAR(20)">CHAR</option>
					<option value="VARCHAR(20)">VARCHAR</option>
					<option value="TEXT(20)">TEXT</option>
					<option value="MEDIUMINT(20)">MEDIUMINT</option>
					
			</select>
		</ul>
		
		<ul>
		  
		  <li><label for="field4">Field 4</label><br />
			<input type="text" name="field4" id="field4" /></li>
			
		 			<select id="type4" name="type4">
					<option value="">- Choose A Data Type -</option>
					<option value="CHAR(20)">CHAR</option>
					<option value="VARCHAR(20)">VARCHAR</option>
					<option value="TEXT(20)">TEXT</option>
					<option value="MEDIUMINT(20)">MEDIUMINT</option>
					
			</select>
		</ul>
		
		<ul>
		  
		  <li><label for="field5">Field 5</label><br />
			<input type="text" name="field5" id="field5" /></li>
			
		 			<select id="type5" name="type5">
					<option value="">- Choose A Data Type -</option>
					<option value="CHAR(20)">CHAR</option>
					<option value="VARCHAR(20)">VARCHAR</option>
					<option value="TEXT(20)">TEXT</option>
					<option value="MEDIUMINT(20)">MEDIUMINT</option>
					
			</select>
		</ul>





    <?php 
    // create token
    $salt = 'SomeSalt';
    $token = sha1(mt_rand(1,1000000) . $salt); 
    $_SESSION['token'] = $token;
    ?>
    <input type='hidden' name='token' value='<?php echo $token; ?>'/>

    <input type="submit" name="save" value="Save" />
    <a class="cancel" href="TableEntry.php">Cancel</a>
    </fieldset>
</form>

</body>
</html>


