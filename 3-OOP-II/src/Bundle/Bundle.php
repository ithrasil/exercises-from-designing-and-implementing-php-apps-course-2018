<?php

	namespace Bundle;
	use

	class Bundle implements IProduct {
		private $price, $name, $products;
		
		public function __construct($name, $products) {
			$this->name = $name;
			$this->products = $products;
			
			$totalPrice = $products[0]->getPrice();
			$price = new Money(0, $products[0]->getPrice()->getCurrency());
			
			unset($products[0]);
		
			foreach($products as $product) {
				$totalPrice = $totalPrice->add($product->getPrice());				
			}
			$this->price = $totalPrice;
		}
		
		public function getName() : string {
			return $this->name;
		}
		
		public function getPrice() : Money\Money {
			return $this->price;
		}
	}

?>