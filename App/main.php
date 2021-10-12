<?php

namespace App;

require 'vendor/autoload.php';

use DiDom\Document; 

// URL to scrape
const url = 'https://videx.comesconnected.com/';

// Get HTML from URL
$document = new Document();
$document->loadHtmlFile(url);

// Get all products
$product_scraper = new Scraper($document);
$product_options = $product_scraper->getProducts();

// Print JSON of products
echo json_encode(array_values($product_options), JSON_PRETTY_PRINT);
?>
