<?php

namespace App\Tests\PhpUnit;

use App\Domain\Entity\Fleet;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\App\Command\FleetCommand\FleetCreateCommand;
use App\App\Handler\RegisterFleetHandler;

class FleatCreateCommandTest extends TestCase
{
    /**
     * @throws ExceptionInterface
     */
    public function testExecuteSuccess(): void
    {
        $userId = '99';

        $handler = $this->createMock(RegisterFleetHandler::class);
        $fleet = $this->createMock(Fleet::class);
        $fleet->method('getFleetId')->willReturn(1);
        $handler->method('__invoke')->willReturn($fleet);
        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')->with('userId')->willReturn($userId);
        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->once())
            ->method('writeln')
            ->with($this->stringContains('Fleet created ID - 1'));

        $command = new FleetCreateCommand($handler);
        $result = $command->run($input, $output);

        $this->assertEquals(Command::SUCCESS, $result);
    }

    /**
     * @throws ExceptionInterface
     */
    public function testExecuteFailure(): void
    {
        $userId = '99';

        $handler = $this->createMock(RegisterFleetHandler::class);
        $handler->method('__invoke')
            ->willThrowException(new RuntimeException('Failed to create fleet'));

        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')->with('userId')->willReturn($userId);

        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->once())
            ->method('writeln')
            ->with($this->stringContains('Error: Failed to create fleet'));

        $command = new FleetCreateCommand($handler);
        $result = $command->run($input, $output);

        $this->assertEquals(Command::FAILURE, $result);
    }
}
