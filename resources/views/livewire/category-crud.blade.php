<div>
    <div class="grid grid-cols-4 gap-4">
        <div class="flex flex-col">
            <x-card>
                <form>
                    <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Kategori</label>
                        <input type="text" id="category" wire:model='category'
                            class="@error('category') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="nama kategori" required>
                        @error('category')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                            Kategori</label>
                        <textarea name="description" wire:model='description'
                            class="@error('description') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="description" cols="30" rows="10" placeholder="Deskripsi Kategori"></textarea>
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($this->categoryId == null)
                        <x-btn-primary wire:click.prevent="storeCategory()">
                            Submit
                        </x-btn-primary>
                    @else
                        <x-btn-primary wire:click.prevent="updateCategory()">
                            Update
                        </x-btn-primary>
                    @endif
                    <x-btn-warning wire:click.prevent="cancelCategory()">
                        Cancel
                    </x-btn-warning>
                </form>
            </x-card>
        </div>

        <div class="card col-span-3">

            <h3 class="py-4">List Kategori</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $index => $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->category }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-btn-warning wire:click="editCategory({{ $item->id }})">Edit
                                        </x-btn-warning>
                                        <x-btn-danger wire:click="deleteCategory({{ $item->id }})">Delete
                                        </x-btn-danger>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">
                                    No Category Found.
                                </td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <hr>
            <h3 class="py-4">List Kategori dengan Barang</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                List Barang
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $index => $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->category }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- {{dd($item->product)}} --}}
                                        @if (count($item->products) > 0)
                                            <ol>
                                                @foreach ($item->products as $product)
                                                    <li>
                                                        {{ $product->name }} (Rp. {{ $product->price }})
                                                        @if ($product->stock != 0)
                                                            <x-badge-green>Stok Ready</x-badge-green>
                                                        @else
                                                            <x-badge-red>Stok Kosong !</x-badge-red>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @else
                                            <x-badge-red>
                                                Tidak ada barang di kategori ini !
                                            </x-badge-red>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">
                                    No Category Found.
                                </td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
