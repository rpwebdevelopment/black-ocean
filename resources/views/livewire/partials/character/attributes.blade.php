<div class="flex items-center justify-between pt-2 pb-2 bg-gray-300 rounded-t mt-8">
    <p class="px-4 text-xl font-semibold">
        Attributes
    </p>
</div>

@foreach($characterAttributes as $attribute)
    <div class="flex border-x border-b border-gray-300">
        <div class="flex w-1/3 p-4">
            {{ $attribute['name'] }}
        </div>
        <div class="flex w-1/3 p-4">
            {{ $attribute['level'] }}
        </div>
        <div class="flex w-1/3 p-4">
            {{ $attribute['dice'] }}
        </div>
    </div>
@endforeach
