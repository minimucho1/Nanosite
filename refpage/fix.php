<title>Fix Login</title>
<p class="title2">Login Fixed</p>
<tr><td class=listtitle colspan=2><center><span class='title2'></span></center></td></tr>
<body background="bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<?php
include('assets/config/database.php');

$login = mysql_real_escape_string($_POST['login']);
$pass = mysql_real_escape_string($_POST['pass']);

$resultsalt = mysql_query("SELECT salt FROM accounts WHERE name='$login'"); 
if ($row = mysql_fetch_array($resultsalt)){
   do {
         $salt = $row["salt"];
   } while ($row = mysql_fetch_array($resultsalt)); 
} else { 
echo "You need to be logged off before you can do this!";
}
$password = hash('sha512', $pass . $salt);

$sqlquery = "SELECT * FROM accounts WHERE name = '$login' AND password = '$password'";
$result = mysql_query($sqlquery);
$number = mysql_num_rows($result); //LINE NUMBER 23

$i = 0;
if ($number < 1) //10
{
echo "This account doesn't exist, or the password is wrong.";
}
else
{
if ($number > $i)
{
$sqlquery2 = "Update accounts SET loggedin = 0 WHERE name='$login'";
mysql_query("$sqlquery2") or DIE (mysql_error());
echo "The account has been unbugged successfully!";
}
}

?>
<h5>Credits to Voldermord<h5></center>