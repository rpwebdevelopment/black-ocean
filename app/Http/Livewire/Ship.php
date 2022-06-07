<?php

namespace App\Http\Livewire;

use App\Models\FuelType;
use App\Models\Mortgage;
use App\Models\Ship as ShipModel;
use App\Models\ShipDetail;
use App\Repositories\ShipRepository;
use App\Schemas\PlanetSchema;
use Illuminate\Support\Collection;
use Livewire\Component;

class Ship extends Component
{
    public int $shipId = 0;
    public array $berths = [];
    public ?ShipModel $ship = null;
    public int $parsec = 1;
    public int $currentFunds;
    public int $totalMonthly;
    public int $fuelType = 1;
    public int $fuelCost = 0;
    public int $currentLat = 0;
    public int $currentLong = 0;
    public string $destinationId = '';
    public array $currentLocation = [];
    public array $targetLocation = [];
    public array $availableLocations = [];
    public ?Mortgage $mortgage;
    public ShipDetail $shipDetails;
    public Collection $fuelTypes;
    public FuelType $selectedFuelType;
    public Collection $shipBerths;
    public Collection $monthlyExpenses;
    protected ShipRepository $shipRepository;

    protected $rules = [
        'berths.*' => 'integer'
    ];

    protected $listeners = [
        'progressMonth',
        'selectFuelType',
        'refuel',
        'passengersDisembark',
        'changeTargetLocation',
        'moveToTargetLocation',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->fuelTypes = FuelType::all();
    }

    public function getShipDetails()
    {
        $this->ship = ShipModel::find($this->shipId);
        $this->shipRepository = new ShipRepository($this->ship);
        $this->shipBerths = $this->ship->berths()->get();
        $this->shipDetails = $this->shipRepository->getShipDetails();
        $this->getCurrentLocation();
        $this->getFinances();
    }

    public function getCurrentLocation(): void
    {
        $currentLocation = $this->ship->location()->first();
        $this->currentLat = $currentLocation->current_lat;
        $this->currentLong = $currentLocation->current_long;
        $this->currentLocation = PlanetSchema::getSystem($this->currentLat, $this->currentLong);
        $this->availableLocations = PlanetSchema::getAvailableLocations(
            $this->currentLat,
            $this->currentLong,
            2
        );
    }

    public function changeTargetLocation(): void
    {
        $this->targetLocation = [];
        if ($this->destinationId !== '') {
            $this->targetLocation = $this->availableLocations[$this->destinationId];
        }
    }

    public function moveToTargetLocation(): void
    {
        if ($this->destinationId === '') {
            return;
        }

        $target = $this->availableLocations[$this->destinationId];
        $fuelUsage = ($target['distance'] * $this->shipDetails->fuel_consumption_parsec)
            + $this->shipDetails->fuel_consumption_weekly;

        if ($fuelUsage > $this->shipDetails->fuel_current) {
            session()->flash('jumpError', 'Insufficient fuel for jump.');
            return;
        }

        $this->shipDetails->fuel_current = $this->shipDetails->fuel_current - $fuelUsage;
        $this->shipDetails->save();

        $this->getFuelCosts();

        $location = $this->ship->location()->first();
        $location->current_lat = $target['lat'];
        $location->current_long = $target['long'];
        $location->save();


        $this->targetLocation = [];

        $this->getCurrentLocation();
    }

    public function progressMonth(): void
    {
        $this->shipRepository->makeShipPayment($this->totalMonthly);
        $this->shipRepository->mortgageNextMonth();

        $this->getFinances();
    }

    public function selectFuelType(): void
    {
        $this->getFuelCosts();
    }

    public function refuel(): void
    {
        $this->shipRepository->makeShipPayment($this->fuelCost);
        $this->shipDetails->fuel_current = $this->shipDetails->fuel_capacity;
        $this->shipDetails->save();

        $this->getFinances();
    }

    public function passengersDisembark(): void
    {
        $total = 0;
        foreach ($this->berths as $type => $volume) {
            $berthType = $this->shipBerths->filter(fn ($berth) => $berth->id === $type)->first();
            $total += ($berthType->per_parsec_income * $volume);
            $this->berths[$type] = 0;
        }
        $total = $total * $this->parsec;
        $this->shipRepository->addShipIncome($total);
        $this->parsec = 0;
        $this->getFinances();
    }

    private function getFinances(): void
    {
        $this->currentFunds = $this->shipRepository->getShipFund()->amount;
        $this->mortgage = $this->shipRepository->getMortgagePayment();
        $this->totalMonthly = $this->shipRepository->getMonthlyExpensesTotalForShip();
        $this->monthlyExpenses = $this->shipRepository->getMonthlyExpensesForShip();
        $this->getFuelCosts();
    }

    private function getFuelCosts(): void
    {

        $refuelUnitsRequired = $this->shipDetails->fuel_capacity - $this->shipDetails->fuel_current;
        $selectedFuelType = $this->fuelTypes->filter(fn ($types) => $types->id === $this->fuelType);
        $this->selectedFuelType = $selectedFuelType->first();
        $this->fuelCost = $refuelUnitsRequired * $this->selectedFuelType->ppu;
    }

    public function render()
    {
        return view('livewire.ship');
    }
}
