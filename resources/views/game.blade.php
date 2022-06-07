<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quantum Itch') }}
        </h2>
    </x-slot>

    <div x-data="{showShip: false}">

        <div class="absolute h-full p-6 w-48">
            <button
                @click="showShip = ! showShip"
                class="button mx-4 bg-gray-700 rounded text-white px-4 py-2 w-full"
            >
                Ship
            </button>

            @if($is_gm)

                <button
                    @click="showShip = ! showShip"
                    class="button mx-4 bg-gray-700 rounded text-white px-4 py-2 w-full mt-4"
                >
                    Invite Crew
                </button>

            @endif
        </div>

        <div class="content">

            @if($ship)
                <div x-show="showShip">
                    <livewire:ship />
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
