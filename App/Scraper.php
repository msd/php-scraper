<?php

namespace App;

require 'vendor/autoload.php';

use DiDom\Document;
use DiDom\Element; 

// CSS selectors
// Selects option container from the body 
const dom_to_product_selector = 'div.pricing-table div.row-subscriptions > div';
// Selects title form option container
const product_to_title_selector = 'div.header';
// Selects description form option container
const product_to_description_selector = 'div.package-features div.package-name';
// Selects price form option container
const product_to_price_selector = 'div.package-features div.package-price > span.price-big';
// Selects discount form option container
const product_to_discount_selector = 'div.package-features div.package-price > p';

class Scraper
{
	function __construct(private Document $document) {}

	// Finds all product options and returns them in descending order
	// of annual price
	function getProducts() : array
	{
		$option_elems = $this->document->find(dom_to_product_selector);
		$options = array_map(
			function ($option_elem) {
				// Extract all the fields
				$title = trim($option_elem->first(product_to_title_selector)->text());
				$description_elem = $option_elem->first(product_to_description_selector);
				$description = Utils::elem_to_text_replace_br($description_elem, " ");
				$annual_price = Utils::price_to_int(mb_substr($option_elem->first(product_to_price_selector)->text(), 1));
				$is_monthly = mb_strpos($option_elem->first(product_to_price_selector)->parent()->text(), "Per Month");
				// Convert monthly to yearly price
				if ($is_monthly)
				{
					$annual_price *= 12;
				}
				// Attempt to extact a discount, if one exists
				if ($discount_elem = $option_elem->first(product_to_discount_selector))
				{
					$discount = intval(mb_substr(mb_split("\s", $discount_elem->text())[1], 1));
				}
				else
				{
					$discount = 0;
				}

				// Construct a new product
				$product_option = new ProductOption($title, $description, $annual_price, $discount, false);
				return $product_option;
			}, $option_elems);

		// Sort by descending annual price
		uasort($options, fn($a,$b) => $b->annual_price - $a->annual_price);

		return $options;
	}
}
?>
