<?php 

namespace UnitTests;

use PHPUnit\Framework\TestCase;
use DiDom\Element;
use DOMText;
use App\Utils;

class UtilsTest extends TestCase
{
	/** @test */
	public function price_to_int_works()
	{
		$this->assertEquals(Utils::price_to_int("1.45"), 145);
		$this->assertEquals(Utils::price_to_int("10.20"), 1020);
		$this->assertEquals(Utils::price_to_int("0.0"), 0);
	}
	/** @test */
	public function elem_to_text_replace_br_works()
	{
		$elem = new Element("div", "hello");
		$elem->appendChild(new Element("br"));
		$elem->appendChild(new DOMText("world"));

		$result = Utils::elem_to_text_replace_br($elem, "&");
		$expected = 'hello&world';
		$this->assertEquals($result, $expected);
	}
}

?>
