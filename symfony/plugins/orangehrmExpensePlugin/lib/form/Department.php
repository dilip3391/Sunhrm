<?php

	class Department {
		
		private $employeId;
		private $employefirstname;
		private $employelastname;
		private $timesheetstatus;
		private $timesheetWeekDates;
		private $employeeService;
		private $employeeManagers;
		private $selectedDepartment;
       	private $index=0; 

		public function getEmployeeService() {
	        if(is_null($this->employeeService)) {
	            $this->employeeService = new EmployeeService();
	            $this->employeeService->setEmployeeDao(new EmployeeDao());
	        }
        	return $this->employeeService;
    	}

    	public function getImmediateSupervisors($empnumber) {
    		return $this->getEmployeeService()->getSupervisorListForEmployee($empnumber);
    	}

		public function loadData($data,$index)
		{
			//var_dump($request->getParameter('sub_unit'));exit;
			$this->index = $index;
			$this->employeId = $data['emp_number'];
			$this->employefirstname = $data['emp_firstname'];
			$this->employelastname = $data['emp_lastname'];
			$this->timesheetstatus = $data['state'];
			$this->timesheetWeekStartDate = $data['start_date'];
			$this->timesheetWeekEndDate = $data['end_date'];
			if (isset($data['department']) && !empty($data['department'])) {
				$this->selectedDepartment = $data['department'];
			} else {
				$this->selectedDepartment = "";
			}
			
			$getManagerDetails = $this->getImmediateSupervisors($data['emp_number']);
			$mangerNames = array();
			foreach ($getManagerDetails as $value) {
				$manger=$value['emp_firstname']." ".$value['emp_lastname'];
				array_push($mangerNames,$manger);
				
			} 

			$this->employeeManagers=implode(', ',$mangerNames);
	   }

		public function getemployefirstname(){
			return $this->employefirstname;
		}

		public function getemployelastname(){
			return $this->employelastname;
		}

		public function getFullName(){
			return $this->employefirstname." ".$this->employelastname;
		}

		public function getTimesheetStatus(){
			return $this->timesheetstatus;
		}

		public function getTimesheetWeekDates(){
			return $this->timesheetWeekStartDate." ". __("to") . " " .$this->timesheetWeekEndDate;
		}

		public function getReportingManagerDetails(){
			return $this->employeeManagers;
		}

		public function getCountDetails(){
			return $this->index;
		}

		public function getDepartmentName(){
			return $this->selectedDepartment;
		}

	}
?>
