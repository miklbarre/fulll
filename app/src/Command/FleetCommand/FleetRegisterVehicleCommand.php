<?php

namespace App\Command\FleetCommand;;

use App\Command\RegisterVehicleCommand;
use App\Interfaces\Handler\RegisterVehicleHandlerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'fleet:register-vehicle',
    description: 'Register a vehicle to a fleet.',
)]
class FleetRegisterVehicleCommand extends Command
{

    /**
     * @param RegisterVehicleHandlerInterface $handler
     */
    public function __construct(
        private readonly RegisterVehicleHandlerInterface $handler
    )
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID');
        $this
            ->addArgument('plateNumber', InputArgument::REQUIRED, 'Vehicle Plate Number');

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = $input->getArgument('fleetId');
        $plateNumber = $input->getArgument('plateNumber');

        $command = new RegisterVehicleCommand($fleetId, $plateNumber);
        try {
            ($this->handler)($command);
            $output->writeln("Vehicle created");
            return Command::SUCCESS;
        } catch (Throwable $e) {
            $output->writeln("Error: {$e->getMessage()}");
            return Command::FAILURE;
        }

    }
}
