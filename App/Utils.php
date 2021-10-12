<?php 

namespace App;

class Utils
{
	// Converts a price string with a decimal point and two decimal
	// places to an int i.e. the number of pennies in total.
	static function price_to_int(string $price)
	{
		list($pounds, $pennies) = mb_split("\.", $price);
		return intval($pounds) * 100 + intval($pennies);
	}


	// Filters the children of the given element to remove br tags
	// and then joins the remaining using the given separator
	static function elem_to_text_replace_br($elem, $sep)
	{
		$is_not_br = fn($child) => $child != "<br>";
		$filtered = array_filter($elem->children(), $is_not_br);
		return join($sep, $filtered);
	}

}
?>
