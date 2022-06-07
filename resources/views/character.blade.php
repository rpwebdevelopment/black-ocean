<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quantum Itch') }}
        </h2>
    </x-slot>

    <livewire:character-sheet :characterId="$id" />

</x-app-layout>
