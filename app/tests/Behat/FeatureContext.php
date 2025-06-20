<?php

namespace App\Tests\Behat;

use App\Entity\Fleet;
use App\Entity\Location;
use App\Entity\Vehicle;
use Behat\Behat\Context\Context;
use Behat\Step\Given;
use Behat\Step\Then;
use Behat\Step\When;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class FeatureContext implements Context
{
    private Fleet $myFleet;
    private ?Fleet $otherFleet = null;
    private Vehicle $vehicle;
    private ?Exception $caughtException = null;

    private Location $location;

    public function __construct()
    {
    }

    #[Given('my fleet')]
    public function myFleet(): void
    {
        $this->myFleet = new Fleet(1);
    }

    #[Given("the fleet of another user")]
    public function theFleetOfAnotherUser(): void
    {
        $this->otherFleet = new Fleet(2);
    }

    #[Given('a vehicle')]
    public function aVehicle(): void
    {
        $this->vehicle = new Vehicle('ABC-123', $this->myFleet);
    }

    /**
     * @throws Exception
     */
    #[When('I register this vehicle into my fleet')]
    public function registerVehicle(): void
    {
        $this->myFleet->addVehicle($this->vehicle);
    }

    /**
     * @return void
     */
    #[Then('this vehicle should be part of my vehicle fleet')]
    public function vehicleShouldBeInFleet(): void
    {
        assert($this->myFleet->hasVehicle($this->vehicle));
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
    }


    // PARKING VEHICULE

    #[Given('a location')]
    public function aLocation(): void
    {
        $this->location = new Location(48.8566, 2.3522);
    }

    /**
     * @throws Exception
     */
    #[Given('my vehicle has been parked into this location')]
    public function myVehicleHasBeenParkedIntoThisLocation(): void
    {
        $this->vehicle->parkAt($this->location);
    }

    /**
     * @throws Exception
     */
    #[When('I park my vehicle at this location')]
    public function iParkMyVehicleAtThisLocation(): void
    {
        $this->vehicle->parkAt($this->location);
    }

    /**
     * @throws Exception
     */
    #[When('I try to park my vehicle at this location')]
    public function iTryToParkMyVehicleAtThisLocation(): void
    {
        try {
            $this->vehicle->parkAt($this->location);
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }

    #[Then('the known location of my vehicle should verify this location')]
    public function theKnownLocationShouldVerify(): void
    {
        assert($this->vehicle->getLocation()?->equals($this->location) === true);
    }

    #[Then('I should be informed that my vehicle is already parked at this location')]
    public function iShouldBeInformedOfDuplicateLocation(): void
    {
        assert($this->caughtException instanceof Exception);
        assert(str_contains($this->caughtException->getMessage(), 'already parked'));
    }

}
