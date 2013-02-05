<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); 
    mysql_select_db("CS143",$db_connection);	

    $result = mysql_query("SELECT * FROM Actor WHERE id=$_GET[aid]");
    $actorinfo=mysql_fetch_assoc($result); 
    ?>

<p> -- Show Actor Info -- </p>
<p> Name: <?php echo $actorinfo[first].' '.$actorinfo[last]; ?> </p>
<p> Sex: <?php echo $actorinfo[sex]; ?> </p>
<p> Date Of Birth: <?php echo $actorinfo[dob]; ?> </p>
<p> Date Of Death: 
<?php if($actorinfo[dod]==NULL){echo "Still Alive";} else {echo $actorinfo[dod];} ?> </p>
<br>
<p>-- Act in -- </p>
      <?php 
	   $MovieActorResult = mysql_query("SELECT * FROM MovieActor WHERE aid=$_GET[aid]");
      while($row = mysql_fetch_row($MovieActorResult)){
	echo "Acted ";
	for($i=0;$i<3;$i++){
	  $op[$i] = $row[$i];
	}
	echo '"'.$op[2].'"';
	echo " in ";
	$MovieNameResult =mysql_query("SELECT title FROM Movie WHERE id=$op[0]");
	$MovieName = mysql_fetch_assoc($MovieNameResult);
?>
<a href =./movieinfo.php?mid=<?php echo $op[0]; ?> >
<?php echo $MovieName['title']; ?> </a>
<?php
	echo "<br>";
      }
require_once 'b1.php';

//mysql_close($db_connection);

?>



</html>
