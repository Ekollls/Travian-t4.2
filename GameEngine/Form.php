<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

class Form {
	
	private $errorarray = array();
	public $valuearray = array();
	private $errorcount;
	
	public function Form() {
		if(isset($_SESSION['errorarray']) && isset($_SESSION['valuearray'])) {
			$this->errorarray = $_SESSION['errorarray'];
			$this->valuearray = $_SESSION['valuearray'];
			$this->errorcount = count($this->errorarray);
			
			unset($_SESSION['errorarray']);
			unset($_SESSION['valuearray']);
		}
		else {
			$this->errorcount = 0;
		}
	}
	
	public function addError($field,$error) {
		$this->errorarray[$field] = $error;
		$this->errorcount = count($this->errorarray);
	}
	
	public function getError($field) {
		if(array_key_exists($field,$this->errorarray)) {
			return $this->errorarray[$field];
		}
		else {
			return "";
		}
	}
	
	public function getValue($field) {
		if(array_key_exists($field,$this->valuearray)) {
			return $this->valuearray[$field];
		}
		else {
			return "";
		}
	}
	
	public function getDiff($field,$cookie) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] != $cookie) {
			return $this->valuearray[$field];
		}
		else {
			return $cookie;
		}
	}
	
	public function getRadio($field,$value) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] == $value) {
			return "checked";
		}
		else {
			return "";
		}
	}
	
	public function returnErrors() {
		return $this->errorcount;
	}
	
	public function getErrors() {
		return $this->errorarray;
	}
};
?>