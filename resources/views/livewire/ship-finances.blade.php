<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="px-4 text-xl font-semibold">
                        Finances
                    </p>

                    <div class="pt-6 pr-6 flex w-full md:w-1/2">
                        <div class="flex w-1/2 pl-4">Current Funds:</div>
                        <div class="flex w-1/2">${{ number_format($currentFunds, 0, '.', ',') }}</div>
                    </div>

                    <div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
                        <p class="px-4 text-xl font-semibold">
                            Fuel
                        </p>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/2">
                            Capacity:
                        </div>
                        <div class="flex w-1/2">
                            {{ $shipFuel->capacity }}
                        </div>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/2">
                            Current:
                        </div>
                        <div class="flex w-1/2">
                            {{ $shipFuel->current }}
                        </div>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/4 pr-8">
                            <select wire:model="fuelType" wire:change="selectFuelType" class="w-full rounded border-gray-300">
                                @foreach($fuelTypes as $fuelType)
                                    <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center w-1/4">
                            Unit Cost: ${{ number_format($selectedFuelType->ppu) }}
                        </div>
                        <div class="flex items-center w-1/4">
                            Total Cost: ${{ number_format($fuelCost) }}
                        </div>
                        <div class="flex w-1/4">
                            <button wire:click="$emit('refuel')" class="button bg-gray-700 rounded text-white px-4 py-2">Refuel</button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
                        <p class="px-4 text-xl font-semibold">
                            Monthly Expenses
                        </p>
                        <button wire:click="$emit('progressMonth')" class="button mx-4 bg-gray-700 rounded text-white px-4 py-2">Next Month</button>
                    </div>

                    @if($mortgage)
                        <div class="flex border-x border-b border-gray-300 p-4">
                            <div class="flex w-1/2">
                                Mortgage:
                            </div>
                            <div class="flex w-1/4">
                                ${{ number_format($mortgage->monthly_amount, 0, '.', ',') }}
                            </div>
                            <div class="flex w-1/4">
                                Month {{ $mortgage->current_month }} of {{ $mortgage->total_months }}
                            </div>
                        </div>
                    @endif

                    @foreach($monthlyExpenses as $expense)
                    <div class="flex border-x border-b border-gray-300 p-4">
                            <div class="flex w-1/2">
                                {{ $expense->name }}:
                            </div>
                            <div class="flex w-1/2">
                                ${{ number_format($expense->price, 0, '.', ',') }}
                            </div>
                    </div>
                    @endforeach

                    <div class="flex border-x border-b border-gray-300 rounded-b p-4">
                        <div class="flex w-1/2">
                            <strong>Total</strong>
                        </div>
                        <div class="flex w-1/2">
                            ${{ number_format($totalMonthly, 0, '.', ',') }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
                        <p class="px-4 text-xl font-semibold">
                            Passengers
                        </p>
                        <div class="px-4">
                            <span class="mr-4">No. Parsecs</span>
                            <input
                                wire:model="parsec"
                                class="rounded border-gray-300 mr-4"
                                type="number"
                                min="1"
                                max="2"
                            />
                            <button
                                wire:click="passengersDisembark"
                                class="button bg-gray-700 rounded text-white px-4 py-2">
                                Resolve
                            </button>
                        </div>
                    </div>

                    @foreach($shipBerths as $berth)
                        <div class="flex border-x border-b border-gray-300 p-4">
                            <div class="flex w-1/4 items-center">
                                {{ $berth->name }}
                            </div>
                            <div class="flex w-1/4 items-center">
                                Capacity: {{ $berth->max }}
                            </div>
                            <div class="flex w-1/4 pr-8">
                                <input
                                    wire:model="berths.{{ $berth->id }}"
                                    class="w-full rounded border-gray-300"
                                    type="number"
                                    min="0"
                                    max="{{ $berth->max }}"
                                />
                            </div>
                            <div class="flex w-1/4 items-center">
                                Income/Parsec: ${{ number_format($berth->per_parsec_income) }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
