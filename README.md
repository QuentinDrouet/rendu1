# Valorant Agent Scraper

Valorant Agent Scraper is a PHP library that allows you to scrape data about agents from the game Valorant, available on the website [mandatory.gg](https://www.mandatory.gg/les-agents-de-valorant/). This library fetches the agent's name and biography and represents it in a PHP object.

## Requirements

- PHP >= 8.0
- Composer

## Installation

```bash
composer require quentindrouet/rendu1
```


## Usage

Here is an example that shows how you can use Valorant Agent Scraper to scrape data about agents from the website:

```php
<?php

require_once 'vendor/autoload.php';

use Quentindrouet\Rendu1\ValorantAgentScraper;

// Create a new scraper instance
$scraper = new ValorantAgentScraper();

// Scrape the agents
$agents = $scraper->scrapeAgents();

// Output the scraped data
foreach ($agents as $agent) {
    echo "Name: " . $agent['name'] . "\n";
    echo "Biography: " . $agent['biography'] . "\n\n";
}
```

## Testing
This library includes unit tests. To run the tests, first, make sure you have installed the dependencies with Composer, then run:
```bash
php vendor/bin/phpunit tests
```

## Code Analysis
The library utilizes PHPStan for code analysis. To execute PHPStan, run:
```bash
php vendor/bin/phpstan analyse src tests --level max
```

## Contributing
Contributions are welcome. Please make sure that your code follows the PSR-12 coding standard. You can use the PHP CS Fixer to check and fix coding standards:
```bash
php vendor/bin/php-cs-fixer fix src --rules=@PSR12
php vendor/bin/php-cs-fixer fix tests --rules=@PSR12
```

## License
Valorant Agent Scraper is licensed under the [MIT License](https://opensource.org/license/mit/)
