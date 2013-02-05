<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); //connect to database
    mysql_select_db("CS143",$db_connection);	//Use CS143
    ?>

  
<h2>Add new comment:</h2> <!-- header -->

<!-- FORM to input datas, POST -->
<FORM METHOD = "POST" ACTION = "./i2.php">
  <!-- Select Movie from Scroll Menu, NAME is 'movie' -->
  Movie:
  <SELECT NAME="movie">
    <?php
      //SELECT title and ORDER them alphabetically
      $titleResult = mysql_query("SELECT title FROM Movie ORDER BY title ASC",$db_connection);
      //For each title of movie, add an OPTION
      while($title = mysql_fetch_row($titleResult)){
    ?>
    <OPTION> <?php echo $title[0]; }?>
    </SELECT> <br>

    <!-- Input your name, NAME is 'yn', default name is "Anonymous" -->
    Your Name:
    <INPUT TYPE = "text" NAME="yn" VALUE="Anonymous" SIZE=15 MAXLENGTH=20> <br>

    <!-- Select rating from Scroll Menu, NAME is 'rating' -->
    Rating:
    <SELECT NAME="rating">
    <OPTION>5 - Excellent
    <OPTION>4 - Good
    <OPTION SELECTED>3 - OK <!-- default is 3 -->
    <OPTION>2 - Not worth watching
    <OPTION>1 - Don't watch it
    </SELECT> <br>

    <!-- INPUT comments to TEXTAREA, NAME is 'comments'-->
    Comments: <br>
    <TEXTAREA NAME = "comments" ROWS=5 COLS=30 MAXLENGTH=500>
      </TEXTAREA> <br>
      <INPUT TYPE="submit" VALUE="done">
</FORM>
      
<!-- INSERT data into database if there was input from user -->
<?php if(isset($_POST[movie]) && isset($_POST[yn]) && isset($_POST[rating]) && isset($_POST[comments])){
	$MovieIdResult = mysql_query("SELECT id FROM Movie WHERE title = '$_POST[movie]'"); //SELECT id of the chosen movie, $MovieIDResult is an array
	$MovieId = mysql_fetch_assoc($MovieIdResult); //$MovieId is number
	$rate = substr($_POST[rating],0,1); //$rate = first letter of 'rating', which is a number 1-5
	$curtime = date('Y-m-d H:i:s'); //$curtime is current time
	mysql_query("INSERT INTO Review (name,time,mid,rating,comment) VALUES('$_POST[yn]','$curtime' ,'$MovieId[id]',$rate,'$_POST[comments]')"); //Insert to Review
echo "Added Comment";
	}

mysql_close($db_connection);

?>
</html>
    
