<?php 

namespace App;

// A class to represent product options. 
class ProductOption implements \JsonSerializable
{
	function __construct(
		public string $title,
		public string $description,
		public int $annual_price,
		public int $discount
	) {}
	function monthlyPrice(): float
	{
		return $this->annual_price / 12.0;
	}
	public function jsonSerialize(): mixed
	{
		return [
			"option title" => $this->title,
			"description" => $this->description,
			"price" => $this->annual_price,
			"discount" => $this->discount,
		];
	}
}
?>
