<div>
    <div class="grid grid-cols-4 gap-4">
        <x-card>
            <form>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Barang</label>
                    <input type="text" id="name" wire:model='name'
                        class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="nama barang" required>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6" wire:ignore.self>
                    <label for="category_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Barang</label>
                    <select wire:model="category_id" id="category_id"
                        class="@error('category_id') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null" disabled>{{ __('Please select') }}</option>
                        @foreach ($this->category as $item)
                            <option value="{{ $item->id }}" wire:key="cateogry-{{ $item->id }}">
                                {{ $item->category }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock
                        Barang</label>
                    <input type="number" id="stock" wire:model='stock'
                        class="@error('stock') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Stock barang" required>
                    @error('stock')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                        Barang</label>
                    <input type="text" id="price" wire:model='price'
                        class="@error('price') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Harga barang" required>
                    @error('price')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                @if ($this->productId == null)
                    <x-btn-primary wire:click.prevent="storeProduct()">
                        Submit
                    </x-btn-primary>
                @else
                    <x-btn-primary wire:click.prevent="updateProduct()">
                        Update
                    </x-btn-primary>
                @endif
                <x-btn-warning wire:click.prevent="cancelProduct()">
                    Cancel
                </x-btn-warning>
            </form>
        </x-card>

        <div class="card col-span-3">
            <h3 class="py-4">List Barang</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Barang
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
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->category->category }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->stock }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-btn-warning wire:click="editProduct({{ $item->id }})">Edit
                                        </x-btn-warning>
                                        <x-btn-danger wire:click="deleteProduct({{ $item->id }})">Delete
                                        </x-btn-danger>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">
                                    No Product Found.
                                </td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
