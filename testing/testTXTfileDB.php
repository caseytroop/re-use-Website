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
		$file = fopen("makeshiftDB.txt","r");
		$db = fread($file,filesize("makeshiftDB.txt"));
		fclose($file);
	?>
	<script>
		var db="<?php echo $db; ?>;
		var stores = db.split("\n");
		var testList=[];
		for(i=0;i<stores.length;i++)
		{
			attributes=stores[i].split(";");
			stores[i]=attributes;
		}
		/*var test=""
		for(i=0;i<stores.length;i++)
		{
			for(j=0;j<stores[i].length;j++)
			{
				test=test+stores[i][j];
			}
		}
		alert(test);*/
		
	</script>
</body>

</html>
