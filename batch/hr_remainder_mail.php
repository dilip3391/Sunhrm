<!--Birthday List For Current Date-->
<?php
require_once('db/database.php');
require_once('db/users.php');
require_once('util/timesheet_util.php');
$conn    = connect($config);
$messageBody = '';
$birthdaylistForToday =getBirthdaylistForToday($conn);
    
    if($birthdaylistForToday){
      $messageBody =  $messageBody ."<h4>Birthdaylist For Today:</h4>";
       $messageBody =  $messageBody . "<table border=1><tr><th>Employee ID</th><th>Employee Full Name</th><th>Date of Birth</th><th>Email id</th><th>Department name</th>";
     
       $messageBody =  $messageBody . getRowsFromList($birthdaylistForToday);
       $messageBody =  $messageBody . "</table>";
       //print_r($birthdaylistForToday);
    }

 //Anniversary List For Current Date 
$anniversarylistForToday =getAnniversarylistForToday($conn);
    
    if($anniversarylistForToday){
       $messageBody =  $messageBody . "<h4>Anniversarylist For Today:</h4>";
       $messageBody =  $messageBody .  "<table border=1><tr><th>Employee ID</th><th>Employee Full Name</th><th>Joined Date</th><th>Email id</th><th>Department name</th>";
    
       $messageBody =  $messageBody . getRowsFromList($anniversarylistForToday);
       $messageBody =  $messageBody .  "</table>";
    }

//Employee Confirmation List For Current Date
$employeeConfirmationlistForToday =getEmployeeConfirmationlistForToday($conn);
    
    if($employeeConfirmationlistForToday){
       $messageBody =  $messageBody . "<h4>EmployeeConfirmationlist For Today:</h4>";
       $messageBody =  $messageBody .  "<table border=1 ><tr><th>Employee ID</th><th>Employee Full Name</th><th>Joined Date</th><th>Email id</th><th>Department name</th>";

       $messageBody =  $messageBody . getRowsFromList($employeeConfirmationlistForToday);
       $messageBody =  $messageBody .  "</table>";
    }


  function getRowsFromList($arrayList){
    $rows = '';
    foreach ($arrayList as $object) {
      $rows= $rows. "<tr>";
      $rows= $rows. "<td>".$object[0]."</td>";
      $rows= $rows. "<td>".$object[1]." ".$object[2]." ".$object[3]."</td>";
      $rows= $rows. "<td>".$object[4]."</td>";
          $rows= $rows. "<td>".$object[5]."</td>";
          $rows= $rows. "<td>".$object[6]."</td>";
          $rows= $rows. "</tr>";
        }
        return $rows;
  
  }
  echo $messageBody;

  echo sendEmail($messageBody ,'HR remainder email', 'tahiri@suntechnologies.com,ramyak@suntechnologies.com');

?>
