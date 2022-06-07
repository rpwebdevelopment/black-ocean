<div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
    <p class="px-4 text-xl font-semibold">
        Associates
    </p>
    <button
        class="button mx-4 bg-gray-700 rounded text-white px-4 py-2"
        @click="showAssoc = true"
    >
        Add Associate
    </button>
</div>

@foreach($associates as $associate)
    <div class="border-x border-b border-gray-300">
        <div class="flex w-full">
            <div class="w-1/3 p-4">
                <strong>Name:</strong><br />
                {{ $associate->name }}
            </div>
            <div class="w-1/3 p-4">
                <strong>Type:</strong><br />
                {{ $associate->type }}
            </div>
            @if($associate->who)
                <div class="w-1/3 p-4">
                    <strong>Who they are:</strong><br />
                    {{ $associate->who }}
                </div>
            @endif
        </div>
        @if($associate->how)
            <div class="w-full p-4">
                <strong>How you know them:</strong><br />
                {{ $associate->how }}
            </div>
        @endif
    </div>
@endforeach
