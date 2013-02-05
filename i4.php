<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); 
    mysql_select_db("CS143",$db_connection);	
  ?>

<h2>Add new actor in a movie:</h2>
<FORM METHOD = "POST" ACTION = "./i4.php">
  Movie:
  <SELECT NAME="movie">
  <?php
        $result = mysql_query("SELECT title FROM Movie ORDER BY title ASC",$db_connection);
while($title = mysql_fetch_row($result)){
?>
<OPTION> <?php echo $title[0]; }?>
  </SELECT> <br>
  Actor:
  <SELECT NAME="actor">
<?php
        $result2 = mysql_query("SELECT concat(concat(first,' '),last) FROM Actor ORDER BY first,last ASC",$db_connection);
while($title2 = mysql_fetch_row($result2)){
?>
<OPTION> <?php echo $title2[0]; }?>
  </SELECT> <br>
  Role:
  <INPUT TYPE="text" NAME="role" VALUE="" SIZE=20 MAXLENGTH=50> <br>
  <INPUT TYPE="submit" VALUE="done">
  </FORM>

  <?php if(isset($_POST[movie]) && isset($_POST[actor]) && isset($_POST[role])){
  $mid = mysql_query("SELECT id FROM Movie WHERE title = '$_POST[movie]'");
  $movid = mysql_fetch_assoc($mid);
  $insertmid = $movid['id'];

  $actid = split(" ",$_POST[actor]);
  $aid = mysql_query("SELECT id FROM Actor WHERE first='$actid[0]' && last='$actid[1]'");
  $acid = mysql_fetch_assoc($aid);
  $insertaid = $acid['id'];
  mysql_query("INSERT INTO MovieActor (mid,aid,role) VALUES($insertmid,$insertaid,'$_POST[role]')");

}
mysql_close($db_connection);

 ?>
  </html>
