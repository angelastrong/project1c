<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); //connect to database
    mysql_select_db("CS143",$db_connection);	//Use CS143
    ?>

<h2>Add new movie:</h2>
<FORM METHOD = "POST" ACTION = "./i3.php">
  Title:
  <INPUT TYPE="text" NAME="title" VALUE="" SIZE=20 MAXLENGTH=100> <br>
  Company:
  <INPUT TYPE="text" NAME="company" VALUE="" SIZE=20 MAXLENGTH=50> <br>
  Year:
  <INPUT TYPE="text" NAME="year" VALUE="" SIZE=20 MAXLENGTH=50> <br>
  Director:
  <SELECT NAME="director">
<?php
     $result = mysql_query("SELECT concat(concat(concat(concat(concat(first,' '),last),' (Birth: '),dob),' )') FROM Director ORDER BY first,last ASC", $db_connection);
                           while($title = mysql_fetch_row($result)){ ?>
                               <OPTION> <?php echo $title[0];}?>
  </SELECT> <br>
  MPAA Rating:
  <SELECT NAME="mpaa">
  <OPTION SELECTED>G
  <OPTION>NC-17
  <OPTION>PG
  <OPTION>PG-13
  <OPTION>R
  <OPTION>surrendere
  </SELECT> <br>
  Genre:
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Action"/>Action
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Adult"/>Adult
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Adventure"/>Adventure
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Animation"/>Animation
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Comedy"/>Comedy
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Crime"/>Crime
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Documentary"/>Documentary
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Drama"/>Drama
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Family"/>Family
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Fantasy"/>Fantasy
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Horror"/>Horror
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Musical"/>Musical
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Mystery"/>Mystery
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Romance"/>Romance
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Sci-Fi"/>Sci-Fi
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Short"/>Short
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Thriller"/>Thriller
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="War"/>War
  <INPUT TYPE="checkbox" Name="genre[]" VALUE="Western"/>Western<br>
  <INPUT TYPE="submit" VALUE="done">
  </FORM>

  <?php if(isset($_POST[title]) && isset($_POST[company]) &&  isset($_POST[year]) && isset($_POST[director]) &&  isset($_POST[mpaa])){
  $max = mysql_query('SELECT id FROM MaxMovieID',$db_connection);
  $maxid = mysql_fetch_assoc($max);
  $newid = $maxid['id']+1;
  mysql_query("UPDATE MaxMovieID SET id=$newid");
  mysql_query("INSERT INTO Movie (id,title,year,rating,company) VALUES($newid,'$_POST[title]',$_POST[year],'$_POST[mpaa]','$_POST[company]')");
  $dname = split(" ",$_POST[director]);
$didi = mysql_query("SELECT id FROM Director WHERE first='$dname[0]' && last='$dname[1]'");
  $didid = mysql_fetch_assoc($didi);
  $newdid = $didid['id'];
  mysql_query("INSERT INTO MovieDirector (mid,did) VALUES($newid,$newdid)");

  for($i=0;$i<count($_POST[genre]);$i++){
    $gname = $_POST['genre'][$i];
    mysql_query("INSERT INTO MovieGenre (mid,genre) VALUES($newid,'$gname')");
  }

  }
mysql_close($db_connection);

?>

  </html>
