<!DOCTYPE html>
<html lang="en-US">

<head>
	<link rel="stylesheet" href="./main.css" type="text/css" />
	<title>Movie Database</title>
</head>

<body>
	<div id="navigation">
		<a href= ./S1.php >Search</a>
		<a href= ./I1.php >Add Actor/Director</a>
		<a href= ./I2.php >Add Comments</a>
		<a href= ./I3.php >Add Movie Info</a>
		<a href= ./I4.php >Add Relations</a>
		<a href= ./B1.php >Show Actor Info</a>
		<a href= ./B2.php >Show Movie Info</a>
	</div>

<div id ="content">
<?php
	$db_connection = mysql_connect('localhost',"cs143", "");
	mysql_select_db("CS143", $db_connection);
?>

<FORM METHOD = "GET" ACTION = "./S1.php">
Search:
<INPUT TYPE = "text" NAME = "search" VALUE = "" SIZE = 80>
<br><br>

<?php

if($_GET[search]==""){
} else {
	$search = $_GET[search];
	$terms = str_word_count($search, 1);
	$ActorClauses = array();
	$MovieClauses = array();

	echo "Searching Actor Database...";
	print "<br>";
	$len = str_word_count($search);
	$i = 0;
	while ($i < $len) {
		$ActorClauses[$i] = "(first LIKE '%".$terms[$i]."%' OR last LIKE '%".$terms[$i]."%')";
		$i++;
	}
	$where = implode(" AND ", $ActorClauses);
	$ActorResult = mysql_query("SELECT * FROM Actor WHERE $where");
	while($row = mysql_fetch_row($ActorResult)){
		echo "Actor: ";
		print "<a href =./actorinfo.php?aid=".$row[0].">";
		echo $row[2]." ".$row[1];
		print "</a><br>"; 
	}

	print "<br>";
	echo "Searching Movie Database...";
	print "<br>";
	$i = 0;
	while ($i < $len) {
		$MovieClauses[$i] = "title LIKE '%".$terms[$i]."%'";
		$i++;
	}
	$where = implode(" AND ", $MovieClauses);
	$MovieResult = mysql_query("SELECT * FROM Movie WHERE $where");
	while($row = mysql_fetch_row($MovieResult)){
		echo "Movie: ";
		print "<a href =./movieinfo.php?mid=".$row[0].">";
		echo $row[1];
		print "</a><br>";
	}
}

	mysql_close($db_connection);

?>
</div>

</body>
</html>
