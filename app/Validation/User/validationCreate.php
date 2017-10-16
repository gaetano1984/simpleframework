<?php

	namespace app\Validation\User;

	use Sirius\Validation\Validator;
	use app\Validation\validation;

	class validationCreate extends validation{
		public $valid_config = [];
		public $validator;
		public function __construct(){
			$this->setValidation();
		}
		public function setValidation(){
			$this->validator = new Validator();
			$this->valid_config = [
				'name:Nome' => 'required | alpha'
				,'surname:Cognome' => 'required | alpha'
				,'email:Email' => 'required | email'
			];
			$this->validator->add($this->valid_config);
		}
		
	}

?>