<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                x-data="{ showCurr: false, showDest: false, showAssoc: false }"
                x-on:close-assoc-modal.window="showAssoc = false"
            >
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
                        <p class="px-4 text-xl font-semibold">
                            Details
                        </p>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/4">
                            Name: {{ $character->name }}
                        </div>
                        <div class="flex w-1/4">
                            Age: {{ $character->age }}
                        </div>
                        <div class="flex w-1/4">
                            Home Planet: {{ $homeSystem['name'] }}
                            {{ str_pad($homeSystem['lat'], 2, '0', STR_PAD_LEFT) }}{{ str_pad($homeSystem['long'], 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="flex w-1/4">
                            Credits: ${{ number_format($character->credits) }}
                        </div>
                    </div>

                    <div class="flex border-x border-b border-gray-300 p-4">
                        <div class="flex w-1/4">
                            Ship Share: {{ $character->ship_shares }}
                        </div>
                        <div class="flex w-1/4">
                            Re-Rolls: {{ $character->re_rolls }}/3
                        </div>
                        <div class="flex w-1/4">
                            Role: {{ $character->role ?? '' }}
                        </div>
                        <div class="flex w-1/4">
                            Toughness: {{ $character->base_toughness }} (adjusted here)
                        </div>
                    </div>

                    @include('livewire.partials.character.attributes')

                    @include('livewire.partials.character.associates')

                </div>

                @include('livewire.partials.modal.character-associate-modal')

            </div>
        </div>
    </div>

</div>
