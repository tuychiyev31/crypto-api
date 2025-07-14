<?php

namespace App\Command;

use App\Entity\CryptoCurrency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

#[AsCommand(
    name: 'app:fetch-crypto',
    description: 'Fetch cryptocurrency data from external API and save to database',
)]
class FetchCryptoCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Fetching crypto data...</info>');

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');

        if ($response->getStatusCode() !== 200) {
            $output->writeln('<error>Failed to fetch data from API</error>');
            return Command::FAILURE;
        }

        $data = $response->toArray();

        foreach ($data as $item) {
            $crypto = new CryptoCurrency();
            $crypto->setSymbol($item['symbol']);
            $crypto->setName($item['name']);
            $crypto->setPrice($item['current_price']);
            $crypto->setChange24h($item['price_change_percentage_24h'] ?? null);
            $crypto->setMarketCap($item['market_cap'] ?? null);
            $crypto->setVolume24h($item['total_volume'] ?? null);
            $crypto->setFetchedAt(new \DateTimeImmutable());

            $this->em->persist($crypto);
        }

        $this->em->flush();

        $output->writeln('<info>Data successfully saved to the database.</info>');
        return Command::SUCCESS;
    }
}
