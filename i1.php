<html>

  <?php 
    $db_connection = mysql_connect('localhost',"cs143",""); //Connect to Database
    mysql_select_db("CS143",$db_connection);	//Use CS143
    ?>

<h2>Add new actor/director:</h2> <!-- header -->

<!-- FORM to input datas, POST -->
<FORM METHOD = "POST" ACTION = "./i1.php">
  <!-- Select Actor/Director -->
  Identity:
  <INPUT TYPE = "radio" NAME="identity" VALUE="Actor" CHECKED> Actor
  <INPUT TYPE = "radio" NAME="identity" VALUE="Director"> Director <br> 
  <!-- Input name -->
  First Name:
  <INPUT TYPE = "text" NAME="fn" VALUE="" SIZE=10 MAXLENGTH=20> <br>
  Last Name:
  <INPUT TYPE = "text" NAME="ln" VALUE="" SIZE=10 MAXLENGTH=20> <br>
  <!-- Select Gender -->
  Sex:
  <INPUT TYPE = "radio" NAME="sex" VALUE="1" CHECKED> Male
  <INPUT TYPE = "radio" NAME="sex" VALUE="2"> Female <br> 
  <!-- Input DOB and DOD -->
  Date of Birth:
  <INPUT TYPE = "text" NAME="dob" VALUE="" SIZE=10 MAXLENGTH=20> <br>
  Date of Death:
  <INPUT TYPE = "text" NAME="dod" VALUE="" SIZE=10 MAXLENGTH=20> <br>
  <!-- Submit -->
  <INPUT TYPE="submit" VALUE="SUBMIT">

</FORM>

<!-- INSERT data into database if there was input from user -->
<?php if(isset($_POST['identity']) && isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['dob'])){

//Incrementing MaxPersonID
  $MaxPersonIDResult = mysql_query('SELECT id FROM MaxPersonID',$db_connection); //get MaxPersonID, MaxPersonIDResult is an array
  $MaxPersonID = mysql_fetch_assoc($MaxPersonIDResult); //$MaxPersonID is now a number
  $newMaxPersonID =  $MaxPersonId['id']+1; //Increment MaxPersonId
  mysql_query("UPDATE MaxPersonID SET id=$newMaxPersonID"); //Update the incremented MaxPersonID

//if Actor was chosen
if($_POST[identity]=='Actor'){
  if($_POST[dod]==''){ //if Date of Death was not set, dod=NULL
    mysql_query("INSERT INTO Actor (id,last,first,sex,dob,dod) VALUES($newMaxPersonID,'$_POST[ln]','$_POST[fn]','$_POST[sex]','$_POST[dob]',NULL)"); 
  } else { //if Date of Death was set
    mysql_query("INSERT INTO Actor (id,last,first,sex,dob,dod) VALUES($newMaxPersonID,'$_POST[ln]','$_POST[fn]','$_POST[sex]','$_POST[dob]','$_POST[dod]')"); //Inserting to Actor
  }
}

//if Director was chosen (rest is same things as inserting to Actor)
if($_POST[identity]=='Director'){
  if($_POST[dod]==''){
    mysql_query("INSERT INTO Director (id,last,first,dob,dod) VALUES($newMaxPersonID,'$_POST[ln]','$_POST[fn]','$_POST[dob]',NULL)");
  } else {
    mysql_query("INSERT INTO Director (id,last,first,dob,dod) VALUES($newMaxPersonID,'$_POST[ln]','$_POST[fn]','$_POST[dob]','$_POST[dod]')");
  }
}    
echo $_POST[identity]." added"; //show what was added             
} ?>

</html>
