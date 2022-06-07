<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Games') }}
        </h2>
    </x-slot>

    <livewire:games />

</x-app-layout>
