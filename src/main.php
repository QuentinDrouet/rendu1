<?php

require_once 'vendor/autoload.php';

use Quentindrouet\Rendu1\ValorantAgentScraper;

$scraper = new ValorantAgentScraper();
$agents = $scraper->scrapeAgents();

print_r($agents);
