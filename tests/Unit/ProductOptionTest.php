<?php

namespace UnitTests;

use App\ProductOption;

class ProductOptionTest
{
	protected function setUp(): void
	{
		$this->po = ProductOption("title", "description", 100, 200);
		$this->po_json = $this->po->jsonSerialize();
	}
	/** @test */
	public function json_has_option_title(): void 
	{
		$this->assertArrayHasKey('option title', $this->po_json);
	}
	/** @test */
	public function json_has_description(): void 
	{
		$this->assertArrayHasKey('description', $this->po_json);
	}
	/** @test */
	public function json_has_price(): void 
	{
		$this->assertArrayHasKey('price', $this->po_json);
	}
	/** @test */
	public function json_has_discount(): void 
	{
		$this->assertArrayHasKey('discount', $this->po_json);
	}
	/** @test */
	public function json_option_title_correct(): void 
	{
		$this->assertEquals($this->po_json['option_title'], "title");
	}
	/** @test */
	public function json_description_correct(): void 
	{
		$this->assertEquals($this->po_json['description'], "description");
	}
	/** @test */
	public function json_price_correct(): void 
	{
		$this->assertEquals($this->po_json['price'], 100);
	}
	/** @test */
	public function json_discount_correct(): void 
	{
		$this->assertEquals($this->po_json['discount'], 200);
	}
}

?>