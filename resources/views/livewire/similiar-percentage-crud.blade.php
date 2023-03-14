<div>
    <div class="grid grid-cols-2 gap-4">
        <x-card>
            <form>
                <div class="mb-6">
                    <label for="stringOne" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">String 1</label>
                    <input type="text" id="stringOne" wire:model='stringOne'
                        class="@error('stringOne') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="example = ABBCD" required>
                    @error('stringOne')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="stringTwo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">String 2</label>
                    <input type="text" id="stringTwo" wire:model='stringTwo'
                        class="@error('stringTwo') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="example = GallantDuck" required>
                    @error('stringTwo')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <x-btn-primary wire:click.prevent="store()">
                    Submit
                </x-btn-primary>
                <x-btn-warning wire:click.prevent="resetResult()">
                    Bersihkan
                </x-btn-warning>
            </form>
        </x-card>

        <x-card class="flex items-center justify-center text-9xl">
            <h1 >{{$result ?? 0}} %</h1>
        </x-card>
    </div>
</div>
