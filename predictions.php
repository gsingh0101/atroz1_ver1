<?php
$_DEBUG = false;

$where_form_is="http://".$_SERVER['SERVER_NAME'].strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));

//mail("gsingh.0101@gmail.com","Form submission", "Customer Details:
//");

function getParam($key)
{    
    switch (true) {
        case isset($_GET[$key]):
            return $_GET[$key];
        case isset($_POST[$key]):
            return $_POST[$key];
        default:
            return "";
    }    
}

// PROCESS INPUT
$firstname = getParam('firstname');
$middlename = getParam('middlename');
$lastname = getParam('lastname');
$country = getParam('countryid');

$dob = "";
$mob = "";
$yob = "";
if (($dtob = getParam('dob')) != '')
{
	# assuming dd/mm/yy format
	$dmy_arr = explode("/", $dtob);
	$dob = $dmy_arr[0];
	$mob = $dmy_arr[1];
	$yob = $dmy_arr[2];
}
$hob = getParam('hob');
$minob = getParam('minob');
$pob = getParam('pob');
//echo $middlename;
//echo "<br/>";

// INSERT IN DB
include("config.php");
$conn = mysql_connect($db_host, $db_user, $db_pass);
if(!$conn) die ('Could not connect to database: '.mysql_error());
mysql_select_db($db_name, $conn);

$query = "INSERT into `".$db_table."` (dob, mob, yob, hob,minob,city,firstname,middlename,lastname,country) VALUES ('" . $dob . "','" . $mob . "','" . $yob . "','" . $hob . "','" . $minob . "','" . $pob . "','" . $firstname . "','" . $middlename . "','" . $lastname . "','" . $country . "')";

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
Date of Birth: " . $dob . " 
Country List: " . $country . " 
First Name: " . $firstname . " 
Middle Name: " . $middlename . " 
Surname: " . $lastname . " 
Place of Birth: " . $pob . " 
Time of Birth HOUR:MIN: " . $hob . ":" . $minob . " 

");


// CALL EXEC
// change arguments here ---
$predict_cmd = "pred2.exe" . " " . $dob . " " . $mob . " " . $yob . " " . $hob . " " . $minob . " " . $pob;
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

// Regular output
//include("onedone.php");

// For Webservice
$ret_arr = array("Retcode" => 0, 
"Date" => $dob,
"Hour" => $hob,
"Minutes" => $minob,
"City" => $pob,
"Predictions" => $predictions
);

$ret_json = json_encode($ret_arr);

header('Content-type: application/json');
echo $ret_json;

?>
