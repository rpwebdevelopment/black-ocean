<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="bg-white border-gray-200">
        <div class="w-full font-semibold bg-gray-300 text-xl p-4 rounded-t-lg">
            Search
        </div>

        <div class="p-6">
            <input
                wire:model="userInput"
                wire:keyup="$emit('userSearch')"
                type="text"
                name="usrSearch"
                id="usrSearch"
                class="w-full rounded border-gray-400"
            />
        </div>

    </div>

    @error('exists')
    <div class="p-4 mx-6 mb-4 bg-red-300 border border-red-900 text-red-900 text-center rounded">
        {{ $message }}
    </div>
    @enderror

    @if (session()->has('sent'))
        <div class="p-4 mx-6 mb-4 bg-green-300 border border-green-900 text-green-900 text-center rounded">
            {{ session('sent') }}
        </div>
    @endif

    @if($users && count($users))
        @foreach($users as $user)
            <div class="flex w-full justify-between hover:bg-gray-200 py-4 px-6 items-center">
                <span>{{ $user->username }}</span>
                <button
                    wire:click="$emit('sendRequest', {{ $user->id }})"
                    class="button mx-4 bg-gray-700 rounded text-white px-4 py-2"
                >
                    <i class="fa-solid fa-face-smile-plus"></i> Send Request
                </button>
            </div>
        @endforeach
    @else
        <div id="enpty-result" class="text-gray-400 p-6">
            No results
        </div>
    @endif
</div>
