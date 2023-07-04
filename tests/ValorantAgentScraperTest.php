<?php

use PHPUnit\Framework\TestCase;
use Quentindrouet\Rendu1\ValorantAgentScraper;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ValorantAgentScraperTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testScrapeAgents(): void
    {
        $scraper = new ValorantAgentScraper();
        $agents = $scraper->scrapeAgents();

        $this->assertNotEmpty($agents);

        foreach ($agents as $agent) {
            $this->assertArrayHasKey('name', $agent);
            $this->assertArrayHasKey('biography', $agent);
        }
    }
}
