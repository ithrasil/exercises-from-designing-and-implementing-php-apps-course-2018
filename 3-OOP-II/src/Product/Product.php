<?php

namespace Product;

	class Product implements IProduct {
		protected $price, $name;
		
		public function __construct($name, $price) {
			$this->name = $name;
			$this->price = $price;
		}
		
		public function getName() : string {
			return $this->name;
		}
		
		public function getPrice() : Money\Money {
			return $this->price;
		}
	}
?>