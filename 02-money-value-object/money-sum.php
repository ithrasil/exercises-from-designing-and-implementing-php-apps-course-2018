<?php

	class Money {
		public $amount, $currency;
		
		public function __construct(int $amount, string $currency) {
			$this->amount = $amount;
			$this->currency = $currency;
		}
		
		public function getAmount() {
  		return $this->amount;
		}
		
		public function getCurrency() {
  		return $this->currency;
		}
		
		public function add(Money $money) {
			if($this->currency != $money->getCurrency()) {
				throw "Podaj takie same waluty!";
			}
			$this->amount = $this->amount + $money->getAmount();
		}
		
		public function subtract(Money $money) {
			if($this->getCurrency() != $money->getCurrency()) {
				throw "Podaj takie same waluty!";
			}
			$this->amount = $this->amount - $money->getAmount();
		}
		
		public function multiply(float $multiplicator) {
			$this->amount = $this->amount * $multiplicator;
		}
		
		public function divide(float $divider) {
			$this->amount = $this->amount / $divider;
		}
	}

	interface MoneyFormatter {
		public function format(string $value);
	}

	class Formatter implements MoneyFormatter {
		private $separator, $sign;
		
		public function __construct(string $separator, string $sign) {
			$this->separator = $separator;
			$this->sign = $sign;
		}
		
		public function format(string $amount) : string {
			$amount = number_format((float)$amount, 2, '.', '');
			$pos_of_sign = strpos($amount, ".");
			
			if($pos_of_sign == false) {
				$before_sign = substr($amount, 0, $pos_of_sign);
				return $this->getSeparatedStr($before_sign);
			}
			else {
				$before_sign = substr($amount, 0, $pos_of_sign);
				$after_sign = substr($amount, $pos_of_sign+1, 2);

				return $this->getSeparatedStr($before_sign) . $this->sign . $after_sign;
			}
		}
		
		private function getSeparatedStr(string $str) : string {
			$len = strlen($str);
			
			$new_str = "";
			
			for($i=$len; $i>0; $i--) {
				if($i%3==0) {
					$new_str .= $this->separator;
				}
				$new_str .= $str[$len - $i];
			}
			return trim($new_str);
		}
	}

	unset($argv[0]);
	
	$used_currency = $argv[1];

	unset($argv[1]);

	$account = new Money(0, $used_currency);

	foreach($argv as $key => $arg) {
		$money = new Money($arg, $used_currency);
		$account->add($money);
	}

	$formatter = new Formatter(" ", ",");

	echo $formatter->format($account->getAmount()) . PHP_EOL;

?>