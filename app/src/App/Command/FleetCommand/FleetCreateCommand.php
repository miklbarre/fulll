<?php

namespace App\App\Command\FleetCommand;

use App\App\Command\RegisterFleetCommand;
use App\App\Handler\RegisterFleetHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'fleet:create',
    description: 'Creates a fleet and returns the fleetId.',
)]
final class FleetCreateCommand extends Command
{

    public function __construct(
        private readonly RegisterFleetHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('userId',
                InputArgument::REQUIRED,
                'The ID of the user creating the fleet');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument('userId');

        $command = new RegisterFleetCommand($userId);
        try {
            $fleet = ($this->handler)($command);
            $output->writeln("Fleet created ID - {$fleet->getFleetId()}");
            return Command::SUCCESS;
        } catch (Throwable $e) {
            $output->writeln("Error: {$e->getMessage()}");
            return Command::FAILURE;
        }

    }
}
