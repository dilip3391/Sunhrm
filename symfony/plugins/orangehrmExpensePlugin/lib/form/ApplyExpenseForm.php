<?php
	
	class ApplyExpenseForm extends sfForm {



		protected static $choices= array('Select','Hotel','Flight','Cab','Parking','Others');
		protected static $client= array('Select','FHLB-Newyork','FHLB-Atlanta');
		protected static $project= array('Select','21','22','23');
		protected static $paid= array('Select','YES','NO');
		protected static $amount= array('dollars');
		private $allowedFileTypes = array(
        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "doc" => "application/msword",
        "doc" => "application/x-msword",
        "doc" => "application/vnd.ms-office",
        "odt" => "application/vnd.oasis.opendocument.text",
        "pdf" => "application/pdf",
        "pdf" => "application/x-pdf",
        "rtf" => "application/rtf",
        "rtf" => "text/rtf",
        "txt" => "text/plain"
    );

//     public function configure() {
//       $this->setWidgets(array(
//          'name'    => new sfWidgetFormInputText(),
//          'description'   => new sfWidgetFormInputText(),
//          'expense type' => new sfWidgetFormSelect(array('choices' => self::$choices)),
//          'message' => new sfWidgetFormTextarea(),
//          'Date' => new ohrmWidgetDatePicker(array(), array('id' => 'expense_date')),
//          'client name' => new sfWidgetFormSelect(array('choices' => self::$client)),
//          'project id' => new sfWidgetFormSelect(array('choices' => self::$project)),
// 		 'paid by company' => new sfWidgetFormSelect(array('choices' => self::$paid)),
// 		 'attachment' => new sfWidgetFormInputFileEditable(
//                     array('edit_mode' => false,
//                         'with_delete' => false,
//                         'file_src' => '')),
//          'amount' => new sfWidgetFormInputText(),
//        ));
// }
		public function configure() {

		        $this->setWidgets($this->getFormWidgets());
		        $this->setValidators($this->getFormValidators());

		        $this->getWidgetSchema()->setNameFormat('Expense[%s]');
		        $this->getWidgetSchema()->setLabels($this->getFormLabels());
    }

    /**
     *
     * @return array
     */

    protected function getFormWidgets() {
        $widgets = array(
         'Date' => new ohrmWidgetDatePicker(array(), array('id' => 'expense_date')),
         'name'    => new sfWidgetFormInputText(),
         'description'   => new sfWidgetFormInputText(),
         'expense type' => new sfWidgetFormSelect(array('choices' => self::$choices)),
         'message' => new sfWidgetFormTextarea(),
         'client name' => new sfWidgetFormSelect(array('choices' => self::$client)),
         'project id' => new sfWidgetFormSelect(array('choices' => self::$project)),
		 'paid by company' => new sfWidgetFormSelect(array('choices' => self::$paid)),
		 'attachment' => new sfWidgetFormInputFileEditable(
                    array('edit_mode' => false,
                        'with_delete' => false,
                        'file_src' => '')),
         'amount' => new sfWidgetFormInputText(),
       );
        return $widgets;
    }

    /**
     *
     * @return array
     */




    protected function getFormValidators() {

        $validators = array(
        	'Date' => new sfValidatorString(array('required' => false)),
            'name' => new sfValidatorString(array('required' => false)),
            'description' => new sfValidatorString(array('required' => false)),
            'expense type' => new sfValidatorString(array('required' => false)),          
            'client name' => new sfValidatorString(array('required' => false)),
            'project id' =>  new sfValidatorString(array('required' => false)),
            'paid by company' => new sfValidatorString(array('required' => false)),
            'attachment' => new sfValidatorString(array('required' => false)),
            'amount' => new sfValidatorString(array('required' => false))
        );
        return $validators;
    }

    protected function getFormLabels() {
        $labels = array(
        	'Date' =>  __('Date'),
            'name' => __('Employee Name'),           
            'description' => __('Description'),
            'expense type' =>  __('Expense Type'),
            'client name' =>  __('Client Name'),
            'project id' =>  __('Project Id'),
            'paid by company' =>  __('Paid By Company'),
            'attachment' =>  __('Attachment'),
            'amount' =>  __('Amount')
        );
        return $labels;
    }

    /**
     *
     * @return array
     */

    public function getSearchActionButtons() {
        return array(
            'btnSearch' => new ohrmWidgetButton('btnSubmit', 'Submit', array()),
            'btnReset' => new ohrmWidgetButton('btnReset', 'Reset', array('class' => 'reset')),
        );
    }

    	public function getStylesheets() {
        $stylesheets = parent::getStylesheets();
        $stylesheets[plugin_web_path('orangehrmPerformancePlugin','css/searchReviewSuccess.css')] = 'all';
        return $stylesheets;
        
    }



  }

?>
