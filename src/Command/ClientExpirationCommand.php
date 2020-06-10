<?php

namespace App\Command;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ClientExpirationCommand extends Command
{
    protected static $defaultName = 'app:client-expiration';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Run the client expiration checks and transition expired clients. ')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Execute transitions on expired clients. Otherwise, actions will only be reported.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $force = $input->getOption('force') !== false;
        $io = new SymfonyStyle($input, $output);
        $clientRepo = $this->em->getRepository(Client::class);

        $headers = ['Client', 'Partner', 'Expiration Reason', 'Expiration Date'];

        $agedOutClients = $clientRepo->findAllActiveAgedOut();

        $ageRows = array_map(function(Client $client) {
            return [
                (string) $client,
                (string) $client->getPartner(),
                'Age Expiration',
                $client->getAgeExpiresAt()->format('Y-m-d'),
            ];
        }, $agedOutClients);

        $maxDistributionClients = $clientRepo->findAllActiveMaxDistributions();

        $distRows = array_map(function(Client $client) {
            return [
                (string) $client,
                (string) $client->getPartner(),
                'Distribution Expiration',
                $client->getDistributionExpiresAt()->format('Y-m-d'),
            ];
        }, $maxDistributionClients);

        $rows = array_merge($ageRows, $distRows);

        $io->table($headers, array_merge($ageRows, $rows));

        $io->warning(sprintf('%d client(s) are queued for expiration.', count($rows)));

        return 0;
    }

}
