<?php
namespace App\Command;

use App\Services\HashService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class HashCommand
 */
class HashCommand extends Command
{
    protected static $defaultName = 'app:hash';

    /**
     * @var HashService
     */
    protected $hashService;

    /**
     * HashCommand constructor.
     * @param HashService $hashService
     * @param string|null $name
     */
    public function __construct(HashService $hashService, string $name = null)
    {
        $this->hashService = $hashService;

        parent::__construct($name);
    }

    /**  */
    protected function configure()
    {
        $this
            ->setDescription('Hash incoming string by distinct algorithms defined in .env')
            ->addArgument('stringToHash', InputArgument::OPTIONAL, 'String to hash. Default \"Hello World\"', 'Hello World');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stringToHash = $input->getArgument('stringToHash');
        if (!is_string($stringToHash)) {
            return 1;
        }

        $output->writeln('Hashing string ' . $stringToHash);
        $output->writeln($this->hashService->hash($stringToHash)->getHashedString());

        return 0;
    }
}