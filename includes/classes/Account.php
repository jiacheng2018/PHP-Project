<?php
	class Account {

        private $errorArray;
		public function __construct() {
            $this->errorArray=array();
		}

		public function register($un,$fn,$ln,$em,$em2,$pw,$pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);
			if(empty($this->errorArray)==true){
                return true;
			}else{
				return false;
			}
		}

		private function validateUsername($un) {
			if(strlen($un)>25||strlen($un)<5){
               array.push($this->$errorArray,"Your User name is too Short");
               return;
			}
			//Todo:check is user name exist
		}

		private function validateFirstName($fn) {
			if(strlen($fn)>25||strlen($fn)<2){
               array.push($this->$errorArray,"Your User name is too Short");
               return;
			}
			
		}

		private function validateLastName($ln) {
			if(strlen($ln)>25||strlen($ln)<2){
               array.push($this->$errorArray,"Your User name is too Short");
               return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em!=$em2){
				array_push($this->$errorArray,"Your Email is mismatch");
				return;
			}
			if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
				array_push($this->$errorArray,"Email is invalid");
				return;
			}
		}
        public function getError($error){
          if(!in_array($error,$this->errorArray)){
          	$error="";
          }
          return "<span class='errorMessage'>$error</span>"
        }
		private function validatePasswords($pw, $pw2) {
			if($pw!=$pw2){
				array_push($this->$errorArray,"password is invalid");
				return;
			}
			if(preg_match('/[^A_Za-z0-9]$/', $pw)){
                array_push($this->$errorArray,"password can only containes");
				return;
			}
			if(strlen($pw)>25||strlen($pw)<5){
               array.push($this->$errorArray,"Your password is not enough length");
               return;
			}
		}
	}
?>