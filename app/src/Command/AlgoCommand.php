<?php

declare(strict_types=1);

namespace App\Command;

use App\Interfaces\AlgoManagerInterface;
use Exception;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AlgoCommand extends Command
{
    protected static $defaultName = 'app:algo';

    /**
     * @var AlgoManagerInterface
     */
    private AlgoManagerInterface $manager;

    /**
     * @param AlgoManagerInterface $manager
     * @param string|null $name
     */
    public function __construct(AlgoManagerInterface $manager, string $name = null)
    {
        parent::__construct($name);
        $this->manager = $manager;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Algo Fulll')
            ->addArgument('index', InputArgument::OPTIONAL, 'Index', 100);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $index = $input->getArgument('index');

        if (!is_numeric($index) || (int)$index <= 0) {
            throw new InvalidArgumentException("L'argument 'index' doit être un entier strictement supérieur à 0.");
        }

        $this->manager->algo((int)$index);

        return Command::SUCCESS;
    }
}
