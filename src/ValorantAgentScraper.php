<?php

declare(strict_types=1);

namespace Quentindrouet\Rendu1;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ValorantAgentScraper
{
    private \Symfony\Contracts\HttpClient\HttpClientInterface $client;
    private Crawler $crawler;

    public function __construct()
    {
        $this->client = HttpClient::create();
        $this->crawler = new Crawler();
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @return array<int, array<string, string>>
     */
    public function scrapeAgents(): array
    {
        $url = 'https://www.mandatory.gg/les-agents-de-valorant/';
        $response = $this->client->request('GET', $url);
        $html = $response->getContent();

        $this->crawler->addHtmlContent($html);

        $agents = [];

        $this->crawler->filter('.image-with-title')->each(function (Crawler $node) use (&$agents) {
            $agentPageUrl = $node->attr('href');
            if (is_string($agentPageUrl)) {
                $agentInfo = $this->scrapeAgentPage($agentPageUrl);
                if ($agentInfo) {
                    $agents[] = $agentInfo;
                }
            }
        });

        return $agents;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @return array<string, string>
     */
    private function scrapeAgentPage(string $url): array
    {
        $response = $this->client->request('GET', $url);
        $html = $response->getContent();

        $pageCrawler = new Crawler($html);

        $name = $pageCrawler->filter('.data h1')->text();
        $biographyParagraphs = $pageCrawler->filter('.data p')->each(function (Crawler $paragraph) {
            return trim($paragraph->text());
        });
        $biography = implode(' ', $biographyParagraphs);

        return [
            'name' => trim($name),
            'biography' => trim($biography)
        ];
    }
}
