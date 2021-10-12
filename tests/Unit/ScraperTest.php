<?php 

namespace UnitTests;

use PHPUnit\Framework\TestCase;
use DiDom\Document;
use App\Scraper;

class ScraperTest extends TestCase
{
	/** @test */
	public function scraper_works()
	{
		$document = new Document();
		$html_str = <<<HTML
			<!DOCTYPE html>
			<html><body><div class="pricing-table">
				<div class="row-subscriptions">
				</div>
			</div></body></html>
			HTML;
		$document->loadHtml($html_str);

		$scraper = new Scraper($document);
		$this->assertEmpty($scraper->getProducts());
	}
}	

?>
