<?php

namespace App\Tests\Behat;

use App\Entity\Fleet;
use App\Entity\Vehicle;
use App\Repository\FleetRepository;
use Behat\Behat\Context\Context;
use Behat\Step\Given;
use Behat\Step\Then;
use Behat\Step\When;
use Exception;

class FeatureContext implements Context
{
    private FleetRepository $repository;
    private Fleet $myFleet;
    private ?Fleet $otherFleet = null;
    private Vehicle $vehicle;
    private ?Exception $caughtException = null;

    public function __construct()
    {
        $this->repository = new FleetRepository();
    }

    #[Given('my fleet')]
    public function myFleet(): void
    {
        $this->myFleet = new Fleet('my-fleet');
        $this->repository->save($this->myFleet);
    }

    #[Given("the fleet of another user")]
    public function theFleetOfAnotherUser(): void
    {
        $this->otherFleet = new Fleet('other-fleet');
        $this->repository->save($this->otherFleet);
    }

    #[Given('a vehicle')]
    public function aVehicle(): void
    {
        $this->vehicle = new Vehicle('ABC-123');
    }

    /**
     * @throws Exception
     */
    #[When('I register this vehicle into my fleet')]
    public function registerVehicle(): void
    {
        $this->myFleet->addVehicle($this->vehicle);
        $this->repository->save($this->myFleet);
    }

    #[Then('this vehicle should be part of my vehicle fleet')]
    public function vehicleShouldBeInFleet(): void
    {
        $fleet = $this->repository->find('my-fleet');
        assert($fleet->hasVehicle($this->vehicle));
    }

    /**
     * @throws Exception
     */
    #[Given('I have registered this vehicle into my fleet')]
    public function alreadyRegistered(): void
    {
        $this->registerVehicle();
    }

    #[When('I try to register this vehicle into my fleet')]
    public function tryRegisteringAgain(): void
    {
        try {
            $this->registerVehicle();
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }

    #[Then('I should be informed this this vehicle has already been registered into my fleet')]
    public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet(): void
    {
        assert($this->caughtException instanceof Exception);
        assert(str_contains($this->caughtException->getMessage(), 'already added'));
    }

    /**
     * @throws Exception
     */
    #[Given("this vehicle has been registered into the other user's fleet")]
    public function registeredInOtherFleet(): void
    {
        $this->otherFleet->addVehicle($this->vehicle);
        $this->repository->save($this->otherFleet);
    }
}
