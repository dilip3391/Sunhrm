<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginLeave extends BaseLeave {
    const LEAVE_STATUS_LEAVE_REJECTED = -1;
    const LEAVE_STATUS_LEAVE_CANCELLED = 0;
    const LEAVE_STATUS_LEAVE_PENDING_APPROVAL = 1;
    const LEAVE_STATUS_LEAVE_APPROVED = 2;
    const LEAVE_STATUS_LEAVE_TAKEN = 3;
    const LEAVE_STATUS_LEAVE_WEEKEND = 4;
    const LEAVE_STATUS_LEAVE_HOLIDAY = 5;
    
    const LEAVE_STATUS_LEAVE_TYPE_DELETED_TEXT = 'LEAVE TYPE DELETED';
    
    const LEAVE_STATUS_LEAVE_PENDING_APPROVAL_TEXT = 'Pending Approval';
    
    const PENDING_APPROVAL_STATUS_PREFIX = 'PENDING APPROVAL';
    
    const DURATION_TYPE_FULL_DAY = 0;
    const DURATION_TYPE_HALF_DAY_AM = 1;
    const DURATION_TYPE_HALF_DAY_PM = 2;
    const DURATION_TYPE_SPECIFY_TIME = 3;

    private static $leaveStatusText = array(
        self::LEAVE_STATUS_LEAVE_REJECTED => 'REJECTED',
        self::LEAVE_STATUS_LEAVE_CANCELLED => 'CANCELLED',
        self::LEAVE_STATUS_LEAVE_PENDING_APPROVAL => 'PENDING APPROVAL',
        self::LEAVE_STATUS_LEAVE_APPROVED => 'SCHEDULED',
        self::LEAVE_STATUS_LEAVE_TAKEN => 'TAKEN'       
    );
    
    private static $nonWorkingDayStatuses = array(
        self::LEAVE_STATUS_LEAVE_WEEKEND,
        self::LEAVE_STATUS_LEAVE_HOLIDAY,
    );

    private static $leaveStatusListFromDb;
    
    protected static function getLeaveStatusListFromDb() {
        if (empty(self::$leaveStatusListFromDb)) {
            
            self::$leaveStatusListFromDb = array();
            
            $statusList = Doctrine::getTable('LeaveStatus')->findAll(Doctrine::HYDRATE_ARRAY);
            foreach ($statusList as $status) {
                self::$leaveStatusListFromDb[$status['status']] = $status['name'];
            }
        }
        return self::$leaveStatusListFromDb;
    }
    public function getTextLeaveStatus() {
        
        $status = $this->getStatus();
        
        // check in user defined statuses
        $statusList = self::getLeaveStatusListFromDb();
        if (array_key_exists($status, $statusList)) {            
            return $statusList[$status];
        }
                        
        if (array_key_exists($status, self::$leaveStatusText)) {            
            return self::$leaveStatusText[$status];
        }        
        
        return '';
    }
    
    public static function getTextForLeaveStatus($status) {
        
        // check in user defined statuses
        $statusList = self::getLeaveStatusListFromDb();
        if (array_key_exists($status, $statusList)) {            
            return $statusList[$status];
        }        
        
        if (array_key_exists($status, self::$leaveStatusText)) {            
            return self::$leaveStatusText[$status];
        }        

        return '';        
    }
    
    public static function getLeaveStatusForText($status) {
        $statusList = self::getLeaveStatusListFromDb();
        $statusInt = array_search($status, $statusList);
            
        if ($statusInt === false) {
            $statusInt = array_search($status, self::$leaveStatusText);
        }
        
        if ($statusInt === false) {
            return null;
        } else {
            return $statusInt;
        }
    }
    
    public static function getStatusTextList() {
        $statusList = self::getLeaveStatusListFromDb();
        $workingStatuses = array();
        
        // filter out holidays
        foreach ($statusList as $key => $status) {
            if (!in_array($key, self::$nonWorkingDayStatuses)) {
                $workingStatuses[$key] = $status;
            }
        }
                        
        $leaveStatuses = array_map('strtolower', $workingStatuses);
        $leaveStatuses = array_map('ucwords', $leaveStatuses);
        return $leaveStatuses;
    }

    public static function getPendingLeaveStatusList() {
        $pendingStatusList = array();
        $statusList = self::getLeaveStatusListFromDb();
        foreach($statusList as $key => $status) {
            if (0 === strpos($status, self::PENDING_APPROVAL_STATUS_PREFIX)) {
                $pendingStatusList[$key] = $status;
            }
        }
        
        return $pendingStatusList;
    }
    public function isNonWorkingDay() {
        if (($this->getLengthHours() == 0.00) && in_array($this->getStatus(), self::$nonWorkingDayStatuses)) {
            return true;
        }
        return false;
    }

    public function getNumberOfDays() {
        return $this->getLeaveRequest()->getNumberOfDays();
    }

    public function getLeaveBalance() {
        $statusList = self::getLeaveStatusListFromDb();        
        return $this->getLeaveRequest()->getLeaveBalance();
    }

    public function getDetailedLeaveListQuotaHolderValue() {
        return "1";
    }

    public function getDetailedLeaveListRequestIdHolderValue() {
        return "0";
    }

    public function getLeaveDurationAsAString() {

        if ($this->getStartTime() != '00:00:00' || $this->getEndTime() != '00:00:00') {
            return "(" . (date("H:i", strtotime($this->getStartTime()))) . " - " . date("H:i", strtotime($this->getEndTime())) . ")";
        } else {
            return '';
        }
    }

    public function getFormattedLeaveDateToView() {
        $date = set_datepicker_date_format($this->getDate());
        
        // check if partial leave
        $durationType = $this->getDurationType();
        
        if ($durationType != self::DURATION_TYPE_FULL_DAY) {
            $time = date('H:i', strtotime($this->getStartTime())) . ' - ' . date('H:i', strtotime($this->getEndTime()));
            $date .= ' (' . $time . ')';
            
            if (($durationType == self::DURATION_TYPE_HALF_DAY_AM) || 
                    ($durationType == self::DURATION_TYPE_HALF_DAY_PM)) {
                $date .= ' ' . __('Half Day');
            }
        }
        return $date;
    }

    public function getFormattedLeaveDateToViewForTimesheet() {
        $date = set_datepicker_date_format($this->getDate());
        
        // check if partial leave
        $durationType = $this->getDurationType();
        
        if ($durationType != self::DURATION_TYPE_FULL_DAY) {
            $time = date('H:i', strtotime($this->getStartTime())) . ' - ' . date('H:i', strtotime($this->getEndTime()));
            $date .= ' - ' ;
            
            if ($time == "09:00 - 13:00") { 
                $date .= ' ' . __('First Half');
            } elseif($time == "13:00 - 17:00"){
                $date .= ' ' . __('Second Half');
            }
        }
        return $date;
    }

    public function getLatestCommentAsText() {
        $latestComment = '';
        $leaveComments = $this->getLeaveComment();
        
        if (count($leaveComments) > 0) {
            $lastComment = $leaveComments->getLast();
            $latestComment = $lastComment->getComments();
        }
        
        return $latestComment;
    }

    public function getCommentsAsText() {
        $leaveComments = $this->getLeaveComment();
        
        $allComments = '';
                
        // show last comment only
        if (count($leaveComments) > 0) {
            
            foreach ($leaveComments as $comment) {
                $created = new DateTime($comment->getCreated());
                $createdAt = set_datepicker_date_format($created->format('Y-m-d')) . ' ' . $created->format('H:i');
                
                $formatComment = $createdAt . ' ' . $comment->getCreatedByName() . "\n\n" .
                        $comment->getComments();
                $allComments = $formatComment . "\n\n" . $allComments;
            }
        }
        
        return $allComments;
    }    
}