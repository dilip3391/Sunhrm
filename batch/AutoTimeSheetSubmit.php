<?php
	
	require_once('db/database.php');
	require_once('db/temp.php');
	$conn    = connect($config);

	$employeeDetails=getEmployeeInfoDemo($conn);

	/*foreach($employeeDetails as $d ){

		$timeSheetWeekData=getEmloyeNotSubmitedData($conn,$d["employee_id"]);

		if($timeSheetWeekData!=null){
			foreach($timeSheetWeekData as $autosubmit ){
				//echo " ".$autosubmit["timesheet_id"];
				//$autosubmit["timesheet_id"]
				//$updateResponce=updateStatuasNotSubmitedToApproved($conn,2317);
				$updateResponce=1;
				//echo "".json_encode($updateResponce);

				if($updateResponce==1){

					$maxId= findMaxId($conn);
					foreach($maxId as $autoIncrement){

						if($autoIncrement["id"]!=0 ){
							//echo "".$autoIncrement["id"]+1;
							//$insertResponce=inserTimesheetActionLog($conn,2317,$autoIncrement["id"]+1);
							$insertResponce=1;
							if($insertResponce==1){

								    $startDate= $autosubmit["start_date"]." 00:00:00 ";
									$endDate= $autosubmit["end_date"]." 00:00:00 ";
									
									$timesheetData=getTimeSheetDetailsByday($conn,113,$startDate,$endDate); //$d["emp_number"]

									if($timesheetData!=null){
										
										foreach ($timesheetData as $timesheetItem) {

											$date_arr= explode(":", $timesheetItem['actual_working_hours']);
											$duration=$date_arr[0]*3600+$date_arr[1]*60;
											$date=date('Y-m-d', strtotime($timesheetItem["punch_in_user_time"]));
											
											$maxId2= FindMaxValueId($conn);
											$incrementId=0;
											foreach($maxId2 as $autoIncrement2){
												//echo "".$autoIncrement2["id"].",";
												$incrementId=$autoIncrement2["id"]+1;
											}

											if($incrementId!=0){

												$timesheetSubmitedData=InsertOhrmTimesheetItem($conn,2317,
													$date,$duration,$incrementId);

												if($timesheetSubmitedData==1){
													echo "successfully submited the timesheet";
												}
											}
										}
									}
								}else{
									echo "$insertResponce flase" ;
								}
							}
						}

				}
				
				
			}
		}

		
	}
*/


				$timesheetData=getTimeSheetDetailsByday($conn,113,$startDate=null,$endDate=null); //$d["emp_number"]

									if($timesheetData!=null){
										
										foreach ($timesheetData as $timesheetItem) {

											$date_arr= explode(":", $timesheetItem['actual_working_hours']);
											$duration=$date_arr[0]*3600+$date_arr[1]*60;
											$date=date('Y-m-d', strtotime($timesheetItem["punch_in_user_time"]));
											
											$maxId2= FindMaxValueId($conn);
											$incrementId=0;
											foreach($maxId2 as $autoIncrement2){
												//echo "".$autoIncrement2["id"].",";
												$incrementId=$autoIncrement2["id"]+1;
											}

											if($incrementId!=0){

												$timesheetSubmitedData=InsertOhrmTimesheetItem($conn,2317,
													$date,$duration,$incrementId);

												if($timesheetSubmitedData>0){
													echo "successfully submited the timesheet";
												}
											}
										}
									
								}else{
									echo "$insertResponce flase" ;
								}

?>