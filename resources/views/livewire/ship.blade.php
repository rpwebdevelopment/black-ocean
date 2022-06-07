<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showCurr: false, showDest: false }">
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
                            {{ $shipDetails->fuel_capacity }}
                        </div>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/2">
                            Current:
                        </div>
                        <div class="flex w-1/2">
                            {{ $shipDetails->fuel_current }}
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
                            Navigation
                        </p>
                    </div>

                    <div class="flex w-full border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/4">
                            Current Location:
                        </div>
                        <div class="flex flex-col w-3/4">
                            <div class="flex w-full">
                                <div class="flex w-1/4">Name:</div>
                                <div class="flex w-1/2">{{ $currentLocation['name'] }}</div>
                                <div class="flex w-1/4">
                                    <button
                                        class="underline px-4 py-2"
                                        type="button"
                                        @click="showCurr = ! showCurr">
                                        Toggle Information
                                    </button>
                                </div>
                            </div>

                            <div x-show="showCurr" x-transition.duration.500ms >
                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Coordinates:</div>
                                    <div class="flex w-3/4">
                                        {{ str_pad($currentLat, 2, '0', STR_PAD_LEFT) }}
                                        {{ str_pad($currentLong, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>

                                @if($currentLocation['alignment'])
                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Alignment:</div>
                                        <div class="flex w-3/4">{{ $currentLocation['alignment'] }}</div>
                                    </div>
                                @endif

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Starport:</div>
                                    <div class="flex w-3/4">Class {{ $currentLocation['star-port'] }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Tech Level:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['tech-level'] }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Law Level:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['law-level'] }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Gravity:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['gravity'] }}G</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Atmosphere:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['atmosphere'] }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Notes:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['notes'] }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Has Gas Giant:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['gas-giant'] ? 'Yes' : 'No' }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Bases:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['bases'] ?: 'None' }}</div>
                                </div>

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Population:</div>
                                    <div class="flex w-3/4">{{ $currentLocation['population'] }}</div>
                                </div>

                                @if($currentLocation['item-restrictions'])
                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Restricted Items:</div>
                                        <div class="flex w-3/4">{{ $currentLocation['item-restrictions'] }}</div>
                                    </div>
                                @endif

                                @if($currentLocation['traveller-restrictions'])
                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Traveller Restrictions:</div>
                                        <div class="flex w-3/4">{{ $currentLocation['traveller-restrictions'] }}</div>
                                    </div>
                                @endif

                                <div class="flex w-full pt-4">
                                    <div class="flex w-1/4">Information:</div>
                                    <div class="flex w-3/4">{!! $currentLocation['description'] !!}</div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col w-full border-x border-b border-gray-300 p-4">

                        <div>
                            @if (session()->has('jumpError'))
                                <div class="w-full p-4 mb-4 bg-red-300 border border-red-900 text-red-900 text-center rounded">
                                    {{ session('jumpError') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex w-full pb-4">
                            <div class="flex w-1/4 items-center">
                                Available Locations:
                            </div>
                            <div class="flex w-1/4">
                                <select
                                    class="rounded border-gray-300 w-full mr-6"
                                    wire:model="destinationId"
                                    wire:change="$emit('changeTargetLocation')"
                                >
                                    <option value="">Select Destination</option>
                                    @foreach($availableLocations as $key => $location)
                                        <option value="{{ $key }}">{{ $location['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex w-1/4 items-center">
                                @if(isset($targetLocation['distance']))
                                    <strong>Jump Distance:</strong> &nbsp; {{ $targetLocation['distance'] }} parsecs
                                @else
                                    <strong>Jump Distance:</strong> &nbsp; &mdash;
                                @endif
                            </div>
                            <div class="flex w-1/4">
                                <button
                                    wire:click="$emit('moveToTargetLocation')"
                                    class="button bg-gray-700 rounded text-white px-4 py-2">
                                    Jump
                                </button>
                            </div>

                        </div>

                        <div class="flex w-full pt-4">
                            <div class="flex w-1/4">
                                Destination:
                            </div>
                            <div class="flex flex-col w-3/4">
                                <div class="flex w-full">
                                    <div class="flex w-1/4">Name:</div>
                                    <div class="flex w-1/2">{!!  $targetLocation['name'] ?? '&mdash;' !!}</div>
                                    <div class="flex w-1/4">
                                        <button
                                            class="underline px-4 py-2"
                                            type="button"
                                            @click="showDest = ! showDest">
                                            Toggle Information
                                        </button>
                                    </div>
                                </div>

                                <div x-show="showDest" x-transition.duration.500ms id="targetCollapse">
                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Coordinates:</div>
                                        <div class="flex w-3/4">
                                            @if(isset($targetLocation['lat']))
                                            {{ str_pad($targetLocation['lat'], 2, '0', STR_PAD_LEFT) }}
                                            {{ str_pad($targetLocation['long'], 2, '0', STR_PAD_LEFT) }}
                                            @else
                                                &mdash;
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Alignment:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['alignment'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Starport:</div>
                                        @if(isset($targetLocation['star-port']))
                                        <div class="flex w-3/4">Class {{ $targetLocation['star-port'] }}</div>
                                        @else
                                            <div class="flex w-3/4">&mdash;</div>
                                        @endif
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Tech Level:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['tech-level'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Law Level:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['law-level'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Gravity:</div>
                                        @if(isset($targetLocation['gravity']))
                                            <div class="flex w-3/4">{!! $targetLocation['gravity'] !!}G</div>
                                        @else
                                            <div class="flex w-3/4">&mdash;</div>
                                        @endif
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Atmosphere:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['atmosphere'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Notes:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['notes'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Has Gas Giant:</div>
                                        @if(isset($targetLocation['gas-giant']))
                                            <div class="flex w-3/4">{!! ($targetLocation['gas-giant'] ? 'Yes' : 'No') !!}</div>
                                        @else
                                            <div class="flex w-3/4">&mdash;</div>
                                        @endif
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Bases:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['bases'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Population:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['population'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Restricted Items:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['item-restrictions'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Traveller Restrictions:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['traveller-restrictions'] ?? '&mdash;' !!}</div>
                                    </div>

                                    <div class="flex w-full pt-4">
                                        <div class="flex w-1/4">Information:</div>
                                        <div class="flex w-3/4">{!! $targetLocation['description'] ?? '&mdash;' !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
                        <p class="px-4 text-xl font-semibold">
                            Monthly Expenses
                        </p>
                        <button
                            wire:click="$emit('progressMonth')"
                            class="button mx-4 bg-gray-700 rounded text-white px-4 py-2"
                        >
                            Pay Monthlies
                        </button>
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
