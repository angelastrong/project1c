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
    $db_connection = mysql_connect('localhost',"cs143",""); 
    mysql_select_db("CS143",$db_connection);	

    $result = mysql_query("SELECT * FROM Movie WHERE id=$_GET[mid]");
    $movieinfo=mysql_fetch_assoc($result); 
    $MovieDirectorResult = mysql_query("SELECT * FROM MovieDirector WHERE mid=$_GET[mid]");
    $MovieDirector=mysql_fetch_assoc($MovieDirectorResult);
    $DirectorNameResult = mysql_query("SELECT * FROM Director WHERE id=$MovieDirector[did]");
    if($DirectorNameResult!=NULL){$DirectorName= mysql_fetch_assoc($DirectorNameResult);}
    $MovieGenreResult = mysql_query("SELECT genre FROM MovieGenre WHERE mid=$_GET[mid]");

    ?>

<p> -- Show Movie Info -- </p>
<p>Title: <?php echo $movieinfo[title]." (".$movieinfo[year].")"; ?> </p>
<p>Producer: <?php echo $movieinfo[company]; ?> </p>
<p>MPAA Rating: <?php echo $movieinfo[rating]; ?> </p>
<p>Director: <?php echo $DirectorName['first']." ".$DirectorName['last']; ?> </p>
<p>Genre: <?php
while( $MovieGenre = mysql_fetch_row($MovieGenreResult)){
  echo $MovieGenre[0].' ';
}
?>
</p>

<p> -- Actor in this movie -- </p>
<?php	   
$MovieActorResult = mysql_query("SELECT * FROM MovieActor WHERE mid=$_GET[mid]");
      while($row = mysql_fetch_row($MovieActorResult)){
	for($i=0;$i<3;$i++){
	  $op[$i] = $row[$i];
	}
	$ActorNameResult =mysql_query("SELECT first,last FROM Actor WHERE id=$op[1]");
	$ActorName = mysql_fetch_assoc($ActorNameResult);
?>
	<a href=./actorinfo.php?aid=<?php echo $op[1];?> >
<?php	echo $ActorName['first']." ".$ActorName['last']; ?> </a>
<?php	echo " act as ";
       	echo '"'.$op[2].'"';
	echo "<br>";
      }

require_once 'selectmovie.php';

//mysql_close($db_connection);

?>
</div>
</body>
</html>
