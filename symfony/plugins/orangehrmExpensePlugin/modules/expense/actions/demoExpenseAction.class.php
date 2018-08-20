<?php

class demoExpenseAction extends baseTimeAction {

    /**
    * This is the entry function for the request that is hitting the servers
    */
  	public function execute($request) {
			//  $values['calFromDate'] = $this->_getStandardDate($values['calFromDate']);

            
   //      }
   //      protected function _getStandardDate($localizedDate) {
   //      $localizationService = new LocalizationService();
   //    $format = sfContext::getInstance()->getUser()->getDateFormat();
   //      $trimmedValue = trim($localizedDate);
   //      $result = $localizationService->convertPHPFormatDateToISOFormatDate($format, $trimmedValue);
   //      return $result;
   //  }
   // protected function getApplyExpenseForm($mode) {
   //      $this->form = new ApplyExpenseForm($mode);
   //      return $this->form;
   //  }
        $this-> setTemplate('demoExpense');
        $this->form = new ApplyExpenseForm();
}

}
?>
 