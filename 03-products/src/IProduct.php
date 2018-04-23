<?php
	interface IProduct {
			public function getName(): string;
		
			public function getPrice(): Money\Money;
	}
?>