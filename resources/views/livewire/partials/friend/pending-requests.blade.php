@if(count($pendingRequests))

    <div class="bg-white shadow-sm rounded-lg mt-8 mb-8">
        <div class="w-full font-semibold bg-gray-300 text-xl p-4 rounded-t-lg">
            Pending Requests
        </div>

        @foreach($pendingRequests as $pending)
            <div class="flex w-full justify-between hover:bg-gray-200 py-4 px-6 items-center">
                <span>{{ $pending->getRequestedName() }}</span>
                <div>
                    <button
                        wire:click="$emit('acceptRequest', {{ $pending->id }})"
                        class="button bg-green-700 rounded text-white px-4 py-2"
                    >
                        Accept
                    </button>

                    <button
                        wire:click="$emit('rejectRequest', {{ $pending->id }})"
                        class="button mx-4 bg-red-700 rounded text-white px-4 py-2"
                    >
                        Reject
                    </button>
                </div>
            </div>
        @endforeach
    </div>

@endif
