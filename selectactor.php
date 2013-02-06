<!DOCTYPE html>
<html lang="en-US">

<head>
	<link rel="stylesheet" href="./main.css" type="text/css" />
	<title>Movie Database</title>
</head>

<body>
<div id ="content">

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); 
    mysql_select_db("CS143",$db_connection);
    $ActorInfoResult = mysql_query("SELECT concat(concat(concat(concat(concat(concat(first,' '),last),' '),'('),dob),')'),id FROM Actor ORDER BY first,last ASC",$db_connection);	
  ?>

<h2>View Actor Info </h2>

<FORM METHOD = "GET" ACTION = "./actorinfo.php">
See Actor Info:
<SELECT NAME="aid">
   <?php 
      while($ActorInfo = mysql_fetch_row($ActorInfoResult)){
?>
<OPTION value="<?php 
	echo $ActorInfo[1];
?>" >  <?php echo $ActorInfo[0]; ?> </OPTION>
      <?php } 
mysql_close($db_connection);

?>
</SELECT> <br>
<INPUT TYPE="submit" VALUE="Search">
</FORM>

</div>
</body>

</html>
