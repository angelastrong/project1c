<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); 
    mysql_select_db("CS143",$db_connection);	
    $MovieInfoResult = mysql_query("SELECT concat(concat(concat(title,' ('),year),')'),id FROM Movie ORDER BY title ASC");   
    ?>

<h2>View Movie Info </h2>

<FORM METHOD = "GET" ACTION = "./movieinfo.php">
See Movie Info:
<SELECT NAME="mid">
   <?php 
      while($MovieInfo = mysql_fetch_row($MovieInfoResult)){
?>
<OPTION value="<?php 
	echo $MovieInfo[1]; //value =id of the movie
?>" >  <?php echo $MovieInfo[0]; ?> </OPTION>
      <?php }
mysql_close($db_connection);

 ?>
</SELECT> <br>
<INPUT TYPE="submit" VALUE="Search">
</FORM>

</html>
