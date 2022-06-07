<?php

namespace App\Repositories;

use App\Models\Mortgage;
use App\Models\Ship;
use App\Models\ShipDetail;
use App\Models\ShipFund;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class ShipRepository
{
    public function __construct(public Ship $ship)
    {
    }

    public function getShipDetails(): HasOne|ShipDetail
    {
        return $this->ship
            ->details()
            ->first();
    }

    public function getShipFund(): HasOne|ShipFund
    {
        return $this->ship
            ->fund()
            ->first();
    }

    public function getMonthlyExpensesForShip(): Collection
    {
        return $this->ship
            ->expenses()
            ->where('expense_type_id', '=', 1)
            ->get();
    }

    public function getMortgagePayment(): HasOne|Mortgage|null
    {
        $mortgage = $this->ship->mortgage()->first();

        if ($mortgage->current_month > $mortgage->total_months) {
            return null;
        }

        return $mortgage;
    }

    public function getPendingMortgageAmount(): int
    {
        $mortgage = $this->getMortgagePayment();
        return $mortgage?->monthly_amount ?: 0;
    }

    public function makeShipPayment(int $amount): void
    {
        $fund = $this->getShipFund();
        $fund->amount = $fund->amount - $amount;
        $fund->save();
    }

    public function addShipIncome(int $amount): void
    {
        $fund = $this->getShipFund();
        $fund->amount = $fund->amount + $amount;
        $fund->save();
    }

    public function mortgageNextMonth(): void
    {
        $mortgage = $this->getMortgagePayment();
        if ($mortgage === null) {
            return;
        }

        $mortgage->current_month = $mortgage->current_month + 1;
        $mortgage->save();
    }

    public function getMonthlyExpensesTotalForShip(): int
    {
        $monthlies = $this->ship
            ->expenses()
            ->where('expense_type_id', '=', 1)
            ->sum('price');
        return $monthlies + $this->getPendingMortgageAmount();
    }
}
