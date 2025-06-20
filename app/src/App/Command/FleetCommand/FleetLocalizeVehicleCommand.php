<?php

namespace App\App\Command\FleetCommand;


use App\App\Command\ParkVehicleCommand;
use App\Domain\Interfaces\Handler\ParkVehicleHandleInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'fleet:localize-vehicle',
    description: 'Localize a vehicle to a fleet with GPS coords.',
)]
final class FleetLocalizeVehicleCommand extends Command
{
    /**
     * @param ParkVehicleHandleInterface $handler
     */
    public function __construct(
        private readonly ParkVehicleHandleInterface $handler
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
$this
            ->addArgument('lat', InputArgument::REQUIRED, 'Latitude');
$this
            ->addArgument('lng', InputArgument::REQUIRED, 'Longitude');

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = $input->getArgument('fleetId');
        $plateNumber = $input->getArgument('plateNumber');
        $latitude = $input->getArgument('lat');
        $longitude = $input->getArgument('lng');

        $command = new ParkVehicleCommand($plateNumber, $fleetId,(float)$latitude, (float)$longitude);
        try {
            ($this->handler)($command);
            $output->writeln("Vehicle $plateNumber -  parked to $latitude & $longitude");
            return Command::SUCCESS;
        } catch (Throwable $e) {
            $output->writeln("Error: {$e->getMessage()}");
            return Command::FAILURE;
        }

    }
}