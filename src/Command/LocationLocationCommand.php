<?php

namespace App\Command;

use App\Repository\LocationRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'location:location',
    description: 'Add a short description for your command',
)]
class LocationLocationCommand extends Command
{
    public function __construct(private readonly LocationRepository $locationRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Location name')
            ->addArgument('country', InputArgument::OPTIONAL, 'Country code')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        $country = $input->getArgument('country');

        $searchCriteria = [
            'name' => $name
        ];

        if ($country) {
            $searchCriteria['country'] = $country;
        }

        $location = $this->locationRepository->findOneBy($searchCriteria);

        $io->writeln(sprintf('Location: %s (%d)',
            $location->getName(),
            $location->getId()
        ));

        $io->writeln(sprintf('[%s] Latitude: %s | Longitude: %s',
            $location->getCountry(),
            $location->getLatitude(),
            $location->getLongitude()
        ));

        return Command::SUCCESS;
    }
}
