<?php

	require_once('db/database.php');
	require_once('db/temp.php');
	$conn    = connect($config);
		       	   /* $filename = "SunHRM/batch/excelFile.xls";
			    //create the output
			    $output = //<table> code goes here. 
			    //set the header to treat this as an excel file
			    header("Content-Disposition: attachment; filename=\"$filename\"");
			    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			    header("Expires: 0");
			    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			    header("Cache-Control: private",false);
			    echo $output;*/
?>
2017-05-21 to 2017-05-27

<!-- SELECT * FROM ohrm_timesheet WHERE start_date >= "2017-04-26" and end_date <="2017-07-1" and employee_id=114 and state="NOT SUBMITTED" "sriramachandra" -->

<!-- SELECT * FROM ohrm_timesheet WHERE   start_date >= "2017-04-23" and end_date <="2017-06-17" and employee_id=113  avinash Mahapatra all aprovide -->

<!-- SELECT * FROM ohrm_timesheet WHERE start_date >= "2017-05-6" and end_date <="2017-07-1" and employee_id=445 and state="NOT SUBMITTED"suresh kumar grandhi all approved -->

<!-- SELECT * FROM ohrm_timesheet WHERE start_date >= "2017-05-13" and end_date <="2017-07-8" and employee_id=254 and state="NOT SUBMITTED" no data -->


<!-- SELECT * FROM ohrm_timesheet WHERE start_date >= "2017-05-29" and end_date <="2017-07-22" and employee_id=186 and state="NOT SUBMITTED" Ashok Mahato  -->

SELECT * FROM ohrm_timesheet WHERE start_date >= "2017-06-11" and end_date <="2017-08-05" and employee_id=204 and state="NOT SUBMITTED"