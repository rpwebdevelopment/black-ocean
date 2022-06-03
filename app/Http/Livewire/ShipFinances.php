<?php

namespace App\Http\Livewire;

use App\Models\FuelType;
use App\Models\Mortgage;
use App\Models\Ship;
use App\Models\ShipFuel;
use App\Repositories\ShipRepository;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShipFinances extends Component
{
    public array $berths = [];
    public Ship $ship;
    public int $parsec = 1;
    public int $currentFunds;
    public int $totalMonthly;
    public int $fuelType = 1;
    public int $fuelCost = 0;
    public ?Mortgage $mortgage;
    public ShipFuel $shipFuel;
    public Collection $fuelTypes;
    public FuelType $selectedFuelType;
    public Collection $shipBerths;
    public Collection $monthlyExpenses;
    protected ShipRepository $shipRepository;

    protected $rules = [
        'berths.*' => 'integer'
    ];

    protected $listeners = [
        'progressMonth' => 'progressMonth',
        'selectFuelType' => 'selectFuelType',
        'refuel' => 'refuel',
        'passengersDisembark' => 'passengersDisembark',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->fuelTypes = FuelType::all();
        $this->ship = Ship::find(1);
        $this->shipRepository = new ShipRepository($this->ship);
        $this->shipBerths = $this->ship->berths()->get();
        $this->getFinances();
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
        $this->shipFuel->current = $this->shipFuel->capacity;
        $this->shipFuel->save();

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
        $this->shipFuel = $this->shipRepository->getShipFuel();
        $refuelUnitsRequired = $this->shipFuel->capacity - $this->shipFuel->current;
        $selectedFuelType = $this->fuelTypes->filter(fn ($types) => $types->id === $this->fuelType);
        $this->selectedFuelType = $selectedFuelType->first();
        $this->fuelCost = $refuelUnitsRequired * $this->selectedFuelType->ppu;
    }

    public function render()
    {
        return view('livewire.ship-finances');
    }
}
