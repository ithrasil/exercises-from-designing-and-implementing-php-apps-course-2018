<?php

namespace Discounted;

	use Money\Money;

	class Discounted extends Product {
		private $discount;
		
		public function __construct(IProduct $product,int $discount) {
			parent::__construct($product->getName(), $product->getPrice());
			$this->discount = $discount;
		}
		
		public function getPrice() : Money {
			return $this->price->multiply(1 - $this->discount/100);
		}
	}
?>