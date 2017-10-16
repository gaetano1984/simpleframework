<?php

	namespace app\Validation;

	class validation{
		public function __construct(){

		}
		public function buildError($request){
			$res = [];
			$err_mess = $this->validator->getMessages();
			foreach($request->all() as $k=>$v){
				$res[$k] = [
					'value' => $v
				];
				if(array_key_exists($k, $err_mess)){
					$res[$k]['err'] = $err_mess[$k][0]->__toString();
				}
			}
			return $res;
		}
		public function validate($request){
			$valid = $this->validator->validate($request)==true ? 1 : $this->buildError($request);
			return $valid;
		}
	}

?>
