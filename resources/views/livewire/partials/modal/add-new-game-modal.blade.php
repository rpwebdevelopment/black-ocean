<div class="fixed top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="addOpen"  >
    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="addOpen = false">
        <form wire:submit.prevent>

            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    New Game
                </h3>
                <div class="mt-2">
                    <div class="form-group">
                        <label for="newGameName">Name</label>
                        <input
                            class="border-gray-300 rounded w-full"
                            type="text"
                            name="newGameName"
                            id="newGameName"
                            wire:model="newGameName"
                        />
                        @error('newGameName')
                        <span class="flex w-full text-red-700 text-sm">Name is required</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex mt-5 sm:mt-6 sm:ml-4">

                <span class="flex w-1/2 pr-4">
                    <button
                        class="whitespace-nowrap flex-nowrap inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 rounded-md shadow-sm"
                        wire:click="$emit('addGame')"
                    >
                        Add Game
                    </button>
                </span>

                <span class="flex w-1/2 pl-4">
                    <button @click="addOpen = false" class="inline-flex justify-center w-full px-4 py-2 text-blue-500 hover:text-blue-700 border border-blue-500 rounded hover:border-blue-700 rounded-md shadow-sm">
                        Close
                    </button>
                </span>

            </div>
        </form>
    </div>
</div>
