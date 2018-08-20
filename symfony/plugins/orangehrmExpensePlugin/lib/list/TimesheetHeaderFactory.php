<?php

	class TimesheetHeaderFactory extends ohrmListConfigurationFactory{
		
		protected function init() {
			
			$header1 = new ListHeader();
			$header2 = new ListHeader();
			$header3 = new ListHeader();
	        $header4 = new ListHeader();
	        $header5 = new ListHeader();

		$header1->populateFromArray(array(
		    'name' => 'Employee name',
		    'width' => '30%',
		    'isSortable' => false,
		    'sortField' => 'user_name',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => array('getFullName','getFullName')),
		    
		));
		
		$header2->populateFromArray(array(
		    'name' => 'Status',
		    'width' => '15%',
		    'isSortable' => false,
		    'filters' => array('I18nCellFilter' => array()
                              ),
		    'sortField' => 'display_name',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => array('getTimesheetStatus','getTimesheetStatus')),
		    
		));

		 $header3->populateFromArray(array(
		    'name' => 'Timesheet Period',
		    'width' => '15%',
		    'isSortable' => false,
		    'sortField' => 'u.Employee.emp_firstname',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => array('getTimesheetWeekDates','getTimesheetWeekDates')),
		    
		));
                
        $header4->populateFromArray(array(
		    'name' => 'Reporting Manager',
		    'width' => '45%',
		    'isSortable' => false,
            'filters' => array('I18nCellFilter' => array()
                              ),
		    'sortField' => 'status',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => 'getReportingManagerDetails'),
		    
		));
		$header5->populateFromArray(array(
		    'name' => 'Sl No',
		    'width' => '5%',
		    'isSortable' => false,
            'filters' => array('I18nCellFilter' => array()
                              ),
		    'sortField' => 'status',
		    'elementType' => 'label', 
		    //echo ++$index,
		    'elementProperty' => array('getter' => 'getCountDetails'),
		    
		));

		$this->headers = array($header5,$header1,$header2,$header3,$header4);
	}

	public function getClassName() {
		return '';
	}
  }

?>