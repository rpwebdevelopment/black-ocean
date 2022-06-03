<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Search

                    <div class="pt-6 pr-6">
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

            </div>
            <div class="bg-white shadow-sm sm:rounded-lg mt-8 py-6 sm:px-6 lg:px-8">
                @if($users && count($users))
                    @foreach($users as $user)
                        <div class="w-full">{{ $user->username }}</div>
                    @endforeach
                @else
                    <span id="enpty-result" class="text-gray-400">
                          No results
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
