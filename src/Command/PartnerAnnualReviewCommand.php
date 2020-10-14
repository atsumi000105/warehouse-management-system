<?php

namespace App\Command;

use App\Entity\Client;
use App\Entity\Partner;
use App\Entity\Setting;
use Doctrine\ORM\EntityManagerInterface;
use Moment\Moment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Workflow\Registry;

class PartnerAnnualReviewCommand extends Command
{
    protected static $defaultName = 'app:partner-review:run';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Registry
     */
    private $workflowRegistry;

    public function __construct(EntityManagerInterface $em, Registry $workflowRegistry)
    {
        $this->em = $em;
        $this->workflowRegistry = $workflowRegistry;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Run the partner annual review job.')
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'Execute transitions on partners need to be moved if we are in the review window.'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $force = $input->getOption('force') !== false;
        $io = new SymfonyStyle($input, $output);
        $partnerRepo = $this->em->getRepository(Partner::class);

        $settingsRepo = $this->em->getRepository(Setting::class);

        $now = new Moment('now');

        $start = new Moment($settingsRepo->find('partnerReviewStart')->getValue());
        $start->setYear($now->getYear());
        $end = new Moment($settingsRepo->find('partnerReviewEnd')->getValue());
        $end->setYear($now->getYear());

        $lastStart = new Moment($settingsRepo->find('partnerReviewLastStartRun')->getValue());
        $lastEnd = new Moment($settingsRepo->find('partnerReviewLastEndRun')->getValue());

        if(!$now->isBetween($start, $end) && $lastEnd->isAfter($end)) {
            return;
        }


        if ($lastStart->isBefore($start)) {
            $activePartners = $this->em->getRepository(Partner::class)->findBy(['status' => Partner::STATUS_ACTIVE]);

            foreach ($activePartners as $partner) {
                $this->workflowRegistry
                    ->get($partner)
                    ->apply($partner, Partner::TRANSITION_FLAG_FOR_REVIEW);
            }

            $this->em->flush();
        }
        else if ($now->isAfter($end) && $lastEnd->isBefore($end)) {
            $activePartners = $this->em->getRepository(Partner::class)->findBy(['status' => Partner::STATUS_NEEDS_PROFILE_REVIEW]);

            foreach ($activePartners as $partner) {
                $this->workflowRegistry
                    ->get($partner)
                    ->apply($partner, Partner::TRANSITION_FLAG_FOR_REVIEW_PAST_DUE);
            }

            $this->em->flush();

        }

    }

}
