<div class="py-12">
    <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8"
        x-data="{ addOpen: false }"
        x-on:close-game-modal.window="addOpen = false"
    >

        <div class="flex flex-wrap">

            <div class="w-1/3 p-2">
                <div
                    x-on:click="addOpen = true"
                    class="w-full bg-white rounded-lg shadow-sm p-2 cursor-pointer"
                >
                    <div class="p-4 text-center">
                        <p><i class="fa-solid fa-circle-plus"></i></p>
                        <p>Create New Game</p>
                    </div>
                </div>
            </div>

            @foreach($games as $game)
                <div class="w-1/3 p-2">
                    <a href="{{ route('game', ['id' => $game['game']['id']]) }}">
                        <div class="w-full bg-white rounded-lg shadow-sm">
                            <div class="w-full bg-gray-300 font-semibold rounded-t p-2 text-center">
                                <h2>{{ $game['game']['name'] }}</h2>
                            </div>
                            <div class="p-4">
                                <p>GM: {{ $game['gm']['username'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>

        @include('livewire.partials.modal.add-new-game-modal')

    </div>
</div>
