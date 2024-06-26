<div>
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 ">
            <div>
                <label class="font-medium" for="logo">Existing Logo</label>
                <img class="w-32 mt-3" src="http://127.0.0.1:8001/uploads/1659965923.png" alt="logo">
            </div>
            <div class="flex flex-col">
                <label for="">Change Logo</label>
                <input type="file" name="" id="">
            </div>
        </div>
        <div class="">
            <div>
                <label class="font-medium" for="logo">Existing Favicon</label>
                <img class="mt-3" src="http://127.0.0.1:8001/uploads/1659970382.png" alt="logo">
            </div>
            <div class="flex flex-col">
                <label for="">Change Favicon</label>
                <input type="file" name="" id="">
            </div>
        </div>
    </div>
    <div class="mt-10">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model="name"
            />
        </x-filament::input.wrapper>
    </div>
</div>
