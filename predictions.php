<?php
$_DEBUG = false;

$where_form_is="http://".$_SERVER['SERVER_NAME'].strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));

//mail("gsingh.0101@gmail.com","Form submission", "Customer Details:
//");


// PROCESS INPUT
$firstname = ($_POST['firstname'] ? :"");
$middlename = ($_POST['middlename'] ? :"");
$lastname = ($_POST['lastname'] ? :"");
$country = ($_POST['countryid'] ? :"");

$dob = "";
$mob = "";
$yob = "";
if ($_POST['dob'] != '')
{
	$dtob = $_POST['dob'];
	# assuming dd/mm/yy format
	$dmy_arr = explode("/", $dtob);
	$dob = $dmy_arr[0];
	$mob = $dmy_arr[1];
	$yob = $dmy_arr[2];
}
//echo $middlename;
//echo "<br/>";

// INSERT IN DB
include("config.php");
$conn = mysql_connect($db_host, $db_user, $db_pass);
if(!$conn) die ('Could not connect to database: '.mysql_error());
mysql_select_db($db_name, $conn);

$query = "INSERT into `".$db_table."` (dob, mob, yob, hob,minob,city,firstname,middlename,lastname,country) VALUES ('" . $dob . "','" . $mob . "','" . $yob . "','" . $_POST['hob'] . "','" . $_POST['minob'] . "','" . $_POST['pob'] . "','" . $firstname . "','" . $middlename . "','" . $lastname . "','" . $country . "')";

if ($_DEBUG)
	echo $query . "<br/>";
$mysql_err = mysql_query($query);
if ($_DEBUG)
	if (!$mysql_err)
		echo mysql_error();

mysql_close($conn);


// LOG THE DETAILS
$fname = "customerinputlog.txt";
$fh = fopen($fname, 'a') or die ("Can't open log file");
fwrite($fh, "
Prediction performed at: " . date("Y-m-d H:i:s") . "
Date of Birth: " . $_POST['dob'] . " 
Country List: " . $_POST['countryid'] . " 
First Name: " . $_POST['firstname'] . " 
Middle Name: " . $_POST['middlename'] . " 
Surname: " . $_POST['lastname'] . " 
Place of Birth: " . $_POST['pob'] . " 
Time of Birth HOUR:MIN: " . $_POST['hob'] . ":" . $_POST['minob'] . " 

");


// CALL EXEC
// change arguments here ---
$predict_cmd = "pred2.exe" . " " . $dob . " " . $mob . " " . $yob . " " . $_POST['hob'] . " " . $_POST['minob'] . " " . $_POST['pob'];
$out_arr = Array();
$ret_arr = Array();
//$exec_ret = exec("date /T", $out_arr, $ret_arr);
$exec_ret = exec($predict_cmd, $out_arr, $ret_arr);

$predictions = "";
if ($_DEBUG)
{
	print_r ($out_arr);
	echo "<br/>";
	//print_r ($exec_ret);
	//echo "<br/>";
}
$command_print = "<br/> Command Executed: <br/>" . $predict_cmd . " <br/><br/>" . "Command Output: <br/>";
$predictions = implode("<br/>", $out_arr);

include("onedone.php");

?>