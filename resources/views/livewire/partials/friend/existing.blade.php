@if(count($friends))

    <div class="bg-white shadow-sm sm:rounded-lg mt-8 mb-8">
        <div class="w-full font-semibold bg-gray-300 text-xl p-4 rounded-t-lg">
            Existing Friends
        </div>

        @foreach($friends as $friend)
            <div class="flex w-full justify-between hover:bg-gray-200 py-4 px-6 items-center">
                <span>{{ $friend['username'] }}</span>
                <button
                    wire:click="$emit('removeFriend', {{ $friend['id'] }})"
                    class="button mx-4 bg-red-700 rounded text-white px-4 py-2"
                >
                    Unfriend
                </button>
            </div>
        @endforeach
    </div>

@endif
