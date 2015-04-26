<?php

// read file

$custDetails;
$fh = fopen("cust1.txt", "r");
if ($fh)
{
	while (!feof($fh))
	{
		$line = fgets($fh);
//		print $line; print "\nline read\n";

		$set_found = 0;
		while (!preg_match("/={3,}/", $line) && !feof($fh))
		{
			$vals = explode("=", $line);
			if (count($vals) < 2)
			{
				$line = fgets($fh);
				continue;
			}
			
			$field = trim($vals[0]); // key
			$val1 = trim($vals[1]); // value

			$custDetails[$field] = $val1;

			print ($field); print (" is defined as ");
			print ($val1); print ("\n");
			
			if ($field == "CUSTOMERID")
			{
				$customer_id = $val1;
				$set_found = 1;
			}
			if ($field == "SITE")
				$site = $val1;
			else if ($field == "FULL NAME")
			{
				$name = $val1;
				$name_arr = explode(" ", $name);
				$first_name = $name_arr[0];
				$arr_size = count($name_arr);
				$last_name = "";
				if ($arr_size > 1)
					$last_name = $name_arr[$arr_size - 1];
				print $last_name; print "\n";
			}
			else if ($field == "DOB")
			{
				$dob = $val1;
				# assuming dd/mm/yy format
				$dmy_arr = explode("/", $dob);
				$dob_day = $dmy_arr[0];
				$dob_month = $dmy_arr[1];
				$dob_year = $dmy_arr[2];
			}
			else if ($field == "TOB")
			{
				$tob = $val1;
				
				$hm_arr = explode(":", $tob);
				$tob_hr = $ms_arr[0];
				$tob_min = $ms_arr[1];
			}
			else if ($field == "COUNTRY")
				$country = $val1;
			else if ($field == "PLACE")
				$place = $val1;
			else if ($field == "STATE")
				$state = $val1;
			else if ($field == "CURRENT LOCATION")
				$current_location = $val1;

			$line = fgets($fh);
		}
		
		// INSERT in DB Here
		if ($set_found != 0)
		{
			print "\n\nSET COMPLETES\n\n";
			
			print_r($custDetails);
		}
	}
}


?>
